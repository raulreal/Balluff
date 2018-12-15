<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Event;
use Carbon\Carbon;
use Calendar;
 
class EventController extends Controller
{
  
    public function dateValidation($sala2, $startDate2, $endDate2) {
         $sala = $sala2;
         $startDate = $startDate2;
         $endDate = $endDate2;
         $taken = false;
         $response = [$taken, ""];
     
         $events = Event::where('sala', $sala)->where([ ['start_date','<=',$startDate], ['end_date', '>', $startDate] ])
                     ->with('reservador')->first();
         $events1 = Event::where('sala', $sala)->where([ ['start_date','<',$endDate], ['end_date', '>=', $endDate] ])
                     ->with('reservador')->first();
         $events2 = Event::where('sala', $sala)
                     ->where('start_date','!=',$endDate)
                     ->whereBetween('start_date', [$startDate, $endDate])
                     ->with('reservador')->first();
         $events3 = Event::where('sala', $sala)
                     ->where('end_date', '!=', $startDate)
                     ->whereBetween('end_date', [$startDate, $endDate])
                     ->with('reservador')->first();
      
         if($events && !$taken) {
             $taken = true;
             $response = [$taken, $events->reservador->name, $events->reservador->apellido];
         }
         if($events1 && !$taken) {
             $taken = true;
             $response = [$taken, $events1->reservador->name, $events1->reservador->apellido];
         }
         if($events2 && !$taken) {
             $taken = true;
             $response = [$taken, $events2->reservador->name, $events2->reservador->apellido];
         }
         if($events3 && !$taken) {
             $taken = true;
             $response = [$taken, $events3->reservador->name, $events3->reservador->apellido];
         }
      
      return $response;
    }
    
    public function permisoReservarSala($usuario, $sala) {
      $permisoSala = $usuario->roles->pluck('name')->toArray();
      return in_array($sala, $permisoSala);
    }

    public function index(){
      $events = Event::where('sala', 'juntas')->get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
          $event->id
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
 
        return view('events', compact('calendar_details') );
    }
 
    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
          
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'juntas';
      
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('/events');
    }
 
  
   public function indexf() {
      $usuario = Auth::user()->id;
      $events = Event::where('sala', 'frida')->get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
          $event->id
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
     
     $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();

        return view('/frida', compact('calendar_details','meventos','hoy') );
    }
  
 public function addEventf(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/frida')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('frida', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
            return Redirect::to('/frida')->withInput()->withErrors($validator);
        }
   
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'frida';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('frida');
    }
    public function indexn(){
      $usuario = Auth::user()->id;
    	$events = Event::where('sala', 'neza')->get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
          $event->id
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
      
           $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();
 
        return view('/neza', compact('calendar_details','meventos','hoy') );
    }
  
 public function addEventn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/neza')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('neza', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
          return Redirect::to('/neza')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'neza';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('neza');
    }
  public function indexp(){
    $usuario = Auth::user()->id;
    	$events = Event::where('sala', 'paz')->get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
          $event->id
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
         $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();
 
        return view('/paz', compact('calendar_details','meventos','hoy') );
    }
  
 public function addEventp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/paz')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('paz', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
            return Redirect::to('/paz')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'paz';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('paz');
    }
    public function indexm(){
      $usuario = Auth::user()->id;
    	$events = Event::where('sala', 'molina')->get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
          $event->id
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
           $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();
 
        return view('/molina', compact('calendar_details','meventos','hoy') );
    }
  
 public function addEventm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/molina')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('molina', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
            return Redirect::to('/molina')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'molina';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('molina');
    }
      public function indexro(){
        $usuario = Auth::user()->id;
    	  $events = Event::where('sala', 'rolf')->get();
        $permisoReserva = $this->permisoReservarSala(Auth::user(), 'rolf');
    	  $event_list = [];
        foreach ($events as $key => $event) {
          $event_list[] = Calendar::event(

              $event->event_name,
                  false,
                  new \DateTime($event->start_date),
                  new \DateTime($event->end_date),
            $event->id
              );
        }
        $calendar_details = Calendar::addEvents($event_list); 
               $meventos=$events->where('usuario', $usuario )->all();
       $hoy = Carbon::now();
 
        return view('/rolf', compact('calendar_details','meventos','hoy', 'permisoReserva') );
    }
  
 public function addEventro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/rolf')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('rolf', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
            return Redirect::to('/rolf')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'rolf';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('rolf');
    }
  
    public function indexr(){
      $usuario = Auth::user()->id;
    	$events = Event::where('sala', 'refugio')->get();
      $permisoReserva = $this->permisoReservarSala(Auth::user(), 'refugio');
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
             $event->id,
                        [
                          'color' => 'black',
                          'slotEventOverlap' =>  false,
                        ]
                );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
           $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();
 
        return view('/refugio', compact('calendar_details','meventos','hoy', 'permisoReserva') );
    }
  
 public function addEventr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/refugio')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('refugio', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
          return Redirect::to('/refugio')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'refugio';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('refugio');
    }
  
  
  
     public function indexr1(){
      $usuario = Auth::user()->id;
    	$events = Event::where('sala', 'refugio1')->get();
      $permisoReserva = $this->permisoReservarSala(Auth::user(), 'refugio');
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
             $event->id,
                        [
                          'color' => 'black',
                          'slotEventOverlap' =>  false,
                        ]
                );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
           $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();
 
        return view('/refugio1', compact('calendar_details','meventos','hoy', 'permisoReserva') );
    }
  
 public function addEventr1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/refugio1')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('refugio1', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
          return Redirect::to('/refugio1')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'refugio1';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('refugio1');
    }
  
  
       public function indexr2(){
      $usuario = Auth::user()->id;
    	$events = Event::where('sala', 'refugio2')->get();
      $permisoReserva = $this->permisoReservarSala(Auth::user(), 'refugio');
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
             $event->id,
                        [
                          'color' => 'black',
                          'slotEventOverlap' =>  false,
                        ]
                );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
           $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();
 
        return view('/refugio2', compact('calendar_details','meventos','hoy', 'permisoReserva') );
    }
  
 public function addEventr2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/refugio2')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('refugio2', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
          return Redirect::to('/refugio2')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'refugio2';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('refugio2');
    }
  
  
       public function indexr3(){
      $usuario = Auth::user()->id;
    	$events = Event::where('sala', 'refugio3')->get();
      $permisoReserva = $this->permisoReservarSala(Auth::user(), 'refugio');
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
               
            $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
             $event->id,
                        [
                          'color' => 'black',
                          'slotEventOverlap' =>  false,
                        ]
                );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
           $meventos=$events->where('usuario', $usuario )->all();
     $hoy = Carbon::now();
 
        return view('/refugio3', compact('calendar_details','meventos','hoy', 'permisoReserva') );
    }
  
 public function addEventr3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/refugio3')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('refugio', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
          return Redirect::to('/refugio3')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = Auth::user()->id;
        $event->sala = 'refugio3';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('refugio3');
    }
  
  
  public function editar($id) {
        $event = Event::find($id);
        if($event) {
          return view('editarEvento', compact('event') );
        }        
  }
  
   public function actualizar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Revisa la informacíon');
            return Redirect::to('/refugio')->withInput()->withErrors($validator);
        }
        $validarFecha = $this->dateValidation('refugio', $request->start_date, $request->end_date);
        if($validarFecha[0]){
          \Session::flash('warnning','La sala ya esta ocupada, fue reservada por '.$validarFecha[1].' '.$validarFecha[2].'. Por favor ingresa una fecha y hora disponible');
          return Redirect::to('/refugio')->withInput()->withErrors($validator);
        }
        
        $idEvento = $request->id_evento;
        $event = Event::find($idEvento);
     
        if($event) {
            $event->event_name = $request->event_name;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->save();

            \Session::flash('success','La reservación se actualizó correctamente.');
            return Redirect::to($event->sala);  
        }
    }
  
  
  public function eliminar($id) {
      
      $evento = Event::find($id);
      if($evento) {
          $retorno = $evento->sala;
          $evento->delete();
        
          \Session::flash('success','La reservación se eliminó correctamente.');
          return Redirect::to($retorno);
      }
     
     \Session::flash('error','No se encontro la reservación seleccionada.');
     return Redirect::back();
  }
  
  
  
  
  
}