@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
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
              
 {!! Form::open(array('route' => 'evaluacion.save','method'=>'POST','files'=>'true')) !!}

              <div class="panel-heading">Objetivos CSP ó Individuales</div>
              
               <div class="form-group">
              {{ Form::text('objetivo1', 'example@gmail.com') }}
          </div>
              
              <div class="panel-body"> 

              </div>
              <div class="panel-heading">Evaluacion de Desempeño</div>
              <div class="panel-body"> 

              </div>
              <div class="panel-heading">Evaluacion de Desempeño</div>
              <div class="panel-body"> 

              </div>
              
 {!! Form::submit('Guardar evaluacion',['class'=>'btn receso']) !!}
 {{ Form::close() }}
         </div>
       </div>
     </div>
  </div>
</div>


@endsection