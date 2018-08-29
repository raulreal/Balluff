
@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
       <i class="voyager-calendar"></i>
       Reservar Sala Nezahualcóyotl
    </h1>
@stop

@section('content')

<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">
 
            <div class="panel panel-primary">
 
             <div class="panel-heading">Reservar Sala de juntas Frida Nezahualcóyotl</div>
 
              <div class="panel-body">    
 
                   {!! Form::open(array('route' => 'neza.add','method'=>'POST','files'=>'true')) !!}
                    <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-12">
                          @if (Session::has('success'))
                             <div class="alert alert-success">{{ Session::get('success') }}</div>
                          @elseif (Session::has('warnning'))
                              <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
                          @endif
 
                      </div>
 
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('event_name','Nombre de reunion:') !!}
                            <div class="">
                            {!! Form::text('event_name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                      </div>
 
                      <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                          {!! Form::label('start_date','Fecha y Hora de inicio:') !!}
                          <div class="">
                          {!! Form::text('start_date', null, ['class' => 'timepicker form-control']) !!}
                                           
                          {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                          {!! Form::label('end_date','Fecha y hora de finalizacion:') !!}
                          <div class="">
                          {!! Form::text('end_date', null, ['class' => 'timepicker form-control']) !!}
                          {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                      {!! Form::submit('Reservar Sala',['class'=>'btn btn-primary']) !!}
                        
                        <a href="http://balluff-rrrogero643043.codeanyapp.com/admin/events" class="btn btn-primary btn-sm edit">
                                    <i class="voyager-edit"></i> Editar Reservaciones
                                </a>
                      </div>
                    </div>
                   {!! Form::close() !!}
 
             </div>
 
            </div>
 
            <div class="panel panel-primary">
              <div class="panel-heading">Disponibilidad de la Sala</div>
              <div class="panel-body" >
                  {!! $calendar_details->calendar() !!}
              </div>
            </div>
         </div>
     </div>
   </div>
</div>

 

<script type="text/javascript">
    $('.timepicker').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
    }); 
</script>  


@endsection

@section('javascript')
    {!! $calendar_details->script() !!}
@stop