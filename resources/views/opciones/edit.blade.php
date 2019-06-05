@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-sun"></i>
      Opciones Recursos Humanos
  </h1>

@stop

@section('content')
        <div class="panel panel-bordered">
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-md-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                    </div>
                </div>
                
                 <div class="table-responsive">
                     <div class="panel panel-primary">
						<form method="POST" action="{{ route('opciones.update') }}" role="form" id="form">
                            
                            <input name="_method" type="hidden" value="PUT">
							{{ csrf_field() }}
                            
                            <div class="col-md-12 objetivos_tab">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><span>Opciones</span></div>
                                    
                                    <div class="table-responsive tabla1">
                                        <table class="table">
                                            
                                            <thead>
                                                <th style="width: 40%">Campo</th>
                                                <th style="width: 60%">Dato</th>
                                            </thead>
                                            
                                            <tbody>
                                                <tr>
                                                    <td>Fecha objetivos inicio</td>
                                                    <td>
                                                        {!! Form::text('objetivos_inicio', null, ['class' => 'timepicker form-control input-sm', 'id'=>'objetivos_inicio',
                                                                  'autocomplete'=>'off', 'placeholder'=>'Mes-Día',  'data-value'=>$opciones["objetivos_inicio"] ]) !!}
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                  <td>Fecha objetivos fin</td>
                                                  <td>
                                                      {!! Form::text('objetivos_fin', null, ['class' => 'timepicker form-control input-sm', 'id'=>'objetivos_fin',
                                                               'onkeydown'=>'return false', 'autocomplete'=>'off', 'placeholder'=>'Mes-Día',  'data-value'=>$opciones["objetivos_fin"] ]) !!}
                                                  </td>
                                               </tr>
                                               
                                               <tr>
                                                   <td>Fecha revisión 1 incio</td>
                                                   <td>
                                                        {!! Form::text('revision_1_incio', null, ['class' => 'timepicker form-control input-sm', 'id'=>'revision_1_incio',
                                                                'onkeydown'=>'return false', 'autocomplete'=>'off', 'placeholder'=>'Mes-Día', 'data-value'=>$opciones["revision_1_incio"] ]) !!}
                                                   </td>
                                               </tr>
                                           
                                               <tr>
                                                   <td>Fecha revisión 1 fin</td>
                                                   <td>
                                                       {!! Form::text('revision_1_fin', null, ['class' => 'timepicker form-control input-sm', 'id'=>'revision_1_fin',
                                                                'onkeydown'=>'return false', 'autocomplete'=>'off', 'placeholder'=>'Mes-Día', 'data-value'=>$opciones["revision_1_fin"] ]) !!}
                                                   </td>
                                               </tr>
                                           
                                               <tr>
                                                   <td>Fecha revisión 2 incio</td>
                                                   <td>
                                                       {!! Form::text('revision_2_incio', null, ['class' => 'timepicker form-control input-sm', 'id'=>'revision_2_incio',
                                                                    'onkeydown'=>'return false', 'autocomplete'=>'off', 'placeholder'=>'Mes-Día', 'data-value'=>$opciones["revision_2_incio"] ]) !!}
                                                   </td>
                                               </tr>
                                           
                                               <tr>
                                                  <td>Fecha revisión 2 fin</td>
                                                  <td>
                                                      {!! Form::text('revision_2_fin', null, ['class' => 'timepicker form-control input-sm', 'id'=>'revision_2_fin',
                                                                    'onkeydown'=>'return false', 'autocomplete'=>'off', 'placeholder'=>'Mes-Día', 'data-value'=>$opciones["revision_2_fin"] ]) !!}

                                                  </td>
                                               </tr>
                                          </tbody>
                                        </table>
                                    </div>
                                    
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12 botoneslrg">
                                        <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </form>
                     </div>
                </div>
            </div>
        </div>
@endsection
         
@section('javascript')
      <script type="text/javascript">
          
        $('.timepicker').each(function () {
          $('.timepicker').each(function () {
            $(this).pickadate({
              format: 'mm-dd',
              formatSubmit: 'yyyy-mm-dd',
              hiddenSuffix: ''
              //min:true,
            });
         });
      });
          
    </script>
@endsection            
                        