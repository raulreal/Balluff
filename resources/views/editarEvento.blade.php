
@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
       <i class="voyager-calendar"></i>
       Editar Reservación
    </h1>
@stop

@section('content')

<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">
            <div class="panel panel-primary">
                 <div class="panel-heading">Reservar Sala de juntas {{ $event->sala }} </div>
                  <div class="panel-body">
                       {!! Form::open(array('route' => 'events.actualizar','method'=>'POST','files'=>'true')) !!}
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12">
                              @if (Session::has('success'))
                                 <div class="alert alert-success">{{ Session::get('success') }}</div>
                              @elseif (Session::has('warnning'))
                                  <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
                              @endif
                          </div>
                          
                          <input type="hidden" name="id_evento" value="{{ $event->id }}" >

                          <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('event_name','Nombre de reunion:') !!}
                                <div class="">
                                {!! Form::text('event_name', $event->event_name, ['class' => 'form-control']) !!}
                                {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                            </div>
                          </div>

                          <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                              {!! Form::label('start_date','Fecha y Hora de inicio:') !!}
                              <div class="">
                              {!! Form::text('start_date', $event->start_date, ['class' => 'timepicker form-control', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}

                              {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                              </div>
                            </div>
                          </div>

                          <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                              {!! Form::label('end_date','Fecha y hora de finalizacion:') !!}
                              <div class="">
                              {!! Form::text('end_date', $event->end_date, ['class' => 'timepicker form-control', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}
                              {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                              </div>
                            </div>
                          </div>

                          <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                              {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
                          </div>
                        </div>
                       {!! Form::close() !!}
                  </div>
              <div>  <br><br><br><br><br><br><br><br><br><br><br><br><br><br> </div>
             </div>
         </div>
     </div>
   </div>
</div>

<script type="text/javascript">
    $('.timepicker').each(function () {
      $(this).datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss',
          enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
          daysOfWeekDisabled: [0, 6],
          useCurrent: false,
          minDate: truncateDate(new Date())
      });
  });
  
  function truncateDate(date) {
    return new Date(date.getFullYear(), date.getMonth(), date.getDate());
  }
</script>  

@endsection