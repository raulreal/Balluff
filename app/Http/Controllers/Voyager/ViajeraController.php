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
       
    public function index()
    {
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
            
         if ($permisoRh) {
             $registros = User::orderBy('name')->paginate(12);
             return view('viajera.index',compact('registros','usr')); 

          } else {
            $registros = User::orderBy('name')->where('jefe_id', Auth::user()->id)->paginate(12);
            return view('viajera.index',compact('registros','usr'));
          }

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
        $usuario = User::find($registros->user_id);
        return  view('viajera.show',compact('usuario','id','usr','registros'));

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
            $firma->f_empleado = 1;
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
  
   
}