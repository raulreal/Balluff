@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-dashboard"></i>
      Evaluacion de Desempeño
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
          <div class="pull-left"><h3>Evaluaciones Disponibles</h3></div>
          <div class="pull-right"> 
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Colaborador</th>
                <th>Departamento o área</th>
                <th>Puesto</th>
               <th>Fecha de ingreso</th>
               <th>Evaluación Final</th>
                <th>Añadir/Edita</th>
                <th></th>
             </thead>
             <tbody>
              @if($registros->count())  
              @foreach($registros as $registro)  
              <tr>
                <td>{{ $registro->name }} {{ $registro->apellido }}</td>
                <td>{{ $registro->departamento->nombre }}</td>
                <td>{{ $registro->puesto }}</td>
                <td>{{ $registro->fecha_ingreso }}</td>
               <td>
                  @if ( !empty($registro->desenpeno->e_final) )
                    {{ $registro->desenpeno->e_final }}
                  @else
                  --
                  @endif
                </td>
                <td>
                  @if ( !empty($registro->desenpeno->id) )
                       <a href="{{action('DesenpenoController@edit', $registro->desenpeno->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar Objetivos</span>
                        </a>
                  
                        <a href="javascript:void(0);" title="Editar" class="btn btn-sm btn-primary edit" disabled>
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Revisión 01</span>
                        </a> 
                  
                  <a href="javascript:void(0);" title="Editar" class="btn btn-sm btn-primary edit" disabled>
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Revisión 02</span>
                        </a>
                   <a href="{{action('DesenpenoController@show', $registro->desenpeno->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver Evaluación</span>
                        </a>
    
                  @else
                  <a href="{{ route('evaluaciones.create',  ['user_id' => $registro->id ] ) }}" title="Ver" class="btn btn-sm btn-warning view">
                      <i class="voyager-plus"></i> <span class="hidden-xs hidden-sm">Añadir Evaluación</span>
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


@endsection