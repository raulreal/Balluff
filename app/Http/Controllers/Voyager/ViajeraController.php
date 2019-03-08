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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $registros = User::orderBy('name')->paginate(12);
        return view('ingreso.index',compact('registros')); 
    }
  
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $usuario = User::find(1); 
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
        //
        Ingreso::create($request->all());
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
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
      public function firma1(Request $request)
    {
      $firma = Ingreso::find($request->user_id);
          if($firma){
            $firma->f_jefe= 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
      public function firma2(Request $request)
    {
      $firma = Ingreso::find($request->user_id);
          if($firma){
            $firma->f_rh = 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
  
   
}