<!DOCTYPE html>
<html>
    <head>
        <title>Balluff - Reporte revisión</title>
        <style>
            body {
                font-family: arial, sans-serif;
                font-size: 12px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: center;
                padding: 0px;
            }

            .datososc {
                background: #222f3e;
                padding: 10px;
                color: lightgrey;
            }

            .panel.panel-primary .panel-heading {
                background-color: #f8fafc !important;
                border-bottom: solid 4px #e9e9e9 !important;
                margin: 20px 0px 5px!important;
                vertical-align: center;
            }
            		
			.alert {
                margin-right: 0;
                margin-bottom: 5px;
                margin-top: 5px;
                padding: 7px;
                color: #fff;
            } 
             
            .alert.alert-success {
                background-color: #55B559;
            }
            
            .firmas {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="col-md-12">
            <h2 class="page-title">
                <i class="voyager-thumbs-up"></i>
                Revision {{$revision->tipo}} de Evaluación
            </h2>
        </div>
        <div class="col-md-12">
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="panel panel-primary">
                        
                            <div class="row datososc">
                                <div class="col-sm-12">
                                    <center><h3 style="margin: 4px;">DATOS PERSONALES</h3></center>
                                </div>
                                  <table class="table">
                                     <tr>
                                        <th>Nombre del Colaborador:</th>
                                        <th>Nombre del Jefe inmediato:</th>
                                        <th>Puesto:</th>
                                        <th>Año:</th>
                                        <th>Departamento o área:</th>
                                        <th>Fecha de ingreso:</th>
                                     </tr>
                                     <tr>
                                        <td>{{ $registros->user->name }} {{ $registros->user->apellido }}</td>
                                        <td>
                                          @if($registros->user->miJefe)
                                            {{$registros->user->miJefe->name}} {{$registros->user->miJefe->apellido}}
                                          @else
                                            Sin jefe
                                          @endif
                                        </td>
                                        <td>{{ $registros->user->puesto }}</td>
                                        <td>{{ $registros->created_at->year }}</td>
                                        <td>
                                            @if($registros->user->departamento)
                                              {{ $registros->user->departamento->nombre }}
                                            @endif
                                        </td>
                                       <td> {{ $registros->user->fecha_ingreso }}</td>
                                     </tr>
                                  </table>
                            </div>
                        

                        <div class="panel-body">					
                            <div class="table-container">
                                <div>

                                    <div class="panel-heading">Objetivos CSP ó Individuales {{$registros->peso_oindividuales}} %</div>
                                    <div class="table-responsive">
                                        <table class="table mixed">
                                            <tr>
                                                <th style="width: 20%">Objetivos</th>
                                                <th style="width: 10%">Meta</th>
                                                <th style="width: 10%">Unidad de Medida</th>
                                                <th style="width: 10%">Fecha de ejecución</th>
                                                <th style="width: 10%">Estatus</th>
                                                <th style="width: 5%">Peso</th>
                                                <th style="width: 5%">Meta alcanzada</th>
                                                <th style="width: 10%">Ponderación</th>
                                                <th style="width: 20%">Comentarios adicionales</th>
                                            </tr>

                                            @for($i = 1; $i < 6; $i++)
                                                <tr>
                                                    <td>{{$registros['objetivo'.$i]}}</td>
                                                    <td>{{$registros['meta'.$i]}}</td>
                                                    <td>{{$registros['medida'.$i]}}</td>
                                                    <td>
                                                        @if($registros['fecha'.$i])
                                                            {{date('Y-m-d', strtotime($registros['fecha'.$i]))}}
                                                        @endif
                                                    </td>
                                                    <td>{{$registros['status'.$i]}}</td>
                                                    <td>{{$registros['peso'.$i]}}</td>  
                                                    <td>{{$revision['alcanzada'.$i]}}</td> 
                                                    <td>{{$revision['ponderacion'.$i]}}</td>
                                                    <td>{{$revision['comentarios'.$i]}}</td>
                                                </tr>
                                            @endfor

                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos individuales:</font>
                                                </td>
                                                <td>{{$revision->total1}}</td>
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
                                        </table>
                                    </div>
                                    
                                    <div class="col-md-12"> 
                                        <br>
                                    </div>

                                    <div class="panel-heading">Objetivos Administrativos {{$registros->peso_oadmon}} %</div>
                                    <div class="table-responsive">
                                        <table class="table">
                                             <tr>
                                                <th style="width: 20%">Objetivos</th>
                                                <th style="width: 10%">Meta</th>
                                                <th style="width: 10%">Unidad de Medida</th>
                                                <th style="width: 10%">Fecha de ejecución</th>
                                                <th style="width: 10%">Estatus</th>
                                                <th style="width: 5%">Peso</th>
                                                <th style="width: 5%">Meta alcanzada</th>
                                                <th style="width: 10%">Ponderación</th>
                                                <th style="width: 20%">Comentarios adicionales</th>
                                            </tr>
                                            @for($i = 6; $i < 11; $i++)
                                                <tr>
                                                    <td>{{$registros['objetivo'.$i]}}</td>
                                                    <td>{{$registros['meta'.$i]}}</td>
                                                    <td>{{$registros['medida'.$i]}}</td>
                                                    <td>
                                                        @if($registros['fecha'.$i])
                                                            {{date('Y-m-d', strtotime($registros['fecha'.$i]))}}
                                                        @endif
                                                    </td>
                                                    <td>{{$registros['status'.$i]}}</td>
                                                    <td>{{$registros['peso'.$i]}}</td>  
                                                    <td>{{$revision['alcanzada'.$i]}}</td> 
                                                    <td>{{$revision['ponderacion'.$i]}} </td>
                                                    <td>{{$revision['comentarios'.$i]}}</td>
                                                </tr>
                                            @endfor

                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos  administrativos:    </td>
                                                <td>{{$revision->total2}}</td>
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
                                        </table>
                                    </div>
                                       
                                    <div class="col-md-12"> 
                                        <br>
                                    </div>

                                    <div class="panel-heading">Objetivos Cultura {{$registros->peso_ocultura}} %</div>               
                                    <div class="table-responsive">
                                        <table class="table">
                                             <tr>
                                                <th style="width: 20%">Objetivos</th>
                                                <th style="width: 10%">Meta</th>
                                                <th style="width: 10%">Unidad de Medida</th>
                                                <th style="width: 10%">Fecha de ejecución</th>
                                                <th style="width: 10%">Estatus</th>
                                                <th style="width: 5%">Peso</th>
                                                <th style="width: 5%">Meta alcanzada</th>
                                                <th style="width: 10%">Ponderación</th>
                                                <th style="width: 20%">Comentarios adicionales</th>
                                            </tr>
                                            @for($i = 11; $i < 14; $i++)
                                                <tr>
                                                    <td>{{$registros['objetivo'.$i]}}</td>
                                                    <td>{{$registros['meta'.$i]}}</td>
                                                    <td>{{$registros['medida'.$i]}}</td>
                                                    <td>
                                                        @if($registros['fecha'.$i])
                                                            {{date('Y-m-d', strtotime($registros['fecha'.$i]))}}
                                                        @endif
                                                    </td>
                                                    <td>{{$registros['status'.$i]}}</td>
                                                    <td>{{$registros['peso'.$i]}}</td>  
                                                    <td>{{$revision['alcanzada'.$i]}}</td> 
                                                    <td>{{$revision['ponderacion'.$i]}}</td>
                                                    <td>{{$revision['comentarios'.$i]}}</td>
                                                </tr>
                                            @endfor

                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos de cultura organizacional:    </td>
                                                <td>{{$revision->total3}}</td>
                                                <td></td>
                                            </tr>

                                            <tr class="total-objetivos">
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos Cultura:</font>
                                                </td>
                                                <td bgcolor="gray"  align="left" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">
                                                        <span id="totalAdmon">{{$revision->totalCultura}} %</span>
                                                    </font>
                                                </td>
                                                <td bgcolor="gray"></td>
                                            </tr>
                                        </table>
                                    </div>
                        
                                    <div class="col-md-12"> 
                                        <br>
                                    </div>

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
                            @endif

                            @if ($revision->f_jefe)
                                <div class="alert alert-success" role="alert">
                                    Firmado por {{ $registros->user->miJefe->name }} {{ $registros->user->miJefe->apellido }}
                                </div>
                            @endif

                            @if ($revision->f_rh)
                                <div class="alert alert-success" role="alert">
                                    Firmado por Recursos Humanos
                                </div>
                            @endif
                        </div>
            
                   </div>
               </div>
           </div>

            

        </div>
    <body>
</html>