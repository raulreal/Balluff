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
                 <th>Jefe inmediato</th>
                 <th>Fecha de Ingreso</th>
                <th>Revisar Evaluación</th>
                <th></th>
             </thead>
             <tbody>
              @if($registros->count())  
              @foreach($registros as $registro)  
              <tr>
                <td>{{ $registro->name }} {{ $registro->apellido }}</td>
                <td>{{ $registro->departamento->nombre }}</td>
                <td>{{ $registro->puesto }}</td>
                @if($registro->miJefe)
                  <td> {{ $registro->miJefe->name }} {{ $registro->miJefe->apellido }}</td>
                @else
                  <td> Sin jefe </td>
                @endif
                <td> {{ $registro->fecha_ingreso }} </td>
                <td>
                  @if ( !empty($registro->desenpeno->id) )
                  
                   <a href="{{action('DesenpenoController@show', $registro->desenpeno->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver Evaluación</span>
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

@endsection