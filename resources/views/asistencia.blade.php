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
                              <div class="col-sm-12 dia" id="date" > </div>
                              <div class="col-sm-2 alarma"> <i class="voyager-alarm-clock"></i></div>
                              <div class="col-sm-7 numeros" id="clock">{{ $actual->toTimeString() }}</div>
                              
                            </div>
                            
                            @if (is_null($activa))
                                 <div class="row">
                                  {!! Form::open(array('route' => 'asistencia.add','method'=>'POST','files'=>'true')) !!}
                                   {!! Form::submit('iniciar',['class'=>'btn reloj']) !!}
                                  {{ Form::close() }}

                                </div>
                            @else
                            
                                          @if (is_null($receso))
                                               <div class="row">
                                                {!! Form::open(array('route' => 'asistencia.receso','method'=>'POST','files'=>'true')) !!}
                                                {!! Form::submit('Receso',['class'=>'btn receso']) !!}
                                                {{ Form::close() }}
                                              </div>
                            
                                 <div class="row">
                                  {!! Form::open(array('route' => 'asistencia.cerrar','method'=>'POST','files'=>'true')) !!}
                                  {!! Form::submit('Terminar Sesion',['class'=>'btn reloj']) !!}
                                  {{ Form::close() }}
                                </div>
                                          @else

                                          <div class="row">
                                                {!! Form::open(array('route' => 'asistencia.recesocls','method'=>'POST','files'=>'true')) !!}
                                                {!! Form::submit('Terminar Receso',['class'=>'btn receso']) !!}
                                                {{ Form::close() }}
                                              </div>
                            
                                                             <div class="row">
                                                              {!! Form::open(array('route' => 'asistencia.cerrar','method'=>'POST','files'=>'true')) !!}
                                                              {!! Form::submit('Terminar Sesion',['class'=>'btn reloj','disabled' ]) !!}
                                                              {{ Form::close() }}
                                                            </div>
                                          @endif     

                            @endif                            
                            

                           </div>
                </div>
                <div class="col-sm-6"> 
                  <div class="col-sm-3 imgperf"><img src="/storage/{{ $usuario->avatar }}" alight ="right" class="profile-img sm"></div>
                  <div class="col-sm-9"> <h3 > {{$usuario->name}} {{$usuario->apellido}}</h3> <br/> {{$usuario->puesto}}{{$usuario->id}} </div>
                  
                 
                {{$usuario->rol}}
                </div>
     </div>
  </div>
</div>


@endsection
       
       
@section('javascript')
<script>
  window.onload = function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['Enenro', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Augosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var days = ['Domigo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
  
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>       
@endsection