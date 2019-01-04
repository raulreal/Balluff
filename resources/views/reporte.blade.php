@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
      Reportes de asistencia y puntualidad
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
                <td>{{ $registro->departamento->nombre }}</td>
                <td>{{ $registro->puesto }}</td>
                <td>2 años 8 meses</td>
                <td>
                <a href=reportes/{{ $registro->id }} title="Ver" class="btn btn-sm btn-warning view">
               <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
        </a></td>
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