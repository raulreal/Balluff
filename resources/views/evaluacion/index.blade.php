@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-dashboard"></i>
      Evaluacion de Desempeño
  </h1>
@stop

@section('content')


@section('content')

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                
                {{ Form::model(Request::all(), array('route' => 'evaluaciones.index','method'=>'GET', 'class'=>'form-search' )) }}    
                    
                    <div id="search-input" style="    margin-bottom: 5px;">
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
                                <a href="{{ route('evaluaciones.index') }}" title="Borrar" class="btn btn-sm btn-danger delete" data-id="20" id="delete-20">
                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar filtro</span>
                                </a>
                            @endif
                        </div>
                    </div>
                {!! Form::close() !!}
                
                <div class="panel panel-primary">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="pull-left"><h3>Evaluaciones Disponibles</h3></div>
                            <div class="pull-right"></div>
                            <div class="table-container">
                                <table id="mytable" class="table table-bordred table-striped">
                                     <thead>
                                        <th>Colaborador</th>
                                        <th>Departamento o área</th>
                                        <th>Puesto</th>
                                        <th>Jefe inmediato</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Firma Empleado</th>
                                        <th>Firma Jefe</th>
                                        <th>Firma RH</th>
                                        <th>Revisar Evaluación</th>
                                     </thead>
                                     <tbody>
                                      @if($registros->count())  
                                          @foreach($registros as $registro)  
                                              <tr>
                                                <td>{{ $registro->name }} {{ $registro->apellido }}</td>
                                                @if($registro->departamento)
                                                <td>{{ $registro->departamento->nombre }}</td>
                                                @else
                                                  <td> Sin departamento </td>
                                                @endif
                                                <td>{{ $registro->puesto }}</td>
                                                @if($registro->miJefe)
                                                  <td> {{ $registro->miJefe->name }} {{ $registro->miJefe->apellido }}</td>
                                                @else
                                                  <td> Sin jefe </td>
                                                @endif
                                                <td> {{ $registro->fecha_ingreso }} </td>
                                                <td>
                                                    @if($registro->desenpeno)
                                                        @if($registro->desenpeno->f_empleado)
                                                            Si
                                                        @else
                                                            No
                                                        @endif
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($registro->desenpeno)
                                                        @if($registro->desenpeno->f_jefe)
                                                            Si
                                                        @else
                                                            No
                                                        @endif
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($registro->desenpeno)
                                                        @if($registro->desenpeno->f_rh)
                                                            Si
                                                        @else
                                                            No
                                                        @endif
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td>
                                                  @if ( !empty($registro->desenpeno->id) )
                                                        <a href="{{action('DesenpenoController@show', $registro->desenpeno->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                                                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver Evaluación</span>
                                                        </a>
                                                        
                                                        <a href="{{action('DesenpenoController@show', $registro->desenpeno->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                                                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Firmar Evaluación</span>
                                                        </a>
                                                  @else
                                                        <p>
                                                            <div class="alert alert-warning" role="alert">
                                                                Usuario sin evaluación
                                                            </div>
                                                        </p>
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
                {{ $registros->links() }}
            </div>
        </div>
    </div>
</div>


@endsection