<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
use Carbon\Carbon;
use Auth;
use Validator;
use App\Asistencia;
use App\Receso;
use App\User;
use DateTime;

class AsistenciaController extends Controller
{
  
   public function index(){
     $usuario = Auth::user();
     $actual = Carbon::now();   
     $activa = Asistencia::where('user_id', $usuario->id )
        ->where('abierto', '1')
        ->first(); 
     
     if($activa){
     $receso = Receso::where('asistencia_id', $activa->id )
        ->where('status', '1')
        ->first();
       }else{ $receso = null; }
       
        return view('asistencia', compact('actual','usuario','activa','receso') );
    }
  
  public function addEvent(){
        $actual = Carbon::now();
        $usuario = Auth::user();
    
        $event = new Asistencia;
        $event->start_date = $actual;
        $event->user_id = Auth::user()->id;
        $event->abierto = '1';
        $event->save();
    
    $status = User::find($usuario->id);
    if($status){
      $status->sesion = 1;
      $status->save(); 
    };
    
    
        \Session::flash('success','Sesion iniciada.');
        return Redirect::to('/');
    }
  
  
   public function receso(Request $request) {
         $usuario = Auth::user();
         $activa = Asistencia::where('user_id', $usuario->id )
        ->where('abierto', '1')
        ->first(); 
     
       $receso = Receso::where('asistencia_id', $activa->id )
        ->where('status', '1')
        ->first();

        $actual = Carbon::now();
        $event = new Receso;
        $event->start_date = $actual;
        $event->asistencia_id = $activa->id;
        $event->status = '1';
        $event->save();   
        return Redirect::to('asistencia'); 
    }
  
 public function recesocls(Request $request) {        
    $actual = Carbon::now();
    $usuario = Auth::user();
    $activa = Asistencia::where('user_id', $usuario->id )
        ->where('abierto', '1')
        ->first();
    $receso = Receso::where('asistencia_id', $activa->id )
        ->where('status', '1')
        ->first();
     
    $idEvento = $receso->id;
    $event = Receso::find($idEvento);
   
      // tiempos de trabajo y descanso
          $date1Timestamp = strtotime($activa->start_date);
          $date2Timestamp = strtotime($actual);
          $difference = $date2Timestamp - $date1Timestamp;
     
        if($event) {
            $event->end_date = $actual;
            $event->status = '0';
            $event->descanso = $difference/60 ;
            $event->save();
          
            return Redirect::to('asistencia'); 
        }
    }
  
  public function cerrar(Request $request) {        
    $actual = Carbon::now();
    $usuario = Auth::user();
    $activa = Asistencia::where('user_id', $usuario->id )
        ->where('abierto', '1')
        ->first();
    
    $status = User::find($usuario->id);
    if($status){
      $status->sesion = 0;
      $status->save(); 
    }
    $idEvento = $activa->id;
    $event = Asistencia::find($idEvento);
    
            // tiempos de trabajo y descanso
          $date1Timestamp = strtotime($activa->start_date);
          $date2Timestamp = strtotime($actual);
          $difference = $date2Timestamp - $date1Timestamp;
     
        if($event) {
            $event->end_date = $actual;
            $event->abierto = '0';
            $event->trabajadas = $difference/60 ;
            $event->save();

            \Session::flash('success','La reservación se actualizó correctamente.');
            return Redirect::to('asistencia'); 
        }
    }
  
  
public function reporte()
    {
        //
      $registros = User::orderBy('id','DESC')->paginate(10);
        return view('reporte',compact('registros')); 
    }
  
public function reportes($id){
     $actual = Carbon::now();
     $usuario = User::find($id);
     $registros = Asistencia::where('user_id', $id)->whereMonth('created_at', '12');
     $datos= $registros->get();
     $puntuales = $registros->whereTime('start_date','<=','09:16:00')->get();
     $trabajadas = $datos->sum('trabajadas');
     $cart = array();
      
foreach ($datos as $dato) {   
    $sr = $dato->trabajadas;
    $rr =  $dato->recesos->sum('descanso');
    $trabajadasok = $sr - $rr;
    $cart[] = array( $dato->start_date, ($dato->trabajadas - $dato->recesos->sum('descanso'))/60 );
}     

//Grafica asistencia
      
$finances = Lava::DataTable();              
$finances->addDateColumn('Fecha')
         ->addNumberColumn('Horas Trabajadas')
         ->addRows($cart);
      
Lava::ColumnChart('Finances', $finances, [
    'title' => 'Horas Trabajadas en el periodo',
    'colors'=> [ '#b5bcbd', '#d7e8f3','#333333',],
    'height'            => 400,
]);
     
      
      //Grafica inasistencias
      $asistencia = \Lava::DataTable();
      $ina = 22 - $datos->count();
      $asistencia ->addStringColumn('Asistencias')
              ->addNumberColumn('Inasistencias')
              ->addRow(['Asistencias', $datos->count()])
              ->addRow(['Inasistencias', $ina]);


      Lava::DonutChart('GA', $asistencia, [
          'title' => 'Porcentaje de Asistencias en el periodo',
           'is3D'   => false,
           'colors'=> [ '#b1d3e6','#333333',],
            'fontName'          => 'helvetica',
             'height'            => 400,
      ]);
      
      
      //Grafica puntualidad
            $impu = $datos->count() - $puntuales->count();
            $puntualidad = \Lava::DataTable();
            $puntualidad->addStringColumn('Reasons')
                    ->addNumberColumn('Percent')
                    ->addRow(['Inicios Puntuales.', $puntuales->count()])
                    ->addRow(['Retraso.', $impu]);


            Lava::DonutChart('GP', $puntualidad, [
                'title' => 'Porcentaje de puntualidad en el periodo',
                 'is3D'   => false,
                 'colors'=> [ '#b1d3e6','#333333',],
                  'fontName'          => 'helvetica',
                   'height'            => 400,
            ]);
      
        return view('reportes', compact('actual','registros','asistencia','puntualidad','puntuales','datos','finances','usuario') );
    }
  
       
  
}
