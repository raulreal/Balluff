@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
      Asistencia y Puntualidad estadisticas
  </h1>
@stop

@section('content')


@section('content')

<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">

            <div class="panel panel-primary">
              
 
              <div class="panel-heading">Estadisticas de Puntualidad y Asistencia</div>
 {!! Form::select('Colaborador', array('L' => 'Raul Ojeda', 'S' => 'Raul Ojeda'), 'S'); !!}
              <div class="panel-body"> 
               
                
                
                
                    <div class="row">
                      <div class="col-sm-3 datos">
                        <h2>
                          Datos del Colaborador
                        </h2>
                        <strong>Nombre del Colaborador:</strong> Raul Ojeda<br/>
                        <strong>Puesto:</strong> IT<br/>
                        <strong>Superior Inmediato:</strong> Jonh Doe<br/>
                      
                      
                      </div><br/><br/>
                      <div class="col-sm-9"><div id="perf_div"></div></div>
                      <div class="col-sm-12"><br/></div>
                      <div class="col-sm-6"><div id="chart-div"></div> </div>
                      <div class="col-sm-6"><div id="chart-div2"></div> </div>
                  </div>
     

@columnchart('Finances', 'perf_div')
@donutchart('PE', 'chart-div')
 @donutchart('AP', 'chart-div2')


                
              </div>
         </div>
       </div>
     </div>
  </div>
</div>




@endsection