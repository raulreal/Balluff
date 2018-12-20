<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Validator;
use App\Asistencia;
use App\Receso;
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
    
        $event = new Asistencia;
        $event->start_date = $actual;
        $event->user_id = Auth::user()->id;
        $event->abierto = '1';
        $event->save();
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
    $inicio = new DateTime($receso->start_date);
    $final = new DateTime($actual);

    $diff = $inicio->diff($final);
     
        if($event) {
            $event->end_date = $actual;
            $event->status = '0';
            $event->descanso = $diff->i ;
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
    
    $idEvento = $activa->id;
    $event = Asistencia::find($idEvento);
    $inicio = new DateTime($activa->start_date);
    $final = new DateTime($actual);

    $diff = $inicio->diff($final);
     
        if($event) {
            $event->end_date = $actual;
            $event->abierto = '0';
            $event->trabajadas = $diff->i ;
            $event->save();

            \Session::flash('success','La reservación se actualizó correctamente.');
            return Redirect::to('asistencia'); 
        }
    }
  
  
    public function reportes(){
     $usuario = Auth::user();
     $actual = Carbon::now();

     $products = Asistencia::whereMonth('created_at', '12')
            ->get();
     dd($products->trabajadas);

        return view('reportes', compact('actual','usuario') );
    }
  
}
