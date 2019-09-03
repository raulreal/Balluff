@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-sun"></i>
      Vacaciones
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
                            <div class="alert alert-info">
                                {{Session::get('success')}}
                            </div>
                        @endif
                    </div>
                </div>
                
                 <div class="table-responsive">
                     <div class="panel panel-primary">
                         
                        <div class="row datososc">
                             <div class="col-sm-12">
                                  <center><h3>DATOS PERSONALES</h3></center>
                             </div>
                             <div class="col-sm-2"><strong>Nombre del Colaborador:</strong><br/>{{$usuario->name}} {{$usuario->apellido}}</div>
                             <div class="col-sm-2"><strong>Nombre del Jefe inmediato:</strong><br/>  
                                @if($usuario->miJefe)
                                  <td> {{ $usuario->miJefe->name }} {{ $usuario->miJefe->apellido }}</td>
                                @else
                                  <td> Sin jefe </td>
                                @endif
                              </div>
                              <div class="col-sm-2"><strong>Puesto:</strong><br/>         {{$usuario->puesto}}</div>
                              <div class="col-sm-2"><strong>Año: </strong><br/> {{$fecha->year}}</div>
                              <div class="col-sm-2"><strong>Departamento o área: </strong><br/>        
                                @if($usuario->departamento)
                                    {{$usuario->departamento->nombre}}
                                @endif
                              </div>
                              <div class="col-sm-2"><strong>Fecha de ingreso: </strong><br/> {{ $usuario->fecha_ingreso }}</div>
                          </div>
                         
						<form method="POST" action="{{ route('vacaciones.store') }}"  role="form" id="form">
							              {{ csrf_field() }}
                            
                            <div class="col-md-12 objetivos_tab">

                                <div class="panel panel-default">
                                    <div class="panel-heading"><span>Vacaciones</span>
                                  </div>  
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $usuario->id }}" >
                                    <div class="table-responsive tabla1">
                                      <table class="table">
                                         <thead>
                                           <th style="width: 20%">Campo</th>
                                            <th style="width: 10%">Dato</th>
                                         </thead>
                                         <tbody>
                                            <tr>
                                                <td>Días de vacaciones</td>
                                                <td>
                                                  <input type="text" value="{{ $diasVacaciones }}" name="dias_vacaciones" id="dias_vacaciones" 
                                                         class="form-control input-sm objetivos" disabled >
                                                </td>
                                            </tr>
                                            <tr>
                                              <td>Días pendientes del aniversario anterior</td>
                                              <td>
                                                <input type="text" value="{{ $diasPendientesAnteriores }}" name="dias_pendientes" id="dias_pendientes" 
                                                       class="form-control input-sm objetivos" disabled >
                                              </td>
                                           </tr>
                                           <tr>
                                              <td>Días disfrutados en el periodo actual</td>
                                              <td>
                                                <input type="text" value="{{ $diasDisfrutados }}" name="dias_disfrutados" id="dias_disfrutados" 
                                                       class="form-control input-sm objetivos" disabled >
                                              </td>
                                           </tr>
                                           
                                           <tr>
                                              <td>Total de días por disfrutar</td>
                                              <td>
                                                <input type="text" value="{{ $diasVacaciones - $diasDisfrutados }}"
                                                       class="form-control input-sm objetivos" id="diasPorDisfrutar" disabled >
                                              </td>
                                           </tr>
                                           
                                           <tr>
                                              <td>Días solicitados</td>
                                              <td>
                                                <input type="number" name="dias_solicitados" id="dias_solicitados"  value="{{ $vacacion->dias_solicitados }}"
                                                       onkeyup="calcularDias(this.value)" class="form-control input-sm objetivos" disabled
                                                       min="1" max="{{$vacacion->saldo}}">
                                             </td>
                                           </tr>
                                           
                                           <tr>
                                              <td>Saldo</td>
                                              <td>
                                                <input type="text" value="{{$vacacion->saldo}}" name="saldo" id="saldo" 
                                                       class="form-control input-sm objetivos" disabled >
                                             </td>
                                           </tr>
                                           
                                           
                                           <tr>
                                              <td>Fecha inicio</td>
                                              <td>
                                                {!! Form::text('fecha_inicio', null, ['class' => 'timepicker form-control input-sm', 'id'=>'fecha_inicio', 'disabled',
                                                                'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value' => $vacacion->fecha_inicio ]) !!}
                                             </td>
                                           </tr>
                                           
                                           <tr>
                                              <td>Fecha fin</td>
                                              <td>
                                                {!! Form::text('fecha_fin', null, ['class' => 'timepicker form-control input-sm', 'id'=>'fecha_fin', 'disabled',
                                                                'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value' => $vacacion->fecha_fin ]) !!}
                                             </td>
                                           </tr>
                                           
                                           <tr>
                                              <td>Fecha laborar</td>
                                              <td>
                                                {!! Form::text('fecha_laborar', null, ['class' => 'timepicker form-control input-sm', 'id'=>'fecha_laborar', 'disabled',
                                                                'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value' => $vacacion->fecha_laborar ]) !!}
                                             </td>
                                           </tr>
                                            
                                      </table>
                                    </div>
                                    
                                  <div class="firmas">
                                    @if ($vacacion->f_empleado)
                                        <div class="alert alert-success" role="alert">
                                          Firmado por {{ $vacacion->user->name  }} {{ $vacacion->user->appellido  }}
                                        </div> 
                                     @else
                                            <a href="javascript:void(0);" title="Firmar" class="btn btn-primary firma">
                                                <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar vacaciones Empleado</span>
                                            </a>
                                      @endif

                                      @if ($vacacion->f_jefe)
                                        <div class="alert alert-success" role="alert">
                                          Firmado por {{ $vacacion->user->miJefe->name }} {{ $vacacion->user->miJefe->apellido }}
                                        </div> 
                                     @else
                                          <a href="javascript:void(0);" title="Firmar" class="btn btn-primary firma">
                                              <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar vacaciones Jefe</span>
                                          </a>
                                      @endif

                                      @if ($vacacion->f_rh)
                                        <div class="alert alert-success" role="alert">
                                          Firmado por Recursos Humanos
                                        </div> 
                                     @else           
                                            <a href="javascript:void(0);" title="Firmar" class="btn btn-primary firma">
                                                <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar vacaciones RH</span>
                                            </a>
                                      @endif
                                  </div>
                                  
                                    <hr />
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
       
      $('#fecha_inicio').pickadate({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd 00:00:00',
        hiddenSuffix: '',
        disable: [6,7],
      });
            
      $('#fecha_fin').pickadate({
          format: 'yyyy-mm-dd',
          formatSubmit: 'yyyy-mm-dd 00:00:00',
          hiddenSuffix: '',
          disable: [6,7],
       });
        
      $('#fecha_laborar').pickadate({
          format: 'yyyy-mm-dd',
          formatSubmit: 'yyyy-mm-dd 00:00:00',
          hiddenSuffix: '',
          disable: [6,7],
      });
          
      
      function calcularDias(valor) {
          var saldo = document.getElementById('diasPorDisfrutar').value;
          document.getElementById('saldo').value = saldo - valor;
      }
          
      /*
      $(document).ready(function(){
            var $input = $('input[name="fecha"]').pickadate();
            var picker = $input.pickadate('picker');
            picker.set('select', '{{ date("Y-m-d") }}', { format: 'yyyy-mm-dd' });
            $('input[name="fecha"]').removeClass('invalid');
            
            var $input2 = $('input#fecha2').pickadate();
            var picker2 = $input2.pickadate('picker');
            picker2.set('select', '{{ date("Y-m-d") }}', { format: 'yyyy-mm-dd' });
            $('input#fecha2').removeClass('invalid');
        });
      */ 
        
    </script>
@endsection                   
                        