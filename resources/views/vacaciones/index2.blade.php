@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-sun"></i>
      Vacaciones
  </h1>
@stop


@section('content')

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                <div class="panel panel-primary">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                              <div class="pull-left"><h3>Solicitudes de vacaciones</h3></div>
                              <div class="pull-right"> </div>
                              <div class="table-container">
                                <table id="mytable" class="table table-bordred table-striped">
                                     <thead>
                                       <th>Colaborador</th>
                                       <th>Departamento o área</th>
                                       <th>Puesto</th>
                                       <th>Fecha de Ingreso</th>
                                       <th>Firma Empleado</th>
                                       <th>Firma Jefe</th>
                                       <th>Firma RH</th>
                                       <th>Añadir/Edita</th>
                                     </thead>
                                     <tbody>
                                      @if($usuarios->count())  
                                          @foreach($usuarios as $registro)  
                                               <tr>
                                                  <td>{{ $registro->name }} {{ $registro->apellido }}</td>
                                                  <td>
                                                      @if($registro->departamento)
                                                        {{ $registro->departamento->nombre }}
                                                      @endif
                                                  </td>
                                                  <td>{{ $registro->puesto }}</td>
                                                  <td>{{ $registro->fecha_ingreso }}</td>
                                                  <td>
                                                      @if($registro->misVacaciones->first())
                                                          @if($registro->misVacaciones->first()->f_empleado)
                                                              Si
                                                          @else
                                                              No
                                                          @endif
                                                      @else
                                                          No
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if($registro->misVacaciones->first())
                                                          @if($registro->misVacaciones->first()->f_jefe)
                                                              Si
                                                          @else
                                                              No
                                                          @endif
                                                      @else
                                                          No
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if($registro->misVacaciones->first())
                                                          @if($registro->misVacaciones->first()->f_rh)
                                                              Si
                                                          @else
                                                              No
                                                          @endif
                                                      @else
                                                          No
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if ( $registro->misVacaciones->first() )
                                                          <a title="Editar" class="btn btn-sm btn-primary edit" href="{{ route('vacaciones.show', $registro->misVacaciones->first()->id ) }}" >
                                                              <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar Solicitud</span>
                                                          </a>
                                                      @else
                                                          <a href="{{ route('vacaciones.create',  ['user_id' => $registro->id, 'firmas' => 'todos' ] ) }}" title="Ver" class="btn btn-sm btn-warning view">
                                                              <i class="voyager-plus"></i> <span class="hidden-xs hidden-sm">Añadir Solicitud</span>
                                                          </a>
                                                      @endif
                                                   </td>
                                               </tr>  
                                           @endforeach
                                       @else
                                           <tr>
                                              <td colspan="8">No hay registro !!</td>
                                           </tr>
                                      @endif
                                    </tbody>

                                  </table>
                              </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>      
</div>


@endsection