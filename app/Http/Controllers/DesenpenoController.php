<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Carbon\Carbon;
use App\User;
use App\Desenpeno;
use App\Opcion;

use App\Exports\RevisionExport;
use Maatwebsite\Excel\Facades\Excel;


 
class DesenpenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fechaRestriccion($fecha) {
        
        if($fecha && $fecha->valor) {
            $fechaTexto = date('Y').'-'.$fecha->valor.' 00:00:00';
            return Carbon::createFromFormat('Y-m-d H:i:s', $fechaTexto);
        }
        
        return null;
    }
    
    public function opcionesRestrccion() {
        $fechaRestriccion = [
            'objetivos' => true,
            'revision1' => true,
            'revision2' => true
        ];
        
        $objetivoInicio  = $this->fechaRestriccion( Opcion::where('nombre', 'objetivos_inicio' )->first() );
        $objetivoFin     = $this->fechaRestriccion( Opcion::where('nombre', 'objetivos_fin' )->first() );
        $revision1Inicio = $this->fechaRestriccion( Opcion::where('nombre', 'revision_1_incio' )->first() );
        $revision1Fin    = $this->fechaRestriccion( Opcion::where('nombre', 'revision_1_fin' )->first() );
        $revision2Inicio = $this->fechaRestriccion( Opcion::where('nombre', 'revision_2_incio' )->first() );
        $revision2Fin    = $this->fechaRestriccion( Opcion::where('nombre', 'revision_2_fin' )->first() );
        
        if($objetivoInicio && date('Y-m-d H:i:s') < $objetivoInicio)
            $fechaRestriccion['objetivos'] = false;
        if($objetivoFin && date('Y-m-d H:i:s') > $objetivoFin )
            $fechaRestriccion['objetivos'] = false;
        
        if($revision1Inicio && date('Y-m-d H:i:s') < $revision1Inicio)
            $fechaRestriccion['revision1'] = false;
        if($revision1Fin && date('Y-m-d H:i:s') > $revision1Fin)
            $fechaRestriccion['revision1'] = false;
        
        if($revision2Inicio && date('Y-m-d H:i:s') < $revision2Inicio)
            $fechaRestriccion['revision2'] = false;
        if($revision2Fin && date('Y-m-d H:i:s') > $revision2Fin)
            $fechaRestriccion['revision2'] = false;
        
        return $fechaRestriccion;
    }
   
    
    public function index(Request $request)
    {
		
		    if($request->exportar_excel) {
            $documento = "Revisiones.xlsx";
            return Excel::download(new RevisionExport( $request->revision ), $documento);
        }
		
        $nombre   = $request->nombre;
        $apellido = $request->apellido;
        
        $fechaRestriccion = $this->opcionesRestrccion();
      
        $registros = User::orderBy('name')
                         ->nombre($nombre)
                         ->apellido($apellido)
                         ->paginate(12)
                         ->appends($request->all());
        
        return view('evaluacion.index',compact('registros', 'fechaRestriccion')); 
    }
  
    public function indexjfe(Request $request)
    {
        
        $nombre   = $request->nombre;
        $apellido = $request->apellido;
        
        $fechaRestriccion = $this->opcionesRestrccion();
        
        $registros = User::nombre($nombre)
                         ->apellido($apellido)
                         ->where('jefe_id', Auth::user()->id)
                         ->orderBy('name')
                         ->paginate(12)
                         ->appends($request->all());

        return view('evaluacion.indexjfe', compact('registros', 'fechaRestriccion'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $usuario = User::find($request->user_id); 
        $fecha = Carbon::now();
        
        return view('evaluacion.create',compact('usuario','fecha'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'objetivo1'=>'required', 
            'peso_oindividuales'=>'required',
            'peso_oadmon'=>'required',
            'peso_ocultura'=>'required'
        ]);
        
        Desenpeno::create($request->all());
        
        return redirect()->route('evaluacion.indexjfe')
                         ->with('success','Registro creado satisfactoriamente');
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
        $registros = Desenpeno::find($id);
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        $resutado = true;
        //Evaluar de que boton viene
        if($request->descargar_pdf) {
            $view =  \View::make('evaluacion.editPdf', compact('registros', 'resutado'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('reporte.pdf');
        }
        else if($request->enviar_pdf) {
        	    $estado = 'success';
        	    $mensaje = 'El reporte se envio correctamete.';
        	    
        	    if($request->email_evalucion) {
        	        $correo = $request->email_evalucion;
        	        $pdf = \App::make('dompdf.wrapper');
            	    $pdf->loadView('evaluacion.editPdf', compact('registros', 'resutado'));
                    
                  try {
                    Mail::raw('Evaluación de Desempeño', function($message) use($pdf, $correo)
                      {
                          $message->from('no-reply@balluff.com', 'Balluff');
                          $message->to($correo)->subject('Evaluación de Desempeño');
                          $message->attachData($pdf->output(), "Evaluacion_de_Desempeno.pdf");
                      });
                    
                  }
                  catch ( \Exception $e) {
                      $estado = 'error';
                      $mensaje = 'El reporte no se envio.';
                  }
        	    }
              return redirect()->route('evaluaciones.edit', $registros->id )->with($estado, $mensaje);
    	    }
        
        return  view('evaluacion.show',compact('registros', 'usr', 'permisoRh', 'id'));
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
        //Evaluar de que boton viene
        if($request->descargar_pdf) {
            $view =  \View::make('evaluacion.editPdf', compact('registros'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('reporte.pdf');
        }
        else if($request->enviar_pdf) {
        	    $estado = 'success';
        	    $mensaje = 'El reporte se envio correctamete.';
        	    
        	    if($request->email_evalucion) {
        	        $correo = $request->email_evalucion;
        	        $pdf = \App::make('dompdf.wrapper');
            	    $pdf->loadView('evaluacion.editPdf', compact('registros'));
                    
                  try {
                    Mail::raw('Evaluación de Desempeño', function($message) use($pdf, $correo)
                      {
                          $message->from('no-reply@balluff.com', 'Balluff');
                          $message->to($correo)->subject('Evaluación de Desempeño');
                          $message->attachData($pdf->output(), "Evaluacion_de_Desempeno.pdf");
                      });
                    
                  }
                  catch ( \Exception $e) {
                      $estado = 'error';
                      $mensaje = 'El reporte no se envio.';
                  }
        	    }
              return redirect()->route('evaluaciones.edit', $registros->id )->with($estado, $mensaje);
    	    }
        
        return view('evaluacion.edit', compact('registros', 'id'));
    }
  
    public function editob($id, Request $request)
    {
      
        $registros = Desenpeno::find($id);
        //Evaluar de que boton viene
        if($request->descargar_pdf) {
            $view =  \View::make('evaluacion.editPdf', compact('registros'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('reporte.pdf');
        }
        else if($request->enviar_pdf) {
        	    $estado = 'success';
        	    $mensaje = 'El reporte se envio correctamete.';
        	    
        	    if($request->email_evalucion) {
        	        $correo = $request->email_evalucion;
        	        $pdf = \App::make('dompdf.wrapper');
            	    $pdf->loadView('evaluacion.editPdf', compact('registros'));
                    
                  try {
                    Mail::raw('Evaluación de Desempeño', function($message) use($pdf, $correo)
                      {
                          $message->from('no-reply@balluff.com', 'Balluff');
                          $message->to($correo)->subject('Evaluación de Desempeño');
                          $message->attachData($pdf->output(), "Evaluacion_de_Desempeno.pdf");
                      });
                    
                  }
                  catch ( \Exception $e) {
                      $estado = 'error';
                      $mensaje = 'El reporte no se envio.';
                  }
        	    }
              return redirect()->route('evaluaciones.objetivos', $registros->id )->with($estado, $mensaje);
    	    }
        
        return view('evaluacion.objetivos', compact('registros', 'id'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {
        
        $this->validate($request,[ 'objetivo1'=>'required' ]);
        Desenpeno::find($id)->update($request->all());
        
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
        //
         Desempeno::find($id)->delete();
        return redirect()->route('evaluacion.indexjfe')->with('success','Registro eliminado satisfactoriamente');
    }
  
    public function firma(Request $request)
    {
      $firma = Desenpeno::find($request->user_id);
          if($firma){
            $firma->f_empleado = 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
    
    public function firma1(Request $request)
    {
      $firma = Desenpeno::find($request->user_id);
          if($firma){
            $firma->f_jefe= 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
    
    public function firma2(Request $request)
    {
      $firma = Desenpeno::find($request->user_id);
          if($firma){
            $firma->f_rh = 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
    
    public function mievaluacion() {
		//Si el usuario ya tiene una evaluación se verifica si tiene reviciones y se muestra la mas reciente, si no tiene se muestra la evaluación(definición de objetivos)
        $usr = Auth::user();
		$evaluacionActual = $usr->desenpeno;
        if($evaluacionActual) {
			
			$revision1 = $evaluacionActual->revisiones()->where('tipo', 1)->first();
			$revision2 = $evaluacionActual->revisiones()->where('tipo', 2)->first();
			
			if($revision2) 
				return redirect()->route('revision.show', $revision2->id);
			
			elseif($revision1)
				return redirect()->route('revision.show', $revision1->id);
			
            return redirect()->route('evaluaciones.show', $usr->desenpeno->id);
        }
        else {
            return redirect()->back()->with('message', 'No cuentas con evaluaciones de desempeño.');
        }
    }
    
    
}