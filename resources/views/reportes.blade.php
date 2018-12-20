@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
      Asistencia y Puntualidad Reporte de Usuario
  </h1>
@stop

@section('content')

<h1>

  {{ $usuario->id }} {{ $puntuales->count() }}
</h1>

<div class="col-sm-6"><div id="chart-div2"></div>
  
  <div class="col-sm-6"><div id="chart-div"></div>
     


@donutchart('GA', 'chart-div2')
@donutchart('GP', 'chart-div')


@endsection