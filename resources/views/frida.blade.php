
@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
       <i class="voyager-calendar"></i>
       Reservar Sala Frida Kahlo
    </h1>
@stop

@section('content')

<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">
 
            <div class="panel panel-primary">
 
             <div class="panel-heading">Reservar Sala de juntas Frida Kahlo </div>
 
              <div class="panel-body">    
 
                   {!! Form::open(array('route' => 'frida.add','method'=>'POST','files'=>'true')) !!}
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
                          {!! Form::text('start_date', null, ['class' => 'timepicker form-control', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}
                                           
                          {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                          {!! Form::label('end_date','Fecha y hora de finalizacion:') !!}
                          <div class="">
                          {!! Form::text('end_date', null, ['class' => 'timepicker form-control', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}
                          {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                          {!! Form::submit('Reservar Sala',['class'=>'btn btn-primary']) !!}
                          <a href="admin/events" class="btn btn-primary btn-sm edit">
                              <i class="voyager-edit"></i> Editar Reservaciones
                          </a>
                      </div>
                    </div>
                   {!! Form::close() !!}
                
                @if( $meventos )
                 <div class="panel panel-primary">
                        <div class="panel-heading">Mis reuniones programadas</div>
                        <div class="panel-body" >

                          <table class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <td>Nombre de reunion</td>
                          <td>Fecha y Hora de inicio</td>
                          <td>Fecha y hora de finalizacion</td>
                        <td>Edicion</td>
                      </tr>
                  </thead>
                  <tbody>
              @foreach($meventos as $value)
                    @if($value->end_date > $hoy )
                      <tr>
                        <td>{{ $value->event_name }} <h1>
                          </h1></td>
                        <td>{{ $value->start_date }}</td>
                        <td>{{ $value->end_date }}</td>
                        <td>
                          <a href="{{ URL::to('/events/'.$value->id.'/editar' ) }}" class="btn btn-primary btn-sm edit">
                            <i class="voyager-edit"></i> Editar Reservacion
                          </a>
                          <a href="javascript:;" title="Borrar" class="btn btn-sm btn-danger delete" data-id="{{$value->id}}" id="delete-{{$value->id}}">
                              <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                          </a>
                        </td>
                    </tr>
                  @endif
              @endforeach
              </tbody>
          </table>
        </div>
  </div>
                @else
                
                
             @endif   
                
                
                
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


    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Estás seguro que quieres eliminar esta reservación?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<script type="text/javascript">
  
  var deleteFormAction;
    $('td').on('click', '.delete', function (e) {
        $('#delete_form')[0].action = '{{ route('events.eliminar', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
        $('#delete_modal').modal('show');
    });
  
  
  
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

@section('javascript')
    {!! $calendar_details->script() !!}
@stop

