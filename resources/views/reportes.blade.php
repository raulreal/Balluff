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
  {{ $actual }}
  {{ $usuario->id }}
</h1>


@endsection