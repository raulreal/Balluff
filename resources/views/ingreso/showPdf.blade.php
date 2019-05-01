<!DOCTYPE html>
<html>
    <head>
         <title>Balluff - Evaluación de nuevo ingreso</title>
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

			.responsables {
				background: whitesmoke;
				padding: 25px;
				color: #999;
			}

            .panel.panel-primary .panel-heading {
                background-color: #f8fafc !important;
                border-bottom: solid 4px #e9e9e9 !important;
                margin: 20px 0px 5px!important;
                vertical-align: center;
            }
            
            .t_neg {
                margin-top: 25px;
                margin-bottom: 0 !important;
                padding: 10px 0;
                background: black;
                color: white;
                text-align: center;
                font-weight: 600;
            }
            
            .list-group {
                padding-left: 0;
                margin-bottom: 10px;
            }
            
            .list-group input[type="checkbox"] {
                  display: none;
              }
          
            .recomienda {
                text-align: center;
                padding: 25px;
                background: whitesmoke;
                border: solid 1px lightgray;
            }
            
            .alert {
                margin-right: 0;
                margin-bottom: 10px;
                margin-top: 10px;
                padding: 15px;
                color: #fff;
            } 
             
            .alert.alert-success {
                background-color: #55B559;
            }
            .firmas {
                text-align: center;
            }
            
			.col-sm-12 {
				width: 100%;
			}
            .col-sm-6 {
                display: inline-block;
                position: relative;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
                width: 46%;
                vertical-align: top;
            }
            
            table {
              border-collapse: collapse;
              width: 100%;
            }
			
			table.contenido td, table.contenido th{
				text-align: left;
				padding: 0px;
			}
			
        </style>
		
    </head>
    
    <body>
        <div class="col-md-12"> 
            <div style="width:50%; display:inline-block;"> 
                <h2 class="page-title">
                    Evaluación de nuevo ingreso
                </h2>
            </div>
        </div>
        
        <div class="col-md-12"> 
    
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
                    
                    <div class="col-md-12"> 
                        <br><br>
                    </div>
                    
                    <!--Table-->
                    <table class="table contenido">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Criterios Evaluados</th>
                                <th>Nivel de desarrollo</th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Como se ha integrado a su equipo de trabajo</td>
                                <td>                 
                                  @if ($registros->integrado == 1)
                                      Inaceptable
                                  @elseif ($registros->integrado == 2)
                                      Insuficiente
                                  @elseif ($registros->integrado == 3)
                                      Bien 
                                  @else
                                      Muy bien
                                  @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Su actitud ante responsabilidades retos en su trabajo, es…</td>
                                <td>
                                 @if ($registros->retos == 1)
                                      Inaceptable
                                  @elseif ($registros->retos == 2)
                                      Insuficiente
                                  @elseif ($registros->retos == 3)
                                      Bien 
                                  @else
                                      Muy bien
                                  @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Como es su actitud con el equipo de trabajo</td>
                                <td>
                                 @if ($registros->equipo == 1)
                                      Inaceptable
                                  @elseif ($registros->equipo == 2)
                                      Insuficiente
                                  @elseif ($registros->equipo == 3)
                                      Bien 
                                  @else
                                      Muy bien
                                  @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Su conocimiento técnico del puesto es…</td>
                                <td>
                                 @if ($registros->conocimiento == 1)
                                      Inaceptable
                                  @elseif ($registros->conocimiento == 2)
                                      Insuficiente
                                  @elseif ($registros->conocimiento == 3)
                                      Bien 
                                  @else
                                      Muy bien
                                  @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Conoce sus responsabilidades y actividades del puesto, de manera…</td>
                                <td>
                                 @if ($registros->responsabilidades == 1)
                                      Inaceptable
                                  @elseif ($registros->responsabilidades == 2)
                                      Insuficiente
                                  @elseif ($registros->responsabilidades == 3)
                                      Bien 
                                  @else
                                      Muy bien
                                  @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Cuenta con las habilidades para desempeñar el puesto,de manera…</td>
                                <td>
                                 @if ($registros->habilidades == 1)
                                      Inaceptable
                                  @elseif ($registros->habilidades == 2)
                                      Insuficiente
                                  @elseif ($registros->habilidades == 3)
                                      Bien 
                                  @else
                                      Muy bien
                                  @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>Como líder te sientes convencido que el nuevo ingreso se desempeñará en el puesto, de manera…</td>
                                <td>
                                 @if ($registros->lider == 1)
                                      Inaceptable
                                  @elseif ($registros->lider == 2)
                                      Insuficiente
                                  @elseif ($registros->lider == 3)
                                      Bien 
                                  @else
                                      Muy bien
                                  @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;"><strong>Total</strong></td>
                                <td>
                                    <h3>
                                        {{ ($registros->lider + $registros->habilidades + $registros->responsabilidades + $registros->conocimiento + $registros->equipo + $registros->retos + $registros->integrado) / .28 }} %
                                    </h3>
                                    <strong>{{ $registros->lider + $registros->habilidades + $registros->responsabilidades + $registros->conocimiento + $registros->equipo + $registros->retos + $registros->integrado}} / 28  </strong>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    <div class="recomienda">
                        <label class="statement"> ¿ Recomienda a la persona evaluada para permanecer en el puesto?</label>
                        <div class="reco">
                            @if ($registros->recomienda == 1)
                                <h1> Si</h1>
                            @else
                                <h1> No</h1>
                            @endif
                        </div>
                    </div>

                    <div class="row resumen">
                        <div class="col-sm-12 t_neg"><center>Resumen fortalezas y áreas de mejora</center></div>
                        <div class="col-sm-6 t_gris">Fortalezas<br/>
                            {{$registros->fortalezas}}
                        </div>
                        <div class="col-sm-6 t_gris">Áreas de mejora<br/>
                            {{$registros->mejoras}}
                        </div>
                    </div>
        
                    <div class="col-md-12"> 
                        <br><br>
                    </div>
        
                    <div class="table-responsive">
                        <table  class="table contenido">
                            <thead>
                                <tr>
                                    <th>Habilidad</th>
                                    <th>Acción y/o método a utilizar</th>
                                    <th>Entregable </th>
                                    <th>Estatus</th>
                                    <th>Fecha de Entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$registros->habilidad1}}</td>
                                <td>{{$registros->accion1}}</td>
                                <td>{{$registros->entregable1}}</td>
                                <td>{{$registros->estatus1}}</td>
                                <td>{{$registros->fecha1}}</td>
                            </tr>
                            <tr>
                                <td>{{$registros->habilidad2}}</td>
                                <td>{{$registros->accion2}}</td>
                                <td>{{$registros->entregable2}}</td>
                                <td>{{$registros->estatus2}}</td>
                                <td>{{$registros->fecha2}}</td>
                            </tr>
                            <tr>
                                <td>{{$registros->habilidad3}}</td>
                                <td>{{$registros->accion3}}</td>
                                <td>{{$registros->entregable3}}</td>
                                <td>{{$registros->estatus3}}</td>
                                <td>{{$registros->fecha3}}</td>
                            </tr>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="col-md-12"> 
                        <br><br>
                    </div>
        
                </div>
            </div>

            <div class="firmas">
                @if ($registros->f_empleado)
                    <div class="alert alert-success" role="alert">
                      Firmado por {{ $registros->user->name  }} {{ $registros->user->appellido  }} el {{ $registros->fechafirma_e}}
                    </div>
                @endif

                @if ($registros->f_jefe)
                    <div class="alert alert-success" role="alert">
                      Firmado por {{ $registros->user->miJefe->name }} {{ $registros->user->miJefe->apellido }} el {{ $registros->fechafirma_j}}
                    </div>
                @endif

                @if ($registros->f_rh)
                    <div class="alert alert-success" role="alert">
                      Firmado por Recursos Humanos el {{ $registros->fechafirma_rh}}
                    </div>
                @endif
                <div><hr/></div>
            </div>

        </div>
    </body>
</html>