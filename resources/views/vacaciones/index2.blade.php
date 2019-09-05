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
                
                {{ Form::model(Request::all(), array('route' => 'vacaciones.index2','method'=>'GET', 'class'=>'form-search' )) }}
                    <div id="search-input" style="margin-bottom: 5px;">
                        @if($permisoRh)
                            <div class="input-group col-md-6">
                                {{ Form::select('empleados',['' => 'Todos los usuarios', 'mios'=>'Mis colaboradores'], null, ['class'=>'form-control', 'style'=>"border: 1px solid #f1f1f1;"])  }}
                            </div>
                        @endif
                        <div class="input-group col-md-6">
                            {{ Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Nombre'])}}
                        </div>

                        <div class="input-group col-md-6">
                            {{ Form::text('apellido', null, ['class'=>'form-control','placeholder'=>'Apellido', 'style'=>'border-left: solid 1px #eee;'])}}
                        </div>

                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit">
                                <i class="voyager-search"></i>
                            </button>
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            @if(count(Request::all()))
                                <a href="{{ route('vacaciones.index2') }}" title="Borrar" class="btn btn-sm btn-danger delete" data-id="20" id="delete-20">
                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar filtro</span>
                                </a>
                            @endif
                        </div>
                    </div>
                {!! Form::close() !!}
              
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
                                       <th>Numero de Solicitudes</th>
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
                                                      {{ $registro->misVacaciones->count() }}
                                                  </td>
                                                  <td>
                                                      @if( $registro->misVacaciones->count() )
                                                          <a title="Añadir otra" class="btn btn-sm btn-primary edit" href="{{ route('vacaciones.create',  ['user_id' => $registro->id, 'firmas' => 'todos' ] ) }}" >
                                                              <i class="voyager-plus"></i> <span class="hidden-xs hidden-sm">Agregar Otra</span>
                                                          </a>
                                                      @else
                                                          <a href="{{ route('vacaciones.create',  ['user_id' => $registro->id, 'firmas' => 'todos' ] ) }}" title="Ver" class="btn btn-sm btn-warning view">
                                                              <i class="voyager-plus"></i> <span class="hidden-xs hidden-sm">Crear Primera Solicitud</span>
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
              {{ $usuarios->links() }}
            </div>
        </div>
    </div>      
</div>


@endsection