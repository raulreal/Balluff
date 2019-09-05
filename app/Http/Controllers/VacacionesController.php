<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vacacion;
use Carbon\Carbon;
use \Auth;

class VacacionesController extends Controller
{
  
    public $diasPorAnio = [ 0, 6, 8, 10, 12, 14, 14, 14, 14, 14, 16, 16, 16, 16, 16, 18, 18, 18,
                            18, 18, 20, 20, 20, 20, 20, 22, 22, 22, 22, 22, 24, 24, 24, 24, 24];
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $empleados = '';
        
        if($permisoRh)
            $empleados = ($request->empleados == "mios")? $usr->id : "";
        else
            $empleados =  $usr->id;
        
        $vacaciones = Vacacion::nombre($nombre)
                              ->apellido($apellido)
                              ->misEmpleados($empleados)
                              ->orderBy('id', 'DESC')
                              ->paginate(10)
                              ->appends($request->all());
        
        return view('vacaciones.index', compact('vacaciones', 'permisoRh') );
    }
    
    public function index2(Request $request)
    {
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $empleados = '';
        
        if($permisoRh)
            $empleados = ($request->empleados == "mios")? $usr->id : "";
        else
            $empleados =  $usr->id;
        
        $fecha = Carbon::now();
        $anioAnterior = $fecha->subYears(1);
        $usuarios = User::where('fecha_ingreso', '<=', $anioAnterior)
                        ->nombre($nombre)
                        ->apellido($apellido)
                        ->misEmpleados($empleados)
                        ->orderBy('name', 'ASC')
                        ->paginate(10)
                        ->appends($request->all());
        
        return view('vacaciones.index2', compact('usuarios', 'permisoRh') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $this->validate($request, [
            'user_id' => 'required|integer'
        ]);
        
        $usuario = User::find($request->user_id);
        $usuarioId = $usuario->id;
        $fecha = Carbon::now();
        
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        $firmas = $request->firmas && $permisoRh;
        
        $aniosTrabajados = $fecha->diffInYears( $usuario->fecha_ingreso );
        
        if($aniosTrabajados < 1)
            return back()->with('No tienes permiso para vacaciones');
        
        $diasVacaciones = $this->diasPorAnio[$aniosTrabajados];
        $diasPendientes = 0;
        $diasPendientesOriginal = 0;
        $diasDisfrutados = 0;
        $saldo = $diasVacaciones;
        
        $vacaciones = $usuario->misVacaciones;
        
        if($vacaciones->count()) {
            //Solo toma en cuenta las vacaciones con los mismos años trabajados para generar el historial.
            $diasDisfrutados = $vacaciones->where('anios_trabajados', $aniosTrabajados)->sum('dias_solicitados');
            
            $ultimaVacacion = $vacaciones->last();
            if($ultimaVacacion->anios_trabajados != $aniosTrabajados) {
                //Si los años trabajados no son iguales, supone que es de un año anterior y 
                //toma el saldo anterior como dias que se le deben al trabajador
                $diasPendientes = $ultimaVacacion->saldo;
                $saldo = $diasPendientes + $diasVacaciones;
            }
            else {
                //Si los años son iguales, se toman los dias pendientes antes registrados
                $diasPendientes = $ultimaVacacion->dias_pendientes;
                $saldo = $ultimaVacacion->saldo;
            }
        }
        
        if($saldo < 1) 
            return back()->with('No tienes días disponibles para vacaciones');
        
        return view('vacaciones.create', compact('usuario','fecha', 'diasPendientes', 'diasDisfrutados', 'usuarioId', 'firmas',
                                                 'saldo', 'diasVacaciones', 'aniosTrabajados', 'aniosTrabajados', 'permisoRh',
                                                'diasPendientesOriginal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,  [
            'dias_disfrutados' => 'required|integer',
            'dias_pendientes'  => 'required|integer',
            'dias_solicitados' => 'required|integer',
            'saldo'            => 'required|integer',
            'fecha_inicio'     => 'required',
            'fecha_fin'        => 'required',
            'fecha_laborar'    => 'required',
            'anios_trabajados' => 'required|integer'
        ]);
        
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        //validar que los días solicitados no se pasen de los permitidos
        if($request->dias_solicitados > $request->dias_por_disfrutar) {
            return back()->with('error', 'Los días solicitados no pueden ser mayor a los días por disfrutar.')
                         ->withInput();
        }
        
        $vacacion = new Vacacion;
        $vacacion->anios_trabajados = $request->anios_trabajados;
        $vacacion->user_id          = $request->user_id;
        
        $vacacion->saldo            = $request->saldo;
        $vacacion->dias_pendientes  = $request->dias_pendientes;//($request->saldo > $request->dias_vacaciones)? $request->saldo - $request->dias_vacaciones : 0;
        
        $vacacion->dias_solicitados = $request->dias_solicitados;
        $vacacion->fecha_inicio     = $request->fecha_inicio;
        $vacacion->fecha_fin        = $request->fecha_fin;
        $vacacion->fecha_laborar    = $request->fecha_laborar;
        
        //Se furma por todos desde un inicio, porque es la primera solicitud de vaciones que agrgea el historial,
        //para las futuras solicitudes.
        if($request->firmas && $permisoRh) {
            $vacacion->f_empleado = 1;
            $vacacion->f_jefe = 1;
            $vacacion->f_rh = 1;
        }
        
        $vacacion->save();
        
        if($permisoRh)
            return redirect()->route('vacaciones.index2')->with('success','La solicitud de vacaciones se agregado satisfactoriamente');
        
        return redirect()->route('home.index')->with('success','La solicitud de vacaciones se agregado satisfactoriamente');
        
    }
  
    public function misVacaciones() {
        $usuario = Auth::user();
        $fecha = Carbon::now();
        $aniosTrabajados = $fecha->diffInYears( $usuario->fecha_ingreso );
        if($aniosTrabajados < 1)
            return back()->with('No tienes permiso para vacaciones');
        
        if( $usuario->misVacaciones->count() ) {
            $ultima = $usuario->misVacaciones->last();
            if( is_null($ultima->f_jefe) || is_null($ultima->f_rh) )
                return redirect()->route('vacaciones.show', $ultima->id);
        }
        
        return redirect()->route('vacaciones.create', ['user_id' => $usuario->id]);
            
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacacion = Vacacion::find($id);
        $usuario = $vacacion->user;
        $fecha = Carbon::now();
        
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        $diasVacaciones = $this->diasPorAnio[$vacacion->anios_trabajados];
        $diasDisfrutados = $usuario->misVacaciones()
                                   ->where([ ['anios_trabajados', $vacacion->anios_trabajados], ['fecha_fin', '<=', date('Y-m-d')] ])
                                   ->sum('dias_solicitados');
        
        $diasPendientesAnteriores = $vacacion->dias_pendientes;
        /*
        if($diasPendientesAnteriores >= $diasDisfrutados) {
            $diasPendientesAnteriores -= $diasDisfrutados;
            $diasDisfrutados = 0;
        }
        else {
            $diasDisfrutados -= $diasPendientesAnteriores;
            $diasPendientesAnteriores = 0;
        }
        */
        return view('vacaciones.show', compact('vacacion', 'diasPendientesAnteriores', 'diasVacaciones', 'diasDisfrutados', 'usuario', 'fecha', 'permisoRh') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usr = Auth::user();
        $permisosUsuario = $usr->roles->pluck('name')->toArray();
        $permisoRh = in_array('rh', $permisosUsuario);
        
        $vacacion = Vacacion::find($id);
        $usuario = $vacacion->user;
        $fecha = Carbon::now();
        
        $diasVacaciones = $this->diasPorAnio[$vacacion->anios_trabajados];
        $diasDisfrutados = $usuario->misVacaciones()
                                   ->where([ ['anios_trabajados', $vacacion->anios_trabajados], ['fecha_fin', '<=', date('Y-m-d')] ])
                                   ->sum('dias_solicitados');
        
        $diasPendientesAnteriores = $vacacion->dias_pendientes;
        
        
        return view('vacaciones.edit', compact('vacacion', 'diasPendientesAnteriores', 'diasVacaciones', 'diasDisfrutados', 'usuario', 'fecha', 'permisoRh') );
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
        $this->validate($request,  [
            //'dias_disfrutados' => 'required|integer',
            'dias_pendientes'  => 'required|integer',
            'dias_solicitados' => 'required|integer',
            'saldo'            => 'required|integer',
            'fecha_inicio'     => 'required',
            'fecha_fin'        => 'required',
            'fecha_laborar'    => 'required'
        ]);
        
        $datos = $request->only('dias_pendientes', 'dias_solicitados', 'fecha_inicio', 'fecha_fin', 'fecha_laborar', 'saldo');
        $vacacion = Vacacion::find($id);
        $vacacion->update($datos);
        
        return redirect()->route('vacaciones.edit', $vacacion->id)
                         ->with('success','Registro actualizado satisfactoriamente');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacacion = Vacacion::find($id);
        $vacacion->delete();
        return back()->with('success','Registro eliminado satisfactoriamente');
    }
    
    
    public function firma(Request $request)
    {
      $firma = Vacacion::find($request->vacacion_id);
          if($firma){
            $firma->f_empleado = 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
    
    public function firma1(Request $request)
    {
      $firma = Vacacion::find($request->vacacion_id);
          if($firma){
            $firma->f_jefe= 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
    
    public function firma2(Request $request)
    {
      $firma = Vacacion::find($request->vacacion_id);
          if($firma){
            $firma->f_rh = 1;
            $firma->save(); 
          }
       return redirect()->back()->with('success', 'Evaluacion firmada.');
    }
    
    
    
}
