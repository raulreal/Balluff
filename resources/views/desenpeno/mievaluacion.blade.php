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
            
             <div class="panel panel-bordered">
               <div class="panel-body">
                 <div class="table-responsive">

                      <div class="panel panel-primary">
                        
                    <div class="row datososc">
                      <div class="col-sm-12"><center><h3>
                        DATOS PERSONALES
                        </h3></center></div>
                      <div class="col-sm-2"><strong>Nombre del Colaborador:</strong><br/> Raul Real Rojero</div>
                      <div class="col-sm-2"><strong>Nombre del Jefe inmediato:</strong><br/>  Ramon Jefe TI </div>
                      <div class="col-sm-2"><strong>Puesto:</strong><br/>  Asistente de Gerencía</div>
                      <div class="col-sm-2"><strong>Año: </strong><br/> 2018</div>
                      <div class="col-sm-2"><strong>Departamento o área: </strong><br/> Tecnología de la información</div>
                      <div class="col-sm-2"><strong>Antiguedad: </strong><br/> 2 años 8 meses</div>
                  </div>
                        
        <div class="panel-body">					
					<div class="table-container">
						<form method="POST" action="{{ route('desenpeno.update',$registros->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
              <div class="panel-heading">Objetivos CSP ó Individuales</div>               
            <div class="table-responsive">
              <table class="table">
              <div class="table-responsive">
             <thead>
               <th style="width: 20%">Objetivos</th>
                <th style="width: 10%">Meta</th>
                <th style="width: 10%">Unidad de Medida</th>
                <th style="width: 10%">Fecha de ejecución</th>
                <th style="width: 10%">Estatus</th>
                <th style="width: 5%">Peso</th>
                <th style="width: 5%">Meta alcanzada</th>
                <th style="width: 10%">Ponderación</th>
                <th style="width: 20%">Comentarios adicionales</th>
             </thead>
             <tbody>
                <tr>
                <td><input type="text" name="objetivo1" id="objetivo1" class="form-control input-sm objetivos" value="{{$registros->objetivo1}}"></td>
                <td><input type="text" name="meta1" id="meta1" class="form-control input-sm objetivos" value="{{$registros->meta1}}"></td>
                <td><input type="text" name="medida1" id="medida1" class="form-control input-sm objetivos" value="{{$registros->medida1}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>Completado</option>
                      <option>En proceso</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm" disabled>
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion1" id="ponderacion1" class="form-control input-sm objetivos" value="{{$registros->ponderacion1}}"></td>
                
                <td><input type="text" name="comentarios1" id="comentarios1" class="form-control input-sm objetivos" value="{{$registros->comentarios1}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo2" id="objetivo2" class="form-control input-sm objetivos" value="{{$registros->objetivo2}}"></td>
                <td><input type="text" name="meta2" id="meta2" class="form-control input-sm objetivos" value="{{$registros->meta2}}"></td>
                <td><input type="text" name="medida2" id="medida2" class="form-control input-sm objetivos" value="{{$registros->medida1}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>En proceso</option>
                  <option>Completado</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion2" id="ponderacion2" class="form-control input-sm objetivos" value="{{$registros->ponderacion1}}"></td>
                
                <td><input type="text" name="comentarios2" id="comentarios2" class="form-control input-sm objetivos" value="{{$registros->comentarios1}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo3" id="objetivo3" class="form-control input-sm objetivos" value="{{$registros->objetivo3}}"></td>
                <td><input type="text" name="meta3" id="meta3" class="form-control input-sm objetivos" value="{{$registros->meta3}}"></td>
                <td><input type="text" name="medida3" id="medida3" class="form-control input-sm objetivos" value="{{$registros->medida3}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                                            <option>En proceso</option>
                  <option>Completado</option>

                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion1" id="ponderacion3" class="form-control input-sm objetivos" value="{{$registros->ponderacion3}}"></td>
                
                <td><input type="text" name="comentarios1" id="comentarios3" class="form-control input-sm objetivos" value="{{$registros->comentarios3}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo4" id="objetivo4" class="form-control input-sm objetivos" value="{{$registros->objetivo4}}"></td>
                <td><input type="text" name="meta4" id="meta1" class="form-control input-sm objetivos" value="{{$registros->meta4}}"></td>
                <td><input type="text" name="medida4" id="medida1" class="form-control input-sm objetivos" value="{{$registros->medida4}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                                           <option>  </option>
                  <option>Completado</option>
                      <option>En proceso</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion4" id="ponderacion4" class="form-control input-sm objetivos" value="{{$registros->ponderacion4}}"></td>
                
                <td><input type="text" name="comentarios4" id="comentarios4" class="form-control input-sm objetivos" value="{{$registros->comentarios4}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo1" id="objetivo5" class="form-control input-sm objetivos" value="{{$registros->objetivo5}}"></td>
                <td><input type="text" name="meta1" id="meta5" class="form-control input-sm objetivos" value="{{$registros->meta5}}"></td>
                <td><input type="text" name="medida1" id="medida5" class="form-control input-sm objetivos" value="{{$registros->medida5}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>  </option>
                  <option>Completado</option>
                      <option>En proceso</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion5" id="ponderacion5" class="form-control input-sm objetivos" value="{{$registros->ponderacion5}}"></td>
                
                <td><input type="text" name="comentarios5" id="comentarios5" class="form-control input-sm objetivos" value="{{$registros->comentarios5}}"></td>
               </tr> 
            </tbody>
                </div>
          </table>
              </div>
              
              
                            <div class="panel-heading">Objetivos Administrativos  </div>               
            <div class="table-responsive">
              <table class="table">
              <div class="table-responsive">
             <thead>
               <th style="width: 20%">Objetivos</th>
                <th style="width: 10%">Meta</th>
                <th style="width: 10%">Unidad de Medida</th>
                <th style="width: 10%">Fecha de ejecución</th>
                <th style="width: 10%">Estatus</th>
                <th style="width: 5%">Peso</th>
                <th style="width: 5%">Meta alcanzada</th>
                <th style="width: 10%">Ponderación</th>
                <th style="width: 20%">Comentarios adicionales</th>
             </thead>
             <tbody>
                <tr>
                <td><input type="text" name="objetivo1" id="objetivo1" class="form-control input-sm objetivos" value="{{$registros->objetivo1}}"></td>
                <td><input type="text" name="meta1" id="meta1" class="form-control input-sm objetivos" value="{{$registros->meta1}}"></td>
                <td><input type="text" name="medida1" id="medida1" class="form-control input-sm objetivos" value="{{$registros->medida1}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>Completado</option>
                      <option>En proceso</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion1" id="ponderacion1" class="form-control input-sm objetivos" value="{{$registros->ponderacion1}}"></td>
                
                <td><input type="text" name="comentarios1" id="comentarios1" class="form-control input-sm objetivos" value="{{$registros->comentarios1}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo2" id="objetivo2" class="form-control input-sm objetivos" value="{{$registros->objetivo2}}"></td>
                <td><input type="text" name="meta2" id="meta2" class="form-control input-sm objetivos" value="{{$registros->meta2}}"></td>
                <td><input type="text" name="medida2" id="medida2" class="form-control input-sm objetivos" value="{{$registros->medida1}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>En proceso</option>
                  <option>Completado</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion2" id="ponderacion2" class="form-control input-sm objetivos" value="{{$registros->ponderacion1}}"></td>
                
                <td><input type="text" name="comentarios2" id="comentarios2" class="form-control input-sm objetivos" value="{{$registros->comentarios1}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo3" id="objetivo3" class="form-control input-sm objetivos" value="{{$registros->objetivo3}}"></td>
                <td><input type="text" name="meta3" id="meta3" class="form-control input-sm objetivos" value="{{$registros->meta3}}"></td>
                <td><input type="text" name="medida3" id="medida3" class="form-control input-sm objetivos" value="{{$registros->medida3}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                                            <option>En proceso</option>
                  <option>Completado</option>

                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion1" id="ponderacion3" class="form-control input-sm objetivos" value="{{$registros->ponderacion3}}"></td>
                
                <td><input type="text" name="comentarios1" id="comentarios3" class="form-control input-sm objetivos" value="{{$registros->comentarios3}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo4" id="objetivo4" class="form-control input-sm objetivos" value="{{$registros->objetivo4}}"></td>
                <td><input type="text" name="meta4" id="meta1" class="form-control input-sm objetivos" value="{{$registros->meta4}}"></td>
                <td><input type="text" name="medida4" id="medida1" class="form-control input-sm objetivos" value="{{$registros->medida4}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                                           <option>  </option>
                  <option>Completado</option>
                      <option>En proceso</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion4" id="ponderacion4" class="form-control input-sm objetivos" value="{{$registros->ponderacion4}}"></td>
                
                <td><input type="text" name="comentarios4" id="comentarios4" class="form-control input-sm objetivos" value="{{$registros->comentarios4}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo1" id="objetivo5" class="form-control input-sm objetivos" value="{{$registros->objetivo5}}"></td>
                <td><input type="text" name="meta1" id="meta5" class="form-control input-sm objetivos" value="{{$registros->meta5}}"></td>
                <td><input type="text" name="medida1" id="medida5" class="form-control input-sm objetivos" value="{{$registros->medida5}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>  </option>
                  <option>Completado</option>
                      <option>En proceso</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion5" id="ponderacion5" class="form-control input-sm objetivos" value="{{$registros->ponderacion5}}"></td>
                
                <td><input type="text" name="comentarios5" id="comentarios5" class="form-control input-sm objetivos" value="{{$registros->comentarios5}}"></td>
               </tr> 
            </tbody>
                </div>
          </table>
              </div>
              
                                          <div class="panel-heading">Objetivos Cultura</div>               
            <div class="table-responsive">
              <table class="table">
              <div class="table-responsive">
             <thead>
               <th style="width: 20%">Objetivos</th>
                <th style="width: 10%">Meta</th>
                <th style="width: 10%">Unidad de Medida</th>
                <th style="width: 10%">Fecha de ejecución</th>
                <th style="width: 10%">Estatus</th>
                <th style="width: 5%">Peso</th>
                <th style="width: 5%">Meta alcanzada</th>
                <th style="width: 10%">Ponderación</th>
                <th style="width: 20%">Comentarios adicionales</th>
             </thead>
             <tbody>
                <tr>
                <td><input type="text" name="objetivo1" id="objetivo1" class="form-control input-sm objetivos" value="{{$registros->objetivo1}}"></td>
                <td><input type="text" name="meta1" id="meta1" class="form-control input-sm objetivos" value="{{$registros->meta1}}"></td>
                <td><input type="text" name="medida1" id="medida1" class="form-control input-sm objetivos" value="{{$registros->medida1}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>Completado</option>
                      <option>En proceso</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion1" id="ponderacion1" class="form-control input-sm objetivos" value="{{$registros->ponderacion1}}"></td>
                
                <td><input type="text" name="comentarios1" id="comentarios1" class="form-control input-sm objetivos" value="{{$registros->comentarios1}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo2" id="objetivo2" class="form-control input-sm objetivos" value="{{$registros->objetivo2}}"></td>
                <td><input type="text" name="meta2" id="meta2" class="form-control input-sm objetivos" value="{{$registros->meta2}}"></td>
                <td><input type="text" name="medida2" id="medida2" class="form-control input-sm objetivos" value="{{$registros->medida1}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                      <option>En proceso</option>
                  <option>Completado</option>
                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion2" id="ponderacion2" class="form-control input-sm objetivos" value="{{$registros->ponderacion1}}"></td>
                
                <td><input type="text" name="comentarios2" id="comentarios2" class="form-control input-sm objetivos" value="{{$registros->comentarios1}}"></td>
               </tr>
                <tr>
                <td><input type="text" name="objetivo3" id="objetivo3" class="form-control input-sm objetivos" value="{{$registros->objetivo3}}"></td>
                <td><input type="text" name="meta3" id="meta3" class="form-control input-sm objetivos" value="{{$registros->meta3}}"></td>
                <td><input type="text" name="medida3" id="medida3" class="form-control input-sm objetivos" value="{{$registros->medida3}}"></td>
                <td>{!! Form::text('start_date', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                <td><select class="form-control form-control-sm input-sm">
                                            <option>En proceso</option>
                  <option>Completado</option>

                      <option>Postergado</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                 <td><select class="form-control form-control-sm input-sm">
                   <option>0%</option>
                   <option>10%</option>
                   <option>20%</option>
                   <option>30%</option>
                   <option>40%</option>
                   <option>50%</option>
                   <option>60%</option>
                   <option>70%</option>
                   <option>80%</option>
                   <option>90%</option>
                   <option>100%</option>
                    </select>
                </td>
                <td><input type="text" name="ponderacion1" id="ponderacion3" class="form-control input-sm objetivos" value="{{$registros->ponderacion3}}"></td>
                
                <td><input type="text" name="comentarios1" id="comentarios3" class="form-control input-sm objetivos" value="{{$registros->comentarios3}}"></td>
               </tr>


            </tbody>
                </div>
          </table>
              </div>
              
              								<div class="col-xs-12 col-sm-12 col-md-12 botoneslrg">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('desenpeno.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	


            </form>
          </div>

                
         
	</section>
<script type="text/javascript">
  
    var deleteFormAction;
    $('td').on('click', '.delete', function (e) {
        $('#delete_form')[0].action = '{{ route('events.eliminar', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
        $('#delete_modal').modal('show');
    });
  
  $('.timepicker').each(function () {
      $('.timepicker').each(function () {
        $(this).datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
            daysOfWeekDisabled: [0, 6],
            useCurrent: false,
            minDate: truncateDate(new Date())
        });
     });
  });
  
  function truncateDate(date) {
    return new Date(date.getFullYear(), date.getMonth(), date.getDate());
  }
</script> 

@endsection
