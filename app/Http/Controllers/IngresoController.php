<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Validator;
use App\User;
use App\Ingreso;

use Illuminate\Support\Facades\Mail;

 
class IngresoController extends Controller
{

   
    public function index(Request $request)
    {
        $usr = Auth::user();
        $registros = null;
        $nombre    = $request->nombre;
        $apellido  = $request->apellido;
        $empleados = ($request->empleados == "mios")? $usr->id : "";
        $ocultarJefe = true;
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
            
       if ($permisoRh)
           $registros = User::whereNotNull('id');
       else
           $registros = User::where('jefe_id', Auth::user()->id);

       $registros = $registros->nombre($nombre)
                              ->apellido($apellido)
                              ->misEmpleados($empleados)
                              ->orderBy('name')
                              ->paginate(12);
       
       return view('ingreso.index',compact('registros', 'usr', 'ocultarJefe')); 
    }
  

    public function create(Request $request)
    {
        $usuario = User::find($request->user_id); 
        $fecha = Carbon::now();
        return view('ingreso.create',compact('fecha','usuario'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingreso = Ingreso::create($request->all());
        
        return redirect()->route('ingreso.index')->with('success','Registro creado satisfactoriamente');
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
        $registros = Ingreso::find($id);
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        if($request->descargar_pdf) {
            $view =  \View::make('ingreso.showPdf', compact('registros', 'resutado'))->render();
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
            	    $pdf->loadView('ingreso.showPdf', compact('registros', 'resutado'));
                    
                  try {
                    Mail::raw('Evaluación de nuevo ingreso', function($message) use($pdf, $correo)
                      {
                          $message->from('no-reply@balluff.com', 'Balluff');
                          $message->to($correo)->subject('Evaluación de nuevo ingreso');
                          $message->attachData($pdf->output(), "Evaluacin_nuevo_ingreso.pdf");
                      });
                    
                  }
                  catch ( \Exception $e) {
                      $estado = 'error';
                      $mensaje = 'El reporte no se envio.';
                  }
        	    }
              return redirect()->route('ingreso.show', $registros->id )->with($estado, $mensaje);
    	    }
      
        return  view('ingreso.show',compact('usuario','id','usr','registros','permisoRh'));

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
        return view('ingreso.edit', compact('registros', 'id'));
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
         Ingreso::find($id)->update($request->all());
        
        return redirect()->route('ingreso.index')->with('success','Registro actualizado satisfactoriamente');
 
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
         Ingreso::find($id)->delete();
        return redirect()->route('ingreso.index')->with('success','Registro eliminado satisfactoriamente');
    }
  
   public function firma(Request $request)
    {
      $firma = Ingreso::find($request->user_id);
          if($firma){
            $firma->f_empleado = 1;
            $firma->fechafirma_e = Carbon::now();
            $firma->save(); 
          }
              return redirect()->route('ingreso.index')->with('success','Evaluacion firmada.');
    }
      public function firma1(Request $request)
    {
      $firma = Ingreso::find($request->user_id);
          if($firma){
            $firma->f_jefe= 1;
            $firma->fechafirma_j = Carbon::now();
            $firma->save(); 
          }
              return redirect()->route('ingreso.index')->with('success','Evaluacion firmada.');
    }
      public function firma2(Request $request)
    {
      $firma = Ingreso::find($request->user_id);
          if($firma){
            $firma->f_rh = 1;
            $firma->fechafirma_rh = Carbon::now();
            $firma->save(); 
          }
       return redirect()->route('ingreso.index')->with('success','Evaluacion firmada.');
    }
  
   public function mievaluacion()
    {
   
    $usr = Auth::user();
   
   if ( !empty($usr->ingreso) ) {
        return redirect()->route('ingreso.show', $usr->ingreso->id);
     } else {
       return redirect()->back()->with('message', 'No cuentas con evaluacion de Ingreso.');
   }}
  
   
}