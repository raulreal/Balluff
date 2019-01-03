@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
      Evaluaciones de Desempeño
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
          <div class="pull-left"><h3>Reportes de asistencia y puntualidad</h3></div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Colaborador</th>
                <th>Departamento o área</th>
                <th>Puesto</th>
                 <th>Antiguedad</th>
                <th>Ver Reporte</th>
             </thead>
             <tbody>
              @if($registros->count())  
              @foreach($registros as $registro)  
              <tr>
                <td>{{ $registro->name }} {{ $registro->apellido }}</td>
                <td>{{ $registro->departamento_id }}</td>
                <td>{{ $registro->puesto }}</td>
                <td>2 años 8 meses</td>
                <td><a class="btn btn-primary btn-xs" href=reportes/{{ $registro->id }} ><span class="glyphicon glyphicon-pencil"></span></a></td>
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
      {{ $registros->links() }}
    </div>
  </div>


@endsection