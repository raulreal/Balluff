<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Validator;
use App\Asistencia;
use DateTime;


class AsistenciaController extends Controller
{
  
   public function index(){
     
     $usuario = Auth::user();

     $actual = Carbon::now();   
     $activa = Asistencia::where('user_id', $usuario->id )
        ->where('abierto', '1')
        ->first();
     
     
        return view('asistencia', compact('actual','usuario','activa') );
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
  
  public function editar($id) {
        $event = Event::find($id);
        if($event) {
          return view('editarEvento', compact('event') );
        }        
  }
  
  public function actualizar(Request $request)
    {        
    $actual = Carbon::now();
    $usuario = Auth::user();
    $activa = Asistencia::where('user_id', $usuario->id )
        ->where('abierto', '1')
        ->first();
    
    $idEvento = $activa->id;
    $event = Asistencia::find($idEvento);
     
        if($event) {
            $event->end_date = $actual;
            $event->abierto = '0';
            $event->save();

            \Session::flash('success','La reservación se actualizó correctamente.');
            return Redirect::to('asistencia'); 
        }
    }
  
}
