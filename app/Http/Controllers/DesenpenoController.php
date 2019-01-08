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

 
class DesenpenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $registros = User::orderBy('name')->paginate(12);
        return view('evaluacion.index',compact('registros')); 
    }
  
  public function indexjfe()
    {
        $registros = User::orderBy('name')->where('jefe_id', Auth::user()->id)->get();
        return view('evaluacion.indexjfe',compact('registros','usuarios'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $usuario = User::find($request->user_id); 
        return view('evaluacion.create',compact('usuario'));
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
        $this->validate($request,[ 'objetivo1'=>'required', 'peso_oindividuales'=>'required','peso_oadmon'=>'required','peso_ocultura'=>'required']);
        Desenpeno::create($request->all());
        return redirect()->route('evaluacion.indexjfe')->with('success','Registro creado satisfactoriamente');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usr = Auth::user();
        $registros = Desenpeno::find($id);
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        return  view('evaluacion.show',compact('registros', 'usr', 'permisoRh'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $registros = Desenpeno::find($id);
        return view('evaluacion.edit',compact('registros'));
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
        $this->validate($request,[ 'objetivo1'=>'required' ]);
         Desenpeno::find($id)->update($request->all());
        $ponderacion = Desenpeno::find($id);
      
          if($ponderacion){
            $ponderacion->ponderacion1 = $request->alcanzada1 * ($ponderacion->peso1 / 100);
            $ponderacion->ponderacion2 = $request->alcanzada2 * ($ponderacion->peso2 / 100);
            $ponderacion->ponderacion3 = $request->alcanzada3 * ($ponderacion->peso3 / 100);
            $ponderacion->ponderacion4 = $request->alcanzada4 * ($ponderacion->peso4 / 100);
            $ponderacion->ponderacion5 = $request->alcanzada5 * ($ponderacion->peso5 / 100);
            $ponderacion->ponderacion6 = $request->alcanzada6 * ($ponderacion->peso6 / 100);
            $ponderacion->ponderacion7 = $request->alcanzada7 * ($ponderacion->peso7 / 100);
            $ponderacion->ponderacion8 = $request->alcanzada8 * ($ponderacion->peso8 / 100);
            $ponderacion->ponderacion9 = $request->alcanzada9 * ($ponderacion->peso9 / 100);
            $ponderacion->ponderacion10 = $request->alcanzada10 * ($ponderacion->peso10 / 100);
            $ponderacion->ponderacion11 = $request->alcanzada11 * ($ponderacion->peso11 / 100);
            $ponderacion->ponderacion12 = $request->alcanzada12 * ($ponderacion->peso12 / 100);
            $ponderacion->ponderacion13 = $request->alcanzada13 * ($ponderacion->peso13 / 100);
            $ponderacion->save(); 
          }
      
      $total1 = $ponderacion->ponderacion1 + $ponderacion->ponderacion2 +$ponderacion->ponderacion3 + $ponderacion->ponderacion4 + $ponderacion->ponderacion5 ;
      $total2 = $ponderacion->ponderacion6 + $ponderacion->ponderacion7 +$ponderacion->ponderacion8 + $ponderacion->ponderacion9 + $ponderacion->ponderacion10 ;
      $total3 = $ponderacion->ponderacion11 + $ponderacion->ponderacion12 +$ponderacion->ponderacion13  ;
      
      $totales = Desenpeno::find($id);
          if($totales){
            $totales->total1 = $total1;
            $totales->total2 = $total2;
            $totales->total3 = $total3;
            $totales->e_final = ($total1 * .6) + ($total2 * .2) + ($total3 * .2) ;
            $totales->save(); 
          }
        
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
  
  
  
 public function mievaluacion()
    {
   
    $usr = Auth::user();
   
   if ( !empty($usr->desenpeno) ) {
        return redirect()->route('evaluaciones.show', $usr->desenpeno->id);
     } else {
       return redirect()->back()->with('message', 'No cuentas con evaluaciones de desempeño.');
   }}
}