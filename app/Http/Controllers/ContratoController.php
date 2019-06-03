<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Validator;
use App\User;
use App\Contrato;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteEvaluacion;

 
class ContratoController extends Controller
{

   
    public function index(Request $request)
    {
        $usr = Auth::user();
        $registros = Contrato::status($request->status)
                             ->categoria($request->categoria) 
                             ->nombre($request->nombre)
                             ->orderBy('id')
                             ->paginate(12)
                             ->appends($request->all());
      
      
      foreach ($registros as $p) {
      $perro = $p->id;
      }

             return view('contratos.index',compact('registros','usr','perro')); 
    }
  
    public function create()
    {
        $usuario = Auth::user();
        $fecha = Carbon::now();
        return view('contratos.create',compact('fecha','usuario'));
      
    }
 
    public function store(Request $request)
    {
              $input = $request->all();
              $contrato = new Contrato($input);
              $hasFiles = false;

              foreach (range(1, 5) as $i) {
                    $fileId = 'file' . $i;

                    if ($request->hasFile($fileId)) {
                        $hasFiles = true;

                        $file = $request->file($fileId);
                        $destinationPath = storage_path();
                        $filename = $file->getClientOriginalName();
                        $file ->move(public_path().'/storage/contratos/',$filename);

                        $contrato->$fileId = $filename;
                    }
                }

                if ($hasFiles) {
                    $contrato->save();
                }
      
              return redirect()->route('contratos.index')->with('success','Contrato agregado satisfactoriamente');
      
            }

  
    public function show($id, Request $request)
    {
        $usr = Auth::user();
        $registros = Contrato::find($id);
        $fecha = Carbon::now();
        $archivos = $registros;
        $permisosUsuario = $usr->roles->pluck('name')->toArray();

        $permisoGr = in_array('rh', $permisosUsuario);
        return  view('contratos.show',compact('usuario','id','usr','registros','permisoGr','fecha'));

    }
    public function edit($id, Request $request)
    {
      
        $registros = Contrato::find($id);
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        return view('contratos.edit', compact('registros', 'permisoRh','usr'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
      public function update(Request $request, $id)
    {
        $requisicon= Contrato::find($id);
        $requisicon->tipo=$request->get('tipo');
        $requisicon->f_puesto=$request->get('f_puesto');
        $requisicon->tiempo=$request->get('tiempo');
        $requisicon->nombre=$request->get('nombre');
        $requisicon->f_ingreso=$request->get('f_ingreso');
        $requisicon->f_rh=$request->get('f_rh');
        $requisicon->save();
        return redirect()->route('contratos.index')->with('success','Requisicion Revisada.');
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
         Requisicion::find($id)->delete();
        return redirect()->route('requisicion.index')->with('success','Registro eliminado satisfactoriamente');
    }
  
   public function firma(Request $request)
    {
      $firma = Requisicion::find($request->user_id);
          if($firma){
            $firma->f_empleado = 1;
            $firma->fechafirma_e = Carbon::now();
            $firma->save(); 
          }
              return redirect()->route('requisicion.index')->with('success','Evaluacion firmada.');
    }
      public function firma1(Request $request)
    {
      $firma = Requisicion::find($request->user_id);
          if($firma){
            $firma->f_jefe= 1;
            $firma->fechafirma_j = Carbon::now();
            $firma->save(); 
          }
              return redirect()->route('requisicion.index')->with('success','Evaluacion firmada.');
    }
      public function firma2(Request $request)
    {
      $firma = Requisicion::find($request->user_id);
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