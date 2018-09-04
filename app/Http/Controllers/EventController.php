<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Event;
 
use Calendar;
 
class EventController extends Controller
{
  
    public function dateValidation($sala2, $startDate2, $endDate2) {
         $sala = $sala2;
         $startDate = $startDate2;
         $endDate = $endDate2;
         $taken = false;   
      
         $events = Event::where('sala', $sala)->where([ ['start_date','<=',$startDate], ['end_date', '>=', $startDate] ])
                     ->count();
         $events2 = Event::where('sala', $sala)->where([ ['start_date','<=',$endDate], ['end_date', '>=', $endDate] ])
                     ->count();
         $events3 = Event::where('sala', $sala)
                     ->whereBetween('start_date', [$startDate, $endDate])
                     ->count();
         $events4 = Event::where('sala', $sala)
                     ->whereBetween('end_date', [$startDate, $endDate])
                     ->count();
      
         if($events || $events2 || $events3 || $events4){
             $taken = true;  
         }
         
      return $taken;
          
     
     
    
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

        return view('/frida', compact('calendar_details','meventos') );
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
        if($this->dateValidation('frida', $request->start_date, $request->end_date)){
          \Session::flash('warnning','La sala ya esta ocupada, ingresa una fecha y hora disponible');
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
 
        return view('/neza', compact('calendar_details') );
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
        if($this->dateValidation('neza', $request->start_date, $request->end_date)){
          \Session::flash('warnning','La sala ya esta ocupada, ingresa una fecha y hora disponible');
            return Redirect::to('/neza')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = '1';
        $event->sala = 'neza';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('neza');
    }
  public function indexp(){
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
 
        return view('/paz', compact('calendar_details') );
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
        if($this->dateValidation('paz', $request->start_date, $request->end_date)){
          \Session::flash('warnning','La sala ya esta ocupada, ingresa una fecha y hora disponible');
            return Redirect::to('/paz')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->usuario = '1';
        $event->sala = 'paz';
        $event->save();
 
        \Session::flash('success','Sala reservada exitosamente.');
        return Redirect::to('paz');
    }
    public function indexm(){
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
 
        return view('/molina', compact('calendar_details') );
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
        if($this->dateValidation('molina', $request->start_date, $request->end_date)){
          \Session::flash('warnning','La sala ya esta ocupada, ingresa una fecha y hora disponible');
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
    	$events = Event::where('sala', 'rolf')->get();
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
 
        return view('/rolf', compact('calendar_details') );
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
       if($this->dateValidation('rolf', $request->start_date, $request->end_date)){
          \Session::flash('warnning','La sala ya esta ocupada, ingresa una fecha y hora disponible');
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
    	$events = Event::where('sala', 'refugio')->get();
      
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
 
        return view('/refugio', compact('calendar_details') );
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
        if($this->dateValidation('refugio', $request->start_date, $request->end_date)){
          \Session::flash('warnning','La sala ya esta ocupada, ingresa una fecha y hora disponible');
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
  
  
}