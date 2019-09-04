@extends('voyager::master')

@section('page_header')
  <br/>
  <h1 class="page-title">
      <i class="voyager-sun"></i>
      Vacaciones
  </h1>
@stop


@section('content')

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                
                {{ Form::model(Request::all(), array('route' => 'vacaciones.index','method'=>'GET', 'class'=>'form-search' )) }}
                    <div id="search-input" style="margin-bottom: 5px;">
                        @if($permisoRh)
                            <div class="input-group col-md-6">
                                {{ Form::select('empleados',['' => 'Todos los usuarios', 'mios'=>'Mis colaboradores'], null, ['class'=>'form-control', 'style'=>"border: 1px solid #f1f1f1;"])  }}
                            </div>
                        @endif
                        <div class="input-group col-md-6">
                            {{ Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Nombre'])}}
                        </div>

                        <div class="input-group col-md-6">
                            {{ Form::text('apellido', null, ['class'=>'form-control','placeholder'=>'Apellido', 'style'=>'border-left: solid 1px #eee;'])}}
                        </div>

                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit">
                                <i class="voyager-search"></i>
                            </button>
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            @if(count(Request::all()))
                                <a href="{{ route('vacaciones.index') }}" title="Borrar" class="btn btn-sm btn-danger delete" data-id="20" id="delete-20">
                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar filtro</span>
                                </a>
                            @endif
                        </div>
                    </div>
                {!! Form::close() !!}
              
                <div class="panel panel-primary">      
                    <div class="panel panel-default">
                        <div class="panel-heading">
                              <div class="pull-left"><h3>Solicitudes de vacaciones</h3></div>
                              <div class="pull-right"> </div>
                              <div class="table-container">
                                <table id="mytable" class="table table-bordred table-striped">
                                     <thead>
                                       <th>Colaborador</th>
                                       <th>Departamento o área</th>
                                       <th>Puesto</th>
                                       <th>Fecha de Ingreso</th>
                                       <th>Firma Empleado</th>
                                       <th>Firma Jefe</th>
                                       <th>Firma RH</th>
                                       <th>Firmar/Edita</th>
                                     </thead>
                                     <tbody>
                                      @if($vacaciones->count())  
                                          @foreach($vacaciones as $registro)  
                                               <tr>
                                                  <td>{{ $registro->user->name }} {{ $registro->user->apellido }}</td>
                                                  <td>
                                                      @if($registro->user->departamento)
                                                        {{ $registro->user->departamento->nombre }}
                                                      @endif
                                                  </td>
                                                  <td>{{ $registro->user->puesto }}</td>
                                                  <td>{{ $registro->user->fecha_ingreso }}</td>
                                                  <td>
                                                      @if($registro->f_empleado)
                                                          Si
                                                      @else
                                                          No
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if($registro->f_jefe)
                                                          Si
                                                      @else
                                                          No
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if($registro->f_rh)
                                                          Si
                                                      @else
                                                          No
                                                      @endif
                                                  </td>
                                                  <td>
                                                      <a title="Firmar" class="btn btn-sm btn-primary edit" href="{{ route('vacaciones.show', $registro->id ) }}" >
                                                          <i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Firmar</span>
                                                      </a>
                                                    
                                                      <a title="Editar" class="btn btn-sm btn-primary edit" href="{{ route('vacaciones.edit', $registro->id ) }}" >
                                                          <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
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
                          
                              <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span
                                                        aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><i class="voyager-trash"></i> ¿Estás seguro que quieres eliminar este registro?</h4>
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
                            </div>
                          
                        </div>
                    </div>
                </div>
                {{ $vacaciones->links() }}
            </div>
        </div>
    </div>      
</div>

<script type="text/javascript">
  var deleteFormAction;
    $('td').on('click', '.delete', function (e) {
        $('#delete_form')[0].action = '{{ route('vacaciones.destroy', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
        $('#delete_modal').modal('show');
    });
</script>

@endsection