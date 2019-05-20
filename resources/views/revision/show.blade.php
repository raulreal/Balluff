@extends('voyager::master')

@section('page_header')

  <br/>

  <h1 class="page-title">
      <i class="voyager-thumbs-up"></i>
      Revision {{$registros->tipo}} de Evaluación
  </h1>

@stop

@section('content')
            
    <div class="panel-body">
        <div class="table-responsive">
            
            <div class="row">
                <div class="col-sm-12 form-inline">
                    <form method="GET" action="{{ route('revision.show', $revision->id) }}" class="form-inline" >
                        {{ csrf_field() }}
                        <input type="email" name="email_evalucion" class="form-control input-sm objetivos peso_monto1" required placeholder="ejemplo@balluff.com" style="width:200px; height: 30px !important;" >
                        <input type="hidden" name="enviar_pdf" value="1" >

                        <input type="submit"  value="Enviar" class="btn btn-sm btn-primary edit" style="margin-left:-2px;">

                        <a href="{{route('revision.show', [$revision->id, 'descargar_pdf'=>1])}}" title="Imprimir" class="btn btn-sm btn-primary edit" target="_blanck" style="margin-left:20px;">
                            <span>Imprimir reporte (PDF)</span>
                        </a>
                      
                        <a href="{{route('revision.show', [$revision->id, 'descargar_excel'=>1])}}" title="Imprimir" class="btn btn-sm btn-primary edit" target="_blanck" style="margin-left:20px;">
                            <span>Descargar reporte (Excel)</span>
                        </a>
                    </form>
                </div>	
            </div>
            
            <div class="panel panel-primary">
                
            
                
                <div class="row datososc">
                    <div class="col-sm-12">
                        <center><h3>DATOS PERSONALES</h3></center>
                    </div>
                    <div class="col-sm-2"><strong>Nombre del Colaborador:</strong><br/> {{ $registros->user->name }} {{ $registros->user->apellido }}</div>
                    <div class="col-sm-2"><strong>Nombre del Jefe inmediato:</strong><br/>  
                        @if($registros->user->miJefe)
                          <td> {{ $registros->user->miJefe->name }} {{ $registros->user->miJefe->apellido }}</td>
                        @else
                          <td> Sin jefe </td>
                        @endif
                    </div>
                    <div class="col-sm-2"><strong>Puesto:</strong><br/>  {{ $registros->user->puesto }}</div>
                    <div class="col-sm-2"><strong>Año: </strong><br/> 2019</div>
                    <div class="col-sm-2"><strong>Departamento o área: </strong><br/>
                        @if($registros->user->departamento)
                            {{ $registros->user->departamento->nombre }}
                        @endif
                    </div>
                    <div class="col-sm-2"><strong>Fecha de ingreso: </strong><br/> {{ $registros->user->fecha_ingreso }}</div>
                </div>
                
                <div class="panel-body">					
                    <div class="table-container">
                        <div>
                            
                            <div class="panel-heading">Objetivos CSP ó Individuales <span><strong>{{$registros->peso_oindividuales}} %</strong></span></div>
                            <div class="table-responsive">
                                <table class="table mixed">
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
                                                <td><p>{{$registros->objetivo1}}</p></td>
                                                <td><p>{{$registros->meta1}}</p></td>
                                                <td><p>{{$registros->medida1}}</p></td>
                                                <td><p>{{$registros->fecha1}}</p></td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status1" id="status1">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso1" id="peso1" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso1}}" oninput="calculate(1)" readonly></td>  
                                                <td><input type="text" name="alcanzada1" id="alcanzada1" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada1}}" oninput="calculate(1);calculateTotal(1)" ></td>  
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion1}}" id="ponderacion1" name="ponderacion1" readonly></td>
                                                <td><textarea type="text" name="comentarios1" id="comentarios1" class="form-control input-sm objetivos">{{$revision->comentarios1}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td><p>{{$registros->objetivo2}}</p> </td>
                                                <td>{{$registros->meta2}}</td>
                                                <td>{{$registros->medida2}}</td>
                                                <td>{{$registros->fecha2}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status2" id="status2" >
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso2" id="peso2" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso2}}" oninput="calculate(2)" readonly></td>  
                                                <td><input type="text" name="alcanzada2" id="alcanzada2" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada2}}" oninput="calculate(2);calculateTotal(1)" ></td>   
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion2}}" id="ponderacion2"  name="ponderacion2" readonly></td>
                                                <td><textarea type="text" name="comentarios2" id="comentarios2" class="form-control input-sm objetivos" >{{$revision->comentarios2}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo3}}</td>
                                                <td>{{$registros->meta3}}</td>
                                                <td>{{$registros->medida3}}</td>
                                                <td>{{$registros->fecha3}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status3" id="status3" >
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso3" id="peso3" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso3}}" oninput="calculate(3)" readonly></td>  
                                                <td><input type="text" name="alcanzada3" id="alcanzada3" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada3}}" oninput="calculate(3);calculateTotal(1)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion3}}" id="ponderacion3" name="ponderacion3" readonly></td>
                                                <td><textarea type="text" name="comentarios3" id="comentarios3" class="form-control input-sm objetivos" >{{$revision->comentarios3}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo4}}</td>
                                                <td>{{$registros->meta4}}</td>
                                                <td>{{$registros->medida4}}</td>
                                                <td>{{$registros->fecha4}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status4" id="status4">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso4" id="peso4" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso4}}" oninput="calculate(4)" readonly></td>  
                                                <td><input type="text" name="alcanzada4" id="alcanzada4" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada4}}" oninput="calculate(4);calculateTotal(1)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion4}}" id="ponderacion4" name="ponderacion4" readonly></td>
                                                <td><textarea type="text" name="comentarios4" id="comentarios4" class="form-control input-sm objetivos" >{{$revision->comentarios4}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo5}}</td>
                                                <td>{{$registros->meta5}}</td>
                                                <td>{{$registros->medida5}}</td>
                                                <td>{{$registros->fecha5}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status5" id="status5">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso5" id="peso5" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso5}}" oninput="calculate(5)" readonly></td>  
                                                <td><input type="text" name="alcanzada5" id="alcanzada5" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada5}}" oninput="calculate(5);calculateTotal(1)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion5}}" id="ponderacion5" name="ponderacion5" readonly></td>
                                                <td><textarea type="text" name="comentarios5" id="comentarios5" class="form-control input-sm objetivos" >{{$revision->comentarios5}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos individuales:    </td>
                                                <td><input type="text" name="total1" id="total1" class="form-control input-sm objetivos" value="{{$revision->total1}}"></td>
                                                <td></td>
                                            </tr>
                                            
                                            <tr class="total-objetivos">
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos CSP ó Individuales:</font>
                                                </td>
                                                <td bgcolor="gray"  align="left" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">
                                                        <span id="totalCSP">{{$revision->totalCSP}} %</span>
                                                    </font>
                                                </td>
                                                <td bgcolor="gray"></td>
                                            </tr>
                                            
                                        </tbody>
                                    </div>
                                </table>
                            </div>
                     
              
                            <div class="panel-heading">Objetivos Administrativos <span><strong>{{$registros->peso_oadmon}} %</strong></span></div>
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
                                                <td>{{$registros->objetivo6}}</td>
                                                <td>{{$registros->meta6}}</td>
                                                <td>{{$registros->medida6}}</td>
                                                <td>{{$registros->fecha6}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status6" id="status6">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso6" id="peso6" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso6}}" oninput="calculate(6)" readonly></td>  
                                                <td><input type="text" name="alcanzada6" id="alcanzada6" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada6}}" oninput="calculate(6);calculateTotal(2)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion6}}" id="ponderacion6" name="ponderacion6" readonly></td>
                                                <td><textarea type="text" name="comentarios6" id="comentarios6" class="form-control input-sm objetivos" >{{$revision->comentarios6}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo7}}</td>
                                                <td>{{$registros->meta7}}</td>
                                                <td>{{$registros->medida7}}</td>
                                                <td>{{$registros->fecha7}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status7" id="status7">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso7" id="peso7" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso7}}" oninput="calculate(7)" readonly></td>  
                                                <td><input type="text" name="alcanzada7" id="alcanzada7" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada7}}" oninput="calculate(7);calculateTotal(2)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion7}}" id="ponderacion7" name="ponderacion7" readonly></td>
                                                <td><textarea type="text" name="comentarios7" id="comentarios7" class="form-control input-sm objetivos" >{{$revision->comentarios7}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo8}}</td>
                                                <td>{{$registros->meta8}}</td>
                                                <td>{{$registros->medida8}}</td>
                                                <td>{{$registros->fecha8}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status8" id="status8">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso8" id="peso8" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso8}}" oninput="calculate(8)" readonly></td>  
                                                <td><input type="text" name="alcanzada8" id="alcanzada8" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada8}}" oninput="calculate(8);calculateTotal(2)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion8}}" id="ponderacion8" name="ponderacion8" readonly></td>
                                                <td><textarea type="text" name="comentarios8" id="comentarios8" class="form-control input-sm objetivos" >{{$revision->comentarios8}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo9}}</td>
                                                <td>{{$registros->meta9}}</td>
                                                <td>{{$registros->medida9}}</td>
                                                <td>{{$registros->fecha9}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status4" id="status9">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso9" id="peso9" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso9}}" oninput="calculate(9)" readonly></td>  
                                                <td><input type="text" name="alcanzada9" id="alcanzada9" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada9}}" oninput="calculate(9);calculateTotal(2)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion9}}" id="ponderacion9" name="ponderacion9" readonly></td>
                                                <td><textarea type="text" name="comentarios9" id="comentarios9" class="form-control input-sm objetivos" >{{$revision->comentarios9}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo10}}</td>
                                                <td>{{$registros->meta10}}</td>
                                                <td>{{$registros->medida10}}</td>
                                                <td>{{$registros->fecha10}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status10" id="status10">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso10" id="peso10" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso10}}" oninput="calculate(10)" readonly></td>  
                                                <td><input type="text" name="alcanzada10" id="alcanzada10" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada10}}" oninput="calculate(10);calculateTotal(2)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion10}}" id="ponderacion10" name="ponderacion10" readonly></td>
                                                <td><textarea type="text" name="comentarios10" id="comentarios10" class="form-control input-sm objetivos" >{{$revision->comentarios10}}</textarea></td>
                                            </tr>
                                            
                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos  administrativos:    </td>
                                                <td><input type="text" name="total2" id="total2" class="form-control input-sm objetivos" value="{{$revision->total2}}"  ></td>
                                                <td></td>
                                            </tr>
                                            
                                            <tr class="total-objetivos">
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos Administrativos:</font>
                                                </td>
                                                <td bgcolor="gray"  align="left" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">
                                                        <span id="totalAdmon">{{$revision->totalAdmon}} %</span>
                                                    </font>
                                                </td>
                                                <td bgcolor="gray"></td>
                                            </tr>
                                            
                                        </tbody>
                                    </div>
                                </table>
                            </div>


                            <div class="panel-heading">Objetivos Cultura <span><strong>{{$registros->peso_ocultura}} %</strong></span></div>               
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
                                                <td>{{$registros->objetivo11}}</td>
                                                <td>{{$registros->meta11}}</td>
                                                <td>{{$registros->medida11}}</td>
                                                <td>{{$registros->fecha11}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status11" id="status11">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso11" id="peso11" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso11}}" oninput="calculate(11)" readonly></td>  
                                                <td><input type="text" name="alcanzada11" id="alcanzada11" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada11}}" oninput="calculate(11);calculateTotal(3)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion11}}" id="ponderacion11" name="ponderacion11" readonly></td>
                                                <td><textarea type="text" name="comentarios11" id="comentarios11" class="form-control input-sm objetivos" >{{$revision->comentarios11}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo12}}</td>
                                                <td>{{$registros->meta12}}</td>
                                                <td>{{$registros->medida12}}</td>
                                                <td>{{$registros->fecha12}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status12" id="status12">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso12" id="peso12" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso12}}" oninput="calculate(12)" readonly></td>  
                                                <td><input type="text" name="alcanzada12" id="alcanzada12" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada12}}" oninput="calculate(12);calculateTotal(3)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion12}}" id="ponderacion12" name="ponderacion12" readonly></td>
                                                <td><textarea type="text" name="comentarios12" id="comentarios12" class="form-control input-sm objetivos" >{{$revision->comentarios12}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td>{{$registros->objetivo13}}</td>
                                                <td>{{$registros->meta13}}</td>
                                                <td>{{$registros->medida13}}</td>
                                                <td>{{$registros->fecha13}}</td>
                                                <td>
                                                    <select class="form-control form-control-sm input-sm" name="status13" id="status13">
                                                        <option>En proceso</option>
                                                        <option>Postergado</option>
                                                        <option>Completado</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="peso13" id="peso13" class="form-control input-sm objetivos" placeholder="%" value="{{$registros->peso13}}" oninput="calculate(13);calculateTotal(3)" readonly></td>  
                                                <td><input type="text" name="alcanzada13" id="alcanzada13" class="form-control input-sm objetivos" placeholder="%" value="{{$revision->alcanzada13}}" oninput="calculate(13);calculateTotal(3)" ></td> 
                                                <td><input type="text" class="form-control input-sm objetivos" value="{{$revision->ponderacion13}}" id="ponderacion13" name="ponderacion13" readonly></td>
                                                <td><textarea type="text" name="comentarios13" id="comentarios13" class="form-control input-sm objetivos" >{{$revision->comentarios13}}</textarea></td>
                                            </tr>

                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos de cultura organizacional:    </td>
                                                <td><input type="text" name="total3" id="total3" class="form-control input-sm objetivos" value="{{$revision->total3}}"  ></td>
                                                <td></td>
                                            </tr>
                                            
                                            <tr class="total-objetivos">
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos Cultura:</font>
                                                </td>
                                                <td bgcolor="gray"  align="left" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">
                                                        <span id="totalCultura">{{$revision->totalCultura}} %</span>
                                                    </font>
                                                </td>
                                                <td bgcolor="gray"></td>
                                            </tr>
                                            
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                        </div>
                   </div>
         
                    <div class="row datososc" style="margin-top:15px;">
                        <div class="col-sm-12"><center>
                            <h3 style="margin: 4px;">RESULTADOS</h3></center>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Total objetivos individuales</th>
                                <th>Total objetivos administrativos</th>
                                <th>Total Objetivos de cultura organizacional</th>
                                <th>Evaluación Final</th>
                            </tr>
                            <tr style="text-align:center;">
                                <td>
                                    {{$revision->totalCSP}} %
                                </td>

                                <td>
                                    {{$revision->totalAdmon}} %
                                </td>

                                <td>
                                    {{$revision->totalCultura}} %
                                </td>

                                <td>
                                    {{ $revision->total }} %
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="firmas">
                        @if ($revision->f_empleado)
                            <div class="alert alert-success" role="alert">
                                Firmado por {{ $revision->user->name  }} {{ $revision->user->appellido  }}
                            </div> 
                        @else
                            @if ($registros->user->id === $usr->id)
                                <a href="{{ route('revision.firma',['user_id' => $revision->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                                    <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación Empleado</span>
                                </a>
                            @endif
                        @endif

                        @if ($revision->f_jefe)
                            <div class="alert alert-success" role="alert">
                                Firmado por {{ $registros->user->miJefe->name }} {{ $registros->user->miJefe->apellido }}
                            </div> 
                        @else
                            @if ($registros->user->miJefe->id === $usr->id)
                                <a href="{{ route('revision.firma1',['user_id' => $revision->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                                    <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación Jefe</span>
                                </a>
                            @endif
                        @endif

                        @if ($revision->f_rh)
                            <div class="alert alert-success" role="alert">
                                Firmado por Recursos Humanos
                            </div> 
                        @else
                            @if ($permisoRh)
                                <a href="{{ route('revision.firma2',['user_id' => $revision->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                                    <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación RH</span>
                                </a>
                            @endif
                        @endif
                    </div>
                    
               </div>
           </div>
       </div>
   </div>

    

@endsection