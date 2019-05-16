<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Validator;
use App\User;
use App\Desenpeno;
use App\Revision;

use Illuminate\Support\Facades\Mail;

 
class RevisionController extends Controller
{
    public function index(Request $request)
    {
        $registros=Revision::orderBy('id','DESC')->paginate(3);
        $usr = Auth::user();
        
        return view('revision.index', compact('registros', 'usr', 'permisoRh')); 
    }
    
    public function create(Request $request)
    {
      $this->validate($request, [ 
          'id'=>'required',
          'revision'=>'required'
      ]);
        
      $evaluacionId = $request->id;
      $tipo = $request->revision; // 
      $registros = Desenpeno::find($evaluacionId); 
      $fecha = Carbon::now();
      
      //Validar que no tenga esa revisión  $numeroRevicion
      
      return view('revision.create',compact('registros','fecha', 'tipo'));
    }
 
    public function store(Request $request)
    {
        Revision::create($request->except('peso1','peso2','peso3','peso4','peso5','peso6','peso7',
                                          'peso8','peso9','peso10','peso11','peso12','peso13'));
        
        return redirect()->route('evaluacion.indexjfe')->with('success','Registro creado satisfactoriamente');
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
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        $resutado = true;
        $revision = Revision::find($id);
        $registros = $revision->desenpeno;
        
        $revision->totalCSP = ($revision->total1 * $registros->peso_oindividuales)/100;
        $revision->totalAdmon = ($revision->total2 * $registros->peso_oadmon)/100;
        $revision->totalCultura = ($revision->total3 * $registros->peso_ocultura)/100;
        $revision->total = $revision->totalCSP + $revision->totalAdmon + $revision->totalCultura;
        
        if($request->descargar_pdf) {
            $view =  \View::make('revision.showPdf', compact('registros', 'revision', 'usr', 'permisoRh', 'id'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('Reporte_revisión.pdf');
        }
        else if($request->enviar_pdf) {
        	    $estado = 'success';
        	    $mensaje = 'El reporte se envio correctamete.';
        	    
        	    if($request->email_evalucion) {
        	        $correo = $request->email_evalucion;
        	        $pdf = \App::make('dompdf.wrapper');
            	    $pdf->loadView('revision.showPdf', compact('registros', 'revision', 'usr', 'permisoRh', 'id'));
                    
                  try {
                    Mail::raw('Revisión de Evaluación de Desempeño', function($message) use($pdf, $correo)
                      {
                          $message->from('no-reply@balluff.com', 'Balluff');
                          $message->to($correo)->subject('Revisión de Evaluación de Desempeño');
                          $message->attachData($pdf->output(), "Revision_Evaluacion_de_Desempeno.pdf");
                      });
                    
                  }
                  catch ( \Exception $e) {
                      $estado = 'error';
                      $mensaje = 'El reporte no se envio.';
                  }
        	    }
              return redirect()->route('evaluaciones.edit', $registros->id )->with($estado, $mensaje);
    	    }
      
        return  view('revision.show',compact('registros', 'revision', 'usr', 'permisoRh', 'id'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $revision = Revision::find($id);
        $registros = $revision->desenpeno;
      
        $revision->totalCSP = ($revision->total1 * $registros->peso_oindividuales)/100;
        $revision->totalAdmon = ($revision->total2 * $registros->peso_oadmon)/100;
        $revision->totalCultura = ($revision->total3 * $registros->peso_ocultura)/100;
        $revision->total = $revision->totalCSP + $revision->totalAdmon + $revision->totalCultura;
      
        return view('revision.edit', compact('registros', 'revision', 'id'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $revision = Revision::find($id);
        $revision->update( $request->only(  "alcanzada1", "ponderacion1", "comentarios1", "alcanzada2", "ponderacion2", "comentarios2",
                                            "alcanzada3", "ponderacion3", "comentarios3", "alcanzada4", "ponderacion4", "comentarios4",
                                            "alcanzada5", "ponderacion5", "comentarios5", "alcanzada6", "ponderacion6", "comentarios6",
                                            "alcanzada7", "ponderacion7", "comentarios7", "alcanzada8", "ponderacion8", "comentarios8",
                                            "alcanzada9", "ponderacion9", "comentarios9", "alcanzada10", "ponderacion10", "comentarios10",
                                            "alcanzada11", "ponderacion11", "comentarios11", "alcanzada12", "ponderacion12", "comentarios12",
                                            "alcanzada13", "ponderacion13", "comentarios13", "total1", "total2", "total3") );
        
        return redirect()->route('evaluacion.indexjfe')->with('success','Registro actualizado satisfactoriamente');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Desempeno::find($id)->delete();
         return redirect()->route('evaluacion.indexjfe')->with('success','Registro eliminado satisfactoriamente');
    }
  
    public function firma(Request $request)
    {
      $firma = Revision::find($request->user_id);
          if($firma){
            $firma->f_empleado = 1;
            $firma->save(); 
          }
       return redirect()->route('evaluacion.indexjfe')->with('success', 'Evaluacion firmada.');
    }
    
    public function firma1(Request $request)
    {
        $firma = Revision::find($request->user_id);
        if($firma){
            $firma->f_jefe= 1;
            $firma->save(); 
        }
       return redirect()->route('evaluacion.indexjfe')->with('success', 'Evaluacion firmada.');
    }
    
    public function firma2(Request $request)
    {
        $firma = Revision::find($request->user_id);
        if($firma){
            $firma->f_rh = 1;
            $firma->save(); 
        }
        return redirect()->route('evaluacion.indexjfe')->with('success', 'Evaluacion firmada.');
    }
    
}