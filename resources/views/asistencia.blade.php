@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
      Asistencia y Puntualidad
  </h1>
@stop

@section('content')


@section('content')

<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">
 
            <div class="panel panel-primary">
 
              <div class="panel-heading">Registro entradas y salidas</div>
 
              <div class="panel-body"> 
<div class="col-sm-6">
                          <div class="row marco">
                            <div class="col-sm-12 digitos">
                              <div class="col-sm-12 dia">  {{ $actual->toFormattedDateString() }} </div>
                              <div class="col-sm-2 alarma"> <i class="voyager-alarm-clock"></i></div>
                              <div class="col-sm-7 numeros">{{ $actual->toTimeString() }}</div>
                              <div class="col-sm-3"> {{ $actual->format('l') }}</div>
                            </div>
                            
                            
                            @if (is_null($activa))
                                 <div class="row">
                                  {!! Form::open(array('route' => 'asistencia.add','method'=>'POST','files'=>'true')) !!}
                                   {!! Form::submit('iniciar',['class'=>'btn reloj']) !!}
                                  {{ Form::close() }}

                                </div>
                            @else
                                <div class="row">
                                  {!! Form::open(array('route' => 'asistencia.actualizar','method'=>'POST','files'=>'true')) !!}
                                   {!! Form::submit('Terminar',['class'=>'btn reloj']) !!}
                                  {{ Form::close() }}

                                </div>
                            @endif                            
                            

                           </div>
                </div>
                <div class="col-sm-6"> 
                  <div class="col-sm-3 imgperf"><img src="/storage/{{ $usuario->avatar }}" alight ="right" class="profile-img sm"></div>
                  <div class="col-sm-9"> <h3 > {{$usuario->name}} {{$usuario->apellido}}</h3> <br/> {{$usuario->puesto}}</div>
                  
                 
                {{$usuario->rol}}
                </div>
     </div>
  </div>
</div>


@endsection