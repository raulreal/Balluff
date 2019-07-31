@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-dashboard"></i>
      Evaluación de Desempeño
  </h1>
@stop

@section('content')


@section('content')

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                
                {{ Form::model(Request::all(), array('route' => 'evaluaciones.index','method'=>'GET', 'class'=>'form-search' )) }}    
                    
                    <div id="search-input" style="    margin-bottom: 5px;">
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
                                <a href="{{ route('evaluaciones.index') }}" title="Borrar" class="btn btn-sm btn-danger delete" data-id="20" id="delete-20">
                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar filtro</span>
                                </a>
                            @endif
                        </div>
                    </div>
                {!! Form::close() !!}
                
                {{ Form::open(array('route' => 'evaluaciones.index', 'method'=>'GET', 'class'=>'form-search' )) }}
                    <div id="search-input" style="margin-bottom: 25px;">
                        <input type="hidden" name="exportar_excel" value="1">

                        <div class="input-group col-md-6">
                            {{ Form::select('revision', 
                                ['1' => 'Revisión 1',
                                 '2' => 'Revisión 2',
                                 '3' => 'Revisión 1 y 2'],
                                 null,
                               ['placeholder' => 'Seleccionar revisión',
                                'class' => 'form-control', 'required'])}}
                        </div>

                        <span class="input-group-btn" style="width: auto; background-color: #f5f5f5; font-weight: bold; height: 34px; border: 1px solid #cccccc;">
                            <button class="btn btn-info btn-lg" name="general" value="1" type="submit" style="margin: 0 !important; right: 2px;font-size: 15px; border-right: 1px solid #eee; height: 32px;">
                                <i class="voyager-cloud-download" style="display:inline-block; transform: none; position: relative; top: 4px;"></i> <span>Descargar reporte revisoines</span>
                            </button>
                        </span>
                    </div> 
                {{ Form::close() }}
                
                
                <div class="panel panel-primary">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="pull-left"><h3>Evaluaciones Disponibles</h3></div>
                            <div class="pull-right"></div>
                            <div class="table-container">
                                <table id="mytable" class="table table-bordred table-striped">
                                     <thead>
                                       <th>Colaborador</th>
                                       <th>Departamento o área</th>
                                       <th>Puesto</th>
                                       <th>Firma Empleado</th>
                                       <th>Firma Jefe</th>
                                       <th>Firma RH</th>
                                       <th>Definición de Objetivos</th>
                                       <th>Revisión 1</th>
                                       <th>Revisión 2</th>
                                     </thead>
                                     <tbody>
                                      @if($registros->count())  
                                          @foreach($registros as $registro)
                                                
                                                @php
                                                  $revision1 = null;
                                                  $revision2 = null;
                                                @endphp
                                                
                                                @if ( !empty($registro->desenpeno->id) )
                                                  @php
                                                      $revision1 = $registro->desenpeno->revisiones()->where('tipo', 1)->first();
                                                      $revision2 = $registro->desenpeno->revisiones()->where('tipo', 2)->first();
                                                  @endphp
                                                @endif
                                                
                                               <tr>
                                                  <td>{{ $registro->name }} {{ $registro->apellido }}</td>
                                                  <td>
                                                      @if($registro->departamento)
                                                        {{ $registro->departamento->nombre }}
                                                      @endif
                                                  </td>
                                                  <td>{{ $registro->puesto }}</td>
                                                 
                                                  <td>
                                                      <div class="contenedor-firmas">
                                                          @if($registro->desenpeno)
                                                            <span class='ing{{$registro->desenpeno->f_empleado}}'>OB</span>

                                                            @if($revision1)
                                                                <span class='ing{{$revision1->f_empleado}}'>R1</span>
                                                            @else
                                                                <span class='ing'>R1</span>
                                                            @endif

                                                            @if($revision2)
                                                                <span class='ing{{$revision2->f_empleado}}'>R2</span>
                                                            @else
                                                                <span class='ing'>R2</span>
                                                            @endif
                                                          @endif
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <div class="contenedor-firmas">
                                                          @if($registro->desenpeno)
                                                            <span class='ing{{$registro->desenpeno->f_jefe}}'>OB</span>

                                                            @if($revision1)
                                                                <span class='ing{{$revision1->f_jefe}}'>R1</span>
                                                            @else
                                                                <span class='ing'>R1</span>
                                                            @endif

                                                            @if($revision2)
                                                                <span class='ing{{$revision2->f_jefe}}'>R2</span>
                                                            @else
                                                                <span class='ing'>R2</span>
                                                            @endif
                                                          @endif
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <div class="contenedor-firmas">
                                                          @if($registro->desenpeno)
                                                            <span class='ing{{$registro->desenpeno->f_rh}}'>OB</span>

                                                            @if($revision1)
                                                                <span class='ing{{$revision1->f_rh}}'>R1</span>
                                                            @else
                                                                <span class='ing'>R1</span>
                                                            @endif

                                                            @if($revision2)
                                                                <span class='ing{{$revision2->f_rh}}'>R2</span>
                                                            @else
                                                                <span class='ing'>R2</span>
                                                            @endif
                                                          @endif
                                                      </div>
                                                  </td>
                                                  
                                                    @if ( !empty($registro->desenpeno->id) )
                                                        <td>
                                                            @if($fechaRestriccion['objetivos'])
                                                                @if(!$registro->desenpeno->f_rh || !$registro->desenpeno->f_jefe )
                                                                    <a href="{{action('DesenpenoController@show', $registro->desenpeno->id)}}" title="Firmar" class="btn btn-sm btn-primary edit">
                                                                        <i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Firmar</span>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            <a href="{{action('DesenpenoController@show', $registro->desenpeno->id)}}" title="Ver" class="btn btn-sm btn-primary edit">
                                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                            </a>
                                                            <a href="javascript:;" title="Borrar" class="btn btn-sm btn-danger delete" data-id="{{$registro->desenpeno->id}}" id="delete-{{$registro->desenpeno->id}}">
                                                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                                                            </a>
                                                        </td>
                                                                                                                     
                                                        <td>
                                                            @if($revision1)
                                                                @if( $fechaRestriccion['revision1'] )
                                                                    <a href="{{action('RevisionController@show', $revision1->id)}}" title="Firmar" class="btn btn-sm btn-primary edit">
                                                                        <i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Firmar</span>
                                                                    </a>
                                                                @endif
                                                                <a href="{{action('RevisionController@show', $revision1->id)}}" title="Ver" class="btn btn-sm btn-primary edit">
                                                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                </a>
                                                            @endif
                                                            
                                                        </td>
                                                        
                                                        <td>
                                                            @if($revision2)
                                                                @if( $fechaRestriccion['revision2'] )
                                                                    <a href="{{action('RevisionController@show', $revision2->id)}}" title="Firmar" class="btn btn-sm btn-primary edit">
                                                                        <i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Firmar</span>
                                                                    </a>
                                                                @endif
                                                                <a href="{{action('RevisionController@show', $revision2->id)}}" title="Ver" class="btn btn-sm btn-primary edit">
                                                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    @else
                                                        <td colspan="3" style="text-align:center">
                                                            <div class="alert alert-warning" style="display:inline-block" role="alert">
                                                                Usuario sin evaluación
                                                            </div>
                                                        </td>
                                                    @endif
                                                   
                                                  <td></td>
                                                  <td></td>
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
                {{ $registros->links() }}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  var deleteFormAction;
    $('td').on('click', '.delete', function (e) {
        $('#delete_form')[0].action = '{{ route('evaluaciones.destroy', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
        $('#delete_modal').modal('show');
    });
</script>

@endsection