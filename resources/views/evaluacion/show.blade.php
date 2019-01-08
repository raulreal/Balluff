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
                      <div class="col-sm-2"><strong>Nombre del Colaborador:</strong><br/> {{ $registros->user->name }} {{ $registros->user->apellido }}</div>
                      <div class="col-sm-2"><strong>Nombre del Jefe inmediato:</strong><br/>  
                        @if($registros->user->miJefe)
                          <td> {{ $registros->user->miJefe->name }} {{ $registros->user->miJefe->apellido }}</td>
                        @else
                          <td> Sin jefe </td>
                        @endif
                      </div>
                      <div class="col-sm-2"><strong>Puesto:</strong><br/>  {{ $registros->user->puesto }} <h1>

                        </h1></div>
                      <div class="col-sm-2"><strong>Año: </strong><br/> 2019</div>
                      <div class="col-sm-2"><strong>Departamento o área: </strong><br/> {{ $registros->user->departamento->nombre }}</div>
                      <div class="col-sm-2"><strong>Fecha de ingreso: </strong><br/> {{ $registros->user->fecha_ingreso }}</div>
                  </div>
                        
        <div class="panel-body">					
					<div class="table-container">
						<form method="POST" action="{{ route('evaluaciones.update',$registros->id) }}"  role="form">
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
                  <td><input type="text" name="objetivo1" id="objetivo1" class="form-control input-sm objetivos" value="{{$registros->objetivo1}}" readonly></td>
                  <td><input type="text" name="meta1" id="meta1" class="form-control input-sm objetivos" value="{{$registros->meta1}}" readonly></td>
                  <td><input type="text" name="medida1" id="medida1" class="form-control input-sm objetivos" value="{{$registros->medida1}}" readonly></td>
                  <td><input type="text" name="fecha1" id="fecha1" class="form-control input-sm objetivos" value="{{$registros->fecha1}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status1" id="status1">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso1" id="peso1" class="form-control input-sm objetivos" value="{{$registros->peso1}}" readonly></td>
                  <td><input type="text" name="alcanzada1" id="alcanzada1" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada1}}" readonly></td>  
                  <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion1   }}" readonly></td>
                  <td><input type="text" name="comentarios1" id="comentarios1" class="form-control input-sm objetivos" value="{{$registros->comentarios1}}" readonly></td>
               </tr>
 <tr>
                  <td><input type="text" name="objetivo2" id="objetivo2" class="form-control input-sm objetivos" value="{{$registros->objetivo2}}" readonly></td>
                  <td><input type="text" name="meta2" id="meta2" class="form-control input-sm objetivos" value="{{$registros->meta2}}" readonly></td>
                  <td><input type="text" name="medida2" id="medida2" class="form-control input-sm objetivos" value="{{$registros->medida2}}" readonly></td>
                  <td><input type="text" name="fecha2" id="fecha2" class="form-control input-sm objetivos" value="{{$registros->fecha2}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status2" id="status2" readonly>
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso2" id="peso2" class="form-control input-sm objetivos" value="{{$registros->peso2}}" readonly></td>
                  <td><input type="text" name="alcanzada2" id="alcanzada2" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada2}}" readonly></td>  
                  <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion2   }}" readonly></td>
                  <td><input type="text" name="comentarios2" id="comentarios2" class="form-control input-sm objetivos" value="{{$registros->comentarios2}}" readonly></td>
               </tr>
               
                               <tr>
                  <td><input type="text" name="objetivo3" id="objetivo3" class="form-control input-sm objetivos" value="{{$registros->objetivo3}}" readonly></td>
                  <td><input type="text" name="meta3" id="meta3" class="form-control input-sm objetivos" value="{{$registros->meta3}}" readonly></td>
                  <td><input type="text" name="medida3" id="medida3" class="form-control input-sm objetivos" value="{{$registros->medida3}}" readonly></td>
                  <td><input type="text" name="fecha3" id="fecha3" class="form-control input-sm objetivos" value="{{$registros->fecha3}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status3" id="status3" readonly>
                          <option>En proceso</option>
                          <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso3" id="peso3" class="form-control input-sm objetivos" value="{{$registros->peso3}}" readonly></td>
                  <td><input type="text" name="alcanzada3" id="alcanzada3" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada3}}" readonly></td> 
                  <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion3   }}" readonly></td>
                  <td><input type="text" name="comentarios3" id="comentarios3" class="form-control input-sm objetivos" value="{{$registros->comentarios3}}" readonly></td>
               </tr>
               
                               <tr>
                  <td><input type="text" name="objetivo4" id="objetivo4" class="form-control input-sm objetivos" value="{{$registros->objetivo4}}" readonly></td>
                  <td><input type="text" name="meta4" id="meta4" class="form-control input-sm objetivos" value="{{$registros->meta4}}" readonly></td>
                  <td><input type="text" name="medida4" id="medida4" class="form-control input-sm objetivos" value="{{$registros->medida4}}" readonly></td>
                  <td><input type="text" name="fecha4" id="fecha4" class="form-control input-sm objetivos" value="{{$registros->fecha4}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status4" id="status4">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso1" id="peso4" class="form-control input-sm objetivos" value="{{$registros->peso4}}" readonly></td>
                  <td><input type="text" name="alcanzada1" id="alcanzada4" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada4}}" readonly></td>  
                  <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion4   }}" readonly></td>
                  <td><input type="text" name="comentarios1" id="comentarios4" class="form-control input-sm objetivos" value="{{$registros->comentarios4}}" readonly></td>
               </tr>
               
                               <tr>
                  <td><input type="text" name="objetivo5" id="objetivo5" class="form-control input-sm objetivos" value="{{$registros->objetivo5}}" readonly></td>
                  <td><input type="text" name="meta5" id="meta5" class="form-control input-sm objetivos" value="{{$registros->meta5}}" readonly></td>
                  <td><input type="text" name="medida5" id="medida5" class="form-control input-sm objetivos" value="{{$registros->medida5}}" readonly></td>
                  <td><input type="text" name="fecha5" id="fecha5" class="form-control input-sm objetivos" value="{{$registros->fecha5}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status5" id="status5">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso5" id="peso5" class="form-control input-sm objetivos" value="{{$registros->peso5}}" readonly></td>
                  <td><input type="text" name="alcanzada5" id="alcanzada5" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada5}}" readonly></td>  
                   <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion5   }}" readonly></td>
                  <td><input type="text" name="comentarios5" id="comentarios5" class="form-control input-sm objetivos" value="{{$registros->comentarios5}}" readonly></td>
               </tr>
                <tr>
                 <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos individuales:    </td>
                 <td><input type="text" name="total1" id="total1" class="form-control input-sm objetivos" value="{{$registros->total1}}" readonly > </td>
                 <td></td>
               </tr>
        
            </tbody>
                </div>
          </table>
              </div>
              
              
            <div class="panel-heading">Objetivos Administrativos </div>               
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
                  <td><input type="text" name="objetivo6" id="objetivo6" class="form-control input-sm objetivos" value="{{$registros->objetivo6}}" readonly></td>
                  <td><input type="text" name="meta6" id="meta6" class="form-control input-sm objetivos" value="{{$registros->meta6}}" readonly></td>
                  <td><input type="text" name="medida6" id="medida6" class="form-control input-sm objetivos" value="{{$registros->medida6}}" readonly></td>
                  <td><input type="text" name="fecha6" id="fecha6" class="form-control input-sm objetivos" value="{{$registros->fecha6}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status6" id="status6">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso6" id="peso6" class="form-control input-sm objetivos" value="{{$registros->peso6}}" readonly></td>
                  <td><input type="text" name="alcanzada6" id="alcanzada6" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada6}}" readonly></td>  
                  <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion6   }}" readonly></td>
                  <td><input type="text" name="comentarios6" id="comentarios6" class="form-control input-sm objetivos" value="{{$registros->comentarios6}}" readonly></td>
               </tr>
               
                               <tr>
                  <td><input type="text" name="objetivo7" id="objetivo7" class="form-control input-sm objetivos" value="{{$registros->objetivo7}}" readonly></td>
                  <td><input type="text" name="meta7" id="meta7" class="form-control input-sm objetivos" value="{{$registros->meta7}}" readonly></td>
                  <td><input type="text" name="medida7" id="medida7" class="form-control input-sm objetivos" value="{{$registros->medida7}}" readonly></td>
                  <td><input type="text" name="fecha7" id="fecha7" class="form-control input-sm objetivos" value="{{$registros->fecha7}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status7" id="status7">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso2" id="peso7" class="form-control input-sm objetivos" value="{{$registros->peso7}}" readonly></td>
                  <td><input type="text" name="alcanzada7" id="alcanzada7" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada7}}" readonly></td> 
                                 <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion7   }}" readonly></td>
                  <td><input type="text" name="comentarios7" id="comentarios7" class="form-control input-sm objetivos" value="{{$registros->comentarios7}}"></td>
               </tr>
               
                               <tr>
                  <td><input type="text" name="objetivo8" id="objetivo8" class="form-control input-sm objetivos" value="{{$registros->objetivo8}}" readonly></td>
                  <td><input type="text" name="meta8" id="meta8" class="form-control input-sm objetivos" value="{{$registros->meta8}}" readonly></td>
                  <td><input type="text" name="medida8" id="medida8" class="form-control input-sm objetivos" value="{{$registros->medida8}}" readonly></td>
                  <td><input type="text" name="fecha8" id="fecha8" class="form-control input-sm objetivos" value="{{$registros->fecha8}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status8" id="status8">
                          <option>En proceso</option>
                          <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso3" id="peso8" class="form-control input-sm objetivos" value="{{$registros->peso8}}" readonly></td>
                  <td><input type="text" name="alcanzada8" id="alcanzada8" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada8}}"></td>  
                                 <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion8   }}" readonly></td>
                  <td><input type="text" name="comentarios8" id="comentarios8" class="form-control input-sm objetivos" value="{{$registros->comentarios8}}" readonly></td>
               </tr>
               
                               <tr>
                  <td><input type="text" name="objetivo9" id="objetivo9" class="form-control input-sm objetivos" value="{{$registros->objetivo9}}" readonly></td>
                  <td><input type="text" name="meta9" id="meta9" class="form-control input-sm objetivos" value="{{$registros->meta9}}" readonly></td>
                  <td><input type="text" name="medida9" id="medida9" class="form-control input-sm objetivos" value="{{$registros->medida9}}" readonly></td>
                  <td><input type="text" name="fecha9" id="fecha9" class="form-control input-sm objetivos" value="{{$registros->fecha9}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status4" id="status9">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso1" id="peso9" class="form-control input-sm objetivos" value="{{$registros->peso9}}" readonly></td>
                  <td><input type="text" name="alcanzada9" id="alcanzada9" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada9}}"></td> 
                                 <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion9   }}" readonly></td>
                  <td><input type="text" name="comentarios9" id="comentarios9" class="form-control input-sm objetivos" value="{{$registros->comentarios9}}"></td>
               </tr>
               
                               <tr>
                  <td><input type="text" name="objetivo10" id="objetivo10" class="form-control input-sm objetivos" value="{{$registros->objetivo10}}" readonly></td>
                  <td><input type="text" name="meta10" id="meta10" class="form-control input-sm objetivos" value="{{$registros->meta10}}" readonly></td>
                  <td><input type="text" name="medida10" id="medida10" class="form-control input-sm objetivos" value="{{$registros->medida10}}" readonly></td>
                  <td><input type="text" name="fecha10" id="fecha10" class="form-control input-sm objetivos" value="{{$registros->fecha10}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status10" id="status10">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso10" id="peso10" class="form-control input-sm objetivos" value="{{$registros->peso10}}" readonly></td>
                  <td><input type="text" name="alcanzada10" id="alcanzada10" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada10}}" readonly></td>  
                                 <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion10  }}" readonly></td>
                  <td><input type="text" name="comentarios10" id="comentarios10" class="form-control input-sm objetivos" value="{{$registros->comentarios10}}" readonly></td>
                      
               </tr>
                               <tr>
                 <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos  administrativos:    </td>
                 <td><input type="text" name="total1" id="total1" class="form-control input-sm objetivos" value="{{$registros->total2}}" readonly > </td>
                 <td></td>
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
                  <td><input type="text" name="objetivo11" id="objetivo11" class="form-control input-sm objetivos" value="{{$registros->objetivo11}}" readonly></td>
                  <td><input type="text" name="meta11" id="meta11" class="form-control input-sm objetivos" value="{{$registros->meta11}}" readonly></td>
                  <td><input type="text" name="medida11" id="medida11" class="form-control input-sm objetivos" value="{{$registros->medida11}}" readonly></td>
                  <td><input type="text" name="fecha11" id="fecha11" class="form-control input-sm objetivos" value="{{$registros->fecha11}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status10" id="status11">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso11" id="peso11" class="form-control input-sm objetivos" value="{{$registros->peso11}}" readonly></td>
                  <td><input type="text" name="alcanzada11" id="alcanzada11" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada11}}"></td> 
                                                 <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion11   }}" readonly></td>
                  <td><input type="text" name="comentarios11" id="comentarios11" class="form-control input-sm objetivos" value="{{$registros->comentarios11}}"></td>
               </tr>
               
                                              <tr>
                  <td><input type="text" name="objetivo12" id="objetivo12" class="form-control input-sm objetivos" value="{{$registros->objetivo12}}" readonly></td>
                  <td><input type="text" name="meta12" id="meta10" class="form-control input-sm objetivos" value="{{$registros->meta12}}" readonly></td>
                  <td><input type="text" name="medida12" id="medida10" class="form-control input-sm objetivos" value="{{$registros->medida12}}" readonly></td>
                  <td><input type="text" name="fecha12" id="fecha12" class="form-control input-sm objetivos" value="{{$registros->fecha12}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status12" id="status12">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso12" id="peso12" class="form-control input-sm objetivos" value="{{$registros->peso12}}" readonly></td>
                  <td><input type="text" name="alcanzada12" id="alcanzada12" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada12}}"></td>  
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion12  }}" readonly></td>
                  <td><input type="text" name="comentarios12" id="comentarios12" class="form-control input-sm objetivos" value="{{$registros->comentarios12}}"></td>
               </tr>
               
                                              <tr>
                  <td><input type="text" name="objetivo13" id="objetivo13" class="form-control input-sm objetivos" value="{{$registros->objetivo13}}" readonly></td>
                  <td><input type="text" name="meta13" id="meta13" class="form-control input-sm objetivos" value="{{$registros->meta13}}" readonly></td>
                  <td><input type="text" name="medida13" id="medida13" class="form-control input-sm objetivos" value="{{$registros->medida13}}" readonly></td>
                  <td><input type="text" name="fecha13" id="fecha13" class="form-control input-sm objetivos" value="{{$registros->fecha13}}" readonly></td>
                  <td><select class="form-control form-control-sm input-sm" name="status13" id="status13">
                        <option>En proceso</option>
                        <option>Postergado</option>
                        <option>Completado</option>
                      </select>
                  </td>
                  <td><input type="text" name="peso13" id="peso10" class="form-control input-sm objetivos" value="{{$registros->peso13}}" readonly></td>
                  <td><input type="text" name="alcanzada13" id="alcanzada13" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->alcanzada13}}"></td>  
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion13   }}" readonly></td>
                  <td><input type="text" name="comentarios13" id="comentarios13" class="form-control input-sm objetivos" value="{{$registros->comentarios13}}"></td>
               </tr>
                               <tr>
                 <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos de cultura organizacional:    </td>
                 <td><input type="text" name="total3" id="total3" class="form-control input-sm objetivos" value="{{$registros->total3}}" readonly > </td>
                 <td></td>
               </tr>
            </tbody>
                </div>
          </table>
            </form>
          </div>  
            
            <div class="row datososc">
                      <div class="col-sm-12"><center><h3>
                        RESULTADOS
                        </h3></center></div>
                      <div class="col-sm-3"><strong>Total objetivos individuales</strong><br/> 
                        @if ($registros->e_final)
                          {{$registros->total1 * ($registros->peso_oindividuales/100) }}
                        @else
                          0
                        @endif
                      </div>
                      <div class="col-sm-3"><strong>Total objetivos administrativos</strong><br/> 
                        @if ($registros->e_final)  
                          {{$registros->total2 * ($registros->peso_oadmon/100) }} 
                        @else
                          0
                        @endif
                      </div>
                      <div class="col-sm-3"><strong>Total Objetivos de cultura organizacional</strong><br/>  
                         @if ($registros->e_final)  
                          {{$registros->total3 * ($registros->peso_ocultura/100) }}
                        @else
                          0
                        @endif
                      </div>
                      <div class="col-sm-3"><strong>Evaluación Final</strong><br/><strong>{{$registros->e_final}} </strong></div>
            </div>
              <div class="firmas">
                
            @if ($registros->f_empleado)
                <div class="alert alert-success" role="alert">
                  Firmado por {{ $registros->user->name  }} {{ $registros->user->appellido  }}
                </div> 
             @else
                
                   @if ($registros->user->id === $usr->id)
                        <a href="{{ route('evaluacion.firma',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                            <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación Empleado</span>
                        </a>
                  @endif
              @endif
                
              @if ($registros->f_jefe)
                <div class="alert alert-success" role="alert">
                  Firmado por {{ $registros->user->miJefe->name }} {{ $registros->user->miJefe->apellido }}
                </div> 
             @else
                
                                  @if ($registros->user->miJefe->id === $usr->id)
                        <a href="{{ route('evaluacion.firma1',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                            <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación Jefe</span>
                        </a>
                  @endif
              @endif
                
              @if ($registros->f_rh)
                <div class="alert alert-success" role="alert">
                  Firmado por Recursos Humanos
                </div> 
             @else           
                   @if ($permisoRh)

                            <a href="{{ route('evaluacion.firma2',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                                <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación RH</span>
                            </a>
                  @endif
              @endif


                
              </div>

            
	</section>

@endsection
