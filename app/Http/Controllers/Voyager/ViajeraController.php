<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Validator;
use App\User;
use App\Viajera;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteEvaluacion;

 
class ViajeraController extends Controller
{
       
    public function index(Request $request)
    {
        $registros = null;
        $usr = Auth::user();
        $nombre    = $request->nombre;
        $apellido  = $request->apellido;
        $empleados = ($request->empleados == "mios")? $usr->id : "";
        $ocultarJefe = true;
        
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        if ($permisoRh)
             $registros = User::whereNotNull('id');
        else if($usr->puesto == 'Líder de Calidad')
            $registros = User::whereHas('viajera', function ($query) { $query->WhereNull('f_calidad'); });
        else {
            $ocultarJefe = false;
            $registros = User::where('jefe_id', Auth::user()->id);
        }
      
        $registros = $registros->nombre($nombre)
                               ->apellido($apellido)
                               ->misEmpleados($empleados)
                               ->orderBy('name')
                               ->paginate(12);
      
        return view('viajera.index',compact('registros', 'usr', 'ocultarJefe'));
    }
  
    public function create(Request $request)
    {
        $usuario = User::find($request->user_id); 
        $fecha = Carbon::now();
        return view('viajera.create',compact('fecha','usuario'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Viajera::create($request->all());
        return redirect()->route('viajera.index')->with('success','Registro creado satisfactoriamente');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $usr = Auth::user();
        $registros = Viajera::find($id);
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        $resutado = true;
        
        //Evaluar de que boton viene
        if($request->descargar_pdf) {
            $view =  \View::make('viajera.showPdf', compact('registros', 'resutado'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('reporte-viaje.pdf');
        }
        else if($request->enviar_pdf) {
        	    $estado = 'success';
        	    $mensaje = 'El reporte se envio correctamete.';
        	    
        	    if($request->email_evalucion) {
        	        $correo = $request->email_evalucion;
        	        $pdf = \App::make('dompdf.wrapper');
            	    $pdf->loadView('viajera.showPdf', compact('registros', 'resutado'));
                    
                  try {
                    Mail::raw('Hoja viajera', function($message) use($pdf, $correo)
                      {
                          $message->from('no-reply@balluff.com', 'Balluff');
                          $message->to($correo)->subject('Hoja viajera');
                          $message->attachData($pdf->output(), "Hoja_viajera.pdf");
                      });
                    
                  }
                  catch ( \Exception $e) {
                      $estado = 'error';
                      $mensaje = 'El reporte no se envio.';
                  }
        	    }
              return redirect()->route('viajera.show', $registros->id )->with($estado, $mensaje);
    	    }
      
        //return view( 'viajera.showPdf', compact('registros', 'resutado') );
        return  view('viajera.show',compact('usuario','id','usr','registros','permisoRh'));

    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
      
        $registros = Desenpeno::find($id);       
        return view('viajera.edit', compact('registros', 'id'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {
        //
        $this->validate($request,[ 'id'=>'required' ]);
         Viajera::find($id)->update($request->all());
        
        return redirect()->route('viajera.index')->with('success','Registro actualizado satisfactoriamente');
 
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Viajera::find($id)->delete();
        return redirect()->route('viajera.index')->with('success','Registro eliminado satisfactoriamente');
    }
  
   public function firma(Request $request)
    {
      $firma = Viajera::find($request->user_id);
          if($firma){
            $firma->f_calidad = 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Hoja firmada.');
    }
      public function firma1(Request $request)
    {
      $firma = Viajera::find($request->user_id);
          if($firma){
            $firma->f_jefe= 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Hoja firmada.');
    }
      public function firma2(Request $request)
    {
      $firma = Viajera::find($request->user_id);
          if($firma){
            $firma->f_rh = 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Hoja firmada.');
    }
  
   public function mievaluacion()
    {
   
    $usr = Auth::user();
   
   if ( !empty($usr->viajera) ) {
        return redirect()->route('viajera.show', $usr->viajera->id);
     } else {
       return redirect()->route('viajera.create',  ['user_id'=>$usr->id]  );
   }}
  
  
   
}