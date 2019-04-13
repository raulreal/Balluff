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
                              <div class="col-sm-12 dia" id="date" > 
                                
                              </div>
                              <div class="col-sm-2 alarma"> <i class="voyager-alarm-clock"></i></div>
                              <div class="col-sm-7 numeros" id="clock"></div>
                              
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
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3 imgperf"><img src="/storage/{{ $usuario->avatar }}" alight ="right" class="profile-img sm"></div>
                  <div class="col-sm-6"> <h3 > {{$usuario->name}} {{$usuario->apellido}}</h3> <br/> {{$usuario->puesto}}{{$usuario->id}} </div>
                  
                 
                {{$usuario->rol}}
                </div>
     </div>
  </div>
</div>


@endsection
       
       
@section('javascript')
<script>
  /*
  window.onload = function startTime() {
    
    var today = new Date();
    var hr = {{ date('H') }};//today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    
    console.log(hr, min, sec, );
    
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
  
  
  function showTime() {
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("clock").innerText = time;
    //document.getElementById("date").textContent = time;
    
    setTimeout(showTime(20), 1000);
    
}
  */
  
  var anio = {{ date('y') }} ;
  var mes =  {{ date('m') }} ;
  var dia =  {{ date('d') }} ;
  var hora = {{ date("H", (strtotime ("+7 Hours"))) }} ;
  var minuto = {{ date("i", (strtotime ("-23 minute"))) }} ;
  var segundos = {{ date("s") }} ;
  
  var d = new Date( Date.UTC( anio,  mes ,  dia , hora, minuto , segundos ) );
  
  console.log( "hora servidor",  "{{date('Y-m-d G-i-s')}}" );
  
    var months = ['Enenro', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Augosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var days = ['Domigo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    var curWeekDay = days[d.getDay()];
    var curDay = d.getDate();
    var curMonth = months[d.getMonth()];
    var curYear = d.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
  
  setInterval(function() {
      d.setSeconds( d.getSeconds() + 1 );
      $('#clock').text((d.getHours() +':' + d.getMinutes() + ':' + d.getSeconds() ));
  }, 1000);
  
  
  
</script>       
@endsection