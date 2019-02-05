@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-dashboard"></i>
      Salas de Juntas
  </h1>
@stop

@section('content')


@section('content')

 <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12">
          @if (Session::has('success'))
             <div class="alert alert-success">{{ Session::get('success') }}</div>
          @elseif (Session::has('warnning'))
              <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
          @endif

      </div>
  </div>

<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">

            <div class="panel panel-primary">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="pull-left"><h3>Reservaciones</h3></div>
          <div class="pull-right"> 
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
               <thead>
                   <th>Colaborador</th>
                   <th>Sala</th>
                   <th>Fecha Inicio</th>
                   <th>Fecha Fin</th>
                   <th></th>
               </thead>
               <tbody>
                @if($registros->count())  
                    @foreach($registros as $registro)  
                        <tr>
                          @if($registro->user)
                            <td>{{ $registro->user->name }} {{ $registro->user->apellido }}</td>
                          @else
                            <td></td>
                          @endif
                          <td>{{ ucfirst ($registro->sala) }}</td>
                          <td>{{ $registro->start_date }} </td>
                          <td>{{ $registro->end_date }} </td>
                          <td> 
                            <a href="{{ URL::to('/events/'.$registro->id.'/editar?admin=1' ) }}" class="btn btn-primary btn-sm edit">
                                <i class="voyager-edit"></i> Editar Reservacion
                            </a>
                            <a href="javascript:;" title="Borrar" class="btn btn-sm btn-danger delete" data-id="{{$registro->id}}" id="delete-{{$registro->id}}">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                            </a> 
                          </td>
                        </tr>
                     @endforeach 
                 @else
                 <tr>
                  <td colspan="8">No hay registro !!</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
 {{ $registros->links() }}
         
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
          $('td').on('click', '.delete', function (e) {
              $('#delete_form')[0].action = '{{ route('events.eliminar', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
              $('#delete_modal').modal('show');
          });
      </script>  


         

@endsection