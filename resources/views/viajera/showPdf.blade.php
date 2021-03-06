<!DOCTYPE html>
<html>
    <head>
         <title>Balluff - Hoja Viajera</title>
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
			
			.list-group input[type="checkbox"] + .list-group-item:before {
				  content: "\2713";
				  color: transparent;
				  font-weight: bold;
				  margin-right: 1em;
			}

			.list-group input[type="checkbox"]:checked + .list-group-item {
			  background-color: #2d3436;
			  color: #FFF;
			}

			.list-group input[type="checkbox"]:checked + .list-group-item:before {
			  color: inherit;
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
          
              .list-group-item {
                  position: relative;
                  display: block;
                  padding: 10px 15px;
                  margin-bottom: -1px;
                  background-color: #fff;
                  border: 1px solid #ddd;
              }
          
              label.list-group-item.clase1 {
                  background: #bdc3c7 !important;
              }
			
			label.list-group-item.firma {
				background: #d33440;
				color: white;
			}
			
			label.list-group-item.firmado {
				background: #3498db;
				color: white;
			}
			
			.li_head {
				text-align: center;
				background: #ccc;
				color: white;
				padding: 10px;
				font-weight: 600;
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
			
			table.contenido  td{
				border: 1px solid #ffffff;
				text-align: center;
				padding: 0px;
			}
			
			table.responsables  td{
				border: 1px solid #ffffff;
				text-align: left;
				padding: 0px;
			}
			
        </style>
		
    </head>
    
    <body>
        <div class="col-md-12"> 
            <div style="width:50%; display:inline-block;"> 
                <h2 class="page-title">
                    Hoja Viajera
                </h2>
            </div>
        </div>

		  <div class="col-md-12"> 
			  <div class="panel panel-bordered">
              <div class="panel-body">
                  <div class="table-responsive">
                      <div class="panel panel-primary">
                          <div class="row datososc">
                              <div class="col-sm-12"><center><h3 style="margin: 4px;">
                                DATOS PERSONALES
                                </h3></center>
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
                      </div>
                  </div>
              </div>


			<div class="container ads">
				  <div class="row-eq-height">

					<table class="table contenido">
						<tr style="vertical-align: top;">
							<td style="width: 50%; padding-right: 10px;">
								<div>
								  <div class="t_neg"> Inducción General </div>
								  <div class="list-group">
									<input type="checkbox" name="resena" value="1" id="CheckBox1"/>
									<label class="list-group-item clase{{$registros->resena}}" for="CheckBox1">
									  Reseña histórica (Quiénes somos, qué hacemos)
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="mision" value="1" id="CheckBox2" />
									<label class="list-group-item clase{{$registros->mision}}" for="CheckBox2">
									  Misión
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="vision" value="1" id="CheckBox3" />
									<label class="list-group-item clase{{$registros->vision}}" for="CheckBox3">
									  Visión
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="valores" value="1" id="CheckBox4" />
									<label class="list-group-item clase{{$registros->valores}}" for="CheckBox4">
									  Valores
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="organigrama" value="1" id="CheckBox5" />
									<label class="list-group-item clase{{$registros->organigrama}}" for="CheckBox5">
									  Organigrama
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="codigo" value="1" id="CheckBox6" />
									<label class="list-group-item clase{{$registros->codigo}}" for="CheckBox6">
									  Código de Conducta
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="principales" value="1" id="CheckBox7" />
									<label class="list-group-item clase{{$registros->principales}}" for="CheckBox7">
									  Principales aspectos del contrato individual
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="prestaciones" value="1" id="CheckBox8" />
									<label class="list-group-item clase{{$registros->prestaciones}}" for="CheckBox8">
									  Prestaciones
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="formas" value="1" id="CheckBox9" />
									<label class="list-group-item clase{{$registros->formas}}" for="CheckBox9">
									  Formas de pago
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="politica" value="1" id="CheckBox10" />
									<label class="list-group-item clase{{$registros->politica}}" for="CheckBox10">
									  Política de gastos
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="contactos" value="1" id="CheckBox11" />
									<label class="list-group-item clase{{$registros->contactos}}" for="CheckBox11">
									  Contactos Balluff
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="recorrido" value="1" id="CheckBox12" />
									<label class="list-group-item clase{{$registros->recorrido}}" for="CheckBox12">
									  Recorrido instalaciones y presentación en todas las áreas
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="manual" value="1" id="CheckBox13" />
									<label class="list-group-item clase{{$registros->manual}}" for="CheckBox13">
									  Manual  "Filosofia Balluff"
									  <span class="pull-right"> ERYS</span>
									</label>

								  @if ($registros->firma1)
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firmado" for="CheckBox14">
										Firmado por {{$registros->user->name}}     {{$registros->user->apellido}}
									  </label>
									  @else
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firma" for="CheckBox14">
										Sin firma de colaborador 
									  </label>
								   @endif

									</div>
							   </div>
							</td>
							<td style="width: 50%; padding-left: 10px;">
								<div>
								  <div class="t_neg"> Inducción por Áreas </div>
								  <div class="list-group">
									<input type="checkbox" name="proceso1" value="1" id="CheckBox15" />
									<label class="list-group-item clase{{$registros->proceso1}}" for="CheckBox15">
									  Proceso de Pricing
									  <span class="pull-right"> P</span>
									</label>

									<input type="checkbox" name="proceso2" value="1" id="CheckBox16" />
									<label class="list-group-item clase{{$registros->proceso2}}" for="CheckBox16">
									 Proceso de MP e Importaciones
									  <span class="pull-right"> MP/CE</span>
									</label>

									<input type="checkbox" name="proceso3" value="1" id="CheckBox17" />
									<label class="list-group-item clase{{$registros->proceso3}}" for="CheckBox17">
									  Proceso Servicio a Clientes
									  <span class="pull-right"> SC</span>
									</label>

									<input type="checkbox" name="proceso4" value="1" id="CheckBox18" />
									<label class="list-group-item clase{{$registros->proceso4}}" for="CheckBox18">
									  Proceso de Almacén
									  <span class="pull-right"> JA</span>
									</label>

									<input type="checkbox" name="proceso5" value="1" id="CheckBox19" />
									<label class="list-group-item  clase{{$registros->proceso5}}" for="CheckBox19">
									  Servicio de 24X7
									  <span class="pull-right"> SC</span>
									</label>

									<input type="checkbox" name="proceso6" value="1" id="CheckBox20" />
									<label class="list-group-item  clase{{$registros->proceso6}}" for="CheckBox20">
									  Proceso de Ventas
									  <span class="pull-right"> AV</span>
									</label>

									<input type="checkbox" name="proceso7" value="1" id="CheckBox21" />
									<label class="list-group-item clase{{$registros->proceso7}}" for="CheckBox21">
									  Proceso de Marketing y Comunicación
									  <span class="pull-right"> MKT</span>
									</label>

									<input type="checkbox" name="proceso8" value="1" id="CheckBox22" />
									<label class="list-group-item  clase{{$registros->proceso8}}" for="CheckBox22">
									  Proceso de Marketing Estrategico
									  <span class="pull-right"> MKT</span>
									</label>

									<input type="checkbox" name="proceso9" value="1" id="CheckBox23" />
									<label class="list-group-item clase{{$registros->proceso9}}" for="CheckBox23">
									  Proceso de Cross Reference
									  <span class="pull-right"> MKT</span>
									</label>

									<input type="checkbox" name="proceso10" value="1" id="CheckBox24" />
									<label class="list-group-item  clase{{$registros->proceso10}}" for="CheckBox24">
									  Proceso de Reclutamiento y Selección 
									  <span class="pull-right"> ERYS</span>
									</label>

									<input type="checkbox" name="proceso11" value="1" id="CheckBox25" />
									<label class="list-group-item  clase{{$registros->proceso11}}" for="CheckBox25">
									  Proceso de Desarrollo Organizacional 
									  <span class="pull-right"> DO</span>
									</label>

									<input type="checkbox" name="proceso12" value="1" id="CheckBox26" />
									<label class="list-group-item clase{{$registros->proceso12}}" for="CheckBox26">
									  Proceso de Compras Indirectas 
									  <span class="pull-right"> AGG</span>
									</label>

									<input type="checkbox" name="proceso13" value="1" id="CheckBox27" />
									<label class="list-group-item  clase{{$registros->proceso13}}" for="CheckBox27">
									  Proceso de Egresos y Pagos Operacionales
									  <span class="pull-right"> CF</span>
									</label>

									<input type="checkbox" name="proceso14" value="1" id="CheckBox28" />
									<label class="list-group-item   clase{{$registros->proceso14}}" for="CheckBox28">
									  Proceso de Crédito y Cobranza
									  <span class="pull-right"> CC</span>
									</label>

									<input type="checkbox" name="proceso15" value="1" id="CheckBox29" />
									<label class="list-group-item  clase{{$registros->proceso15}}" for="CheckBox29">
									  Proceso de Soporte Técnico
									  <span class="pull-right"> ST</span>
									</label>

									 <input type="checkbox" name="proceso16" value="1" id="CheckBox30" />
									<label class="list-group-item  clase{{$registros->proceso16}}" for="CheckBox30">
									  Proceso de Didáctica
									  <span class="pull-right"> ID</span>
									</label>

									 <input type="checkbox" name="proceso17" value="1" id="CheckBox31" />
									<label class="list-group-item  clase{{$registros->proceso17}}" for="CheckBox31">
									  Proceso de Servicios y Sistemas
									  <span class="pull-right"> ST</span>
									</label>

									<input type="checkbox" name="proceso18" value="1" id="CheckBox32" />
									<label class="list-group-item  clase{{$registros->proceso18}}" for="CheckBox32">
									  Proceso de AIM y CRM 
									  <span class="pull-right"> AYM</span>
									</label>



								   @if ($registros->firma2)
									  <input type="checkbox" name="firma2" value="1" id="CheckBox14" />
									  <label class="list-group-item firmado" for="CheckBox14">
										Firmado por {{$registros->user->name}}     {{$registros->user->apellido}}
									  </label>
									  @else
									  <input type="checkbox" name="firma2" value="1" id="CheckBox14" />
									  <label class="list-group-item firma" for="CheckBox14">
										Sin firma de colaborador 
									  </label>
								   @endif
							 </div>
								</div>
							</td>
						</tr>

						<tr style="vertical-align: top;">
							<td style="width: 50%; padding-right: 10px;">
								<div>
								  <div class="t_neg"> Inducción de Puesto </div>
								  <div class="list-group">
									<input type="checkbox" name="oa" value="1" id="CheckBox34" />
									<label class="list-group-item  clase{{$registros->oa}}" for="CheckBox34">
									  Organigrama del Área
									  <span class="pull-right"> Jefe inmediato</span>
									</label>

									<input type="checkbox" name="explicacion" value="1" id="CheckBox35" />
									<label class="list-group-item  clase{{$registros->explicacion}}" for="CheckBox35">
									  Explicación de la Descripción del Puesto
									  <span class="pull-right"> Jefe inmediato </span>
									</label>

									<input type="checkbox" name="pp" value="1" id="CheckBox36" />
									<label class="list-group-item  clase{{$registros->pp}}" for="CheckBox36">
									  Procedimientos del Puesto
									  <span class="pull-right"> Jefe inmediato </span>
									</label>

									<input type="checkbox" name="instrucciones" value="1" id="CheckBox37" />
									<label class="list-group-item  clase{{$registros->instrucciones}}" for="CheckBox37">
									  Instrucciones de Trabajo del Puesto
									  <span class="pull-right"> Jefe inmediato </span>
									</label>

									<input type="checkbox" name="formatos" value="1" id="CheckBox38" />
									<label class="list-group-item   clase{{$registros->formatos}}" for="CheckBox38">
									  Formatos/ Reportes del Puesto
									  <span class="pull-right"> Jefe inmediato </span>
									</label>

									<input type="checkbox" name="presentacion" value="1" id="CheckBox39" />
									<label class="list-group-item  clase{{$registros->presentacion}}" for="CheckBox39">
									  Presentación al área
									  <span class="pull-right"> Jefe inmediato </span>
									</label>

								   @if ($registros->firma3)
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firmado" for="CheckBox14">
										Firmado por {{$registros->user->name}}     {{$registros->user->apellido}}
									  </label>
									  @else
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firma" for="CheckBox14">
										Sin firma de colaborador 
									  </label>
								   @endif

									@if ($registros->f_jefe)
									  <input type="checkbox" name="firma3" value="1" id="CheckBox14" />
									  <label class="list-group-item firmado" for="CheckBox14">
										Firmado por Jefe inmediato  
									  </label>
									  @else
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firma" for="CheckBox14">
										Sin firma de Jefe inmediato 
									  </label>
								   @endif
							 </div>
							</div>
							</td>

							<td style="width: 50%; padding-left: 10px;">
								<div>
								  <div class="t_neg"> Capacitación SGC</div>
								  <div class="list-group">
									<input type="checkbox" name="nuestro" value="1" id="CheckBox42" />
									<label class="list-group-item   clase{{$registros->nuestro}}" for="CheckBox42">
									  Nuestro sistema de calidad
									  <span class="pull-right"> AC</span>
									</label>

									<input type="checkbox" name="cinco" value="1" id="CheckBox43" />
									<label class="list-group-item  clase{{$registros->cinco}}" for="CheckBox43">
									  5S's
									  <span class="pull-right"> AC </span>
									</label>

									<input type="checkbox" name="politic" value="1" id="CheckBox44" />
									<label class="list-group-item   clase{{$registros->politic}}" for="CheckBox44">
									 Política y objetivos de calidad  
									  <span class="pull-right"> AC </span>
									</label>

									<input type="checkbox" name="portal" value="1" id="CheckBox45" />
									<label class="list-group-item  clase{{$registros->portal}}" for="CheckBox45">
									  Portal de calidad
									  <span class="pull-right"> AC </span>
									</label>

									<input type="checkbox" name="mapa" value="1" id="CheckBox46" />
									<label class="list-group-item  clase{{$registros->mapa}}" for="CheckBox46">
									  Mapa de procesos
									  <span class="pull-right"> AC</span>
									</label>

									<input type="checkbox" name="bip" value="1" id="CheckBox47" />
									<label class="list-group-item   clase{{$registros->bip}}" for="CheckBox47">
									  Proceso de mejora continua (BIP)
									  <span class="pull-right"> AC </span>
									</label>

								   @if ($registros->firma3)
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firmado" for="CheckBox14">
										Firmado por {{$registros->user->name}}     {{$registros->user->apellido}}
									  </label>
									  @else
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firma" for="CheckBox14">
										Sin firma de colaborador 
									  </label>
								   @endif

									@if ($registros->f_jefe)
									  <input type="checkbox" name="firma3" value="1" id="CheckBox14" />
									  <label class="list-group-item firmado" for="CheckBox14">
										Firmado por Jefe inmediato  
									  </label>
									  @else
									  <input type="checkbox" name="firma1" value="1" id="CheckBox14" />
									  <label class="list-group-item firma" for="CheckBox14">
										Sin firma de Jefe inmediato 
									  </label>
								   @endif
							 </div>
								</div>
							</td>
						</tr>
				  </table>

					<div class="notas">
						<div class="row">
							<div class="col-sm-12">
								<br><br>
								<strong>Nota 1:</strong> La Inducción General, deberá impartirse en un plazo de 1 semana a partir de la fecha de ingreso <br/>
								<strong>Nota 2:</strong> Respecto a la Inducción por áreas, los mensajeros y vigilantes tomarán los temas que indique su Jefe inmediato.<br><br> 
							</div>

							<div class="col-sm-12 responsables">
								<table class="table responsables" >
									<tr >
										<td colspan="4">
											<div class="li_head"> Responsables </div>
										</td>
									</tr>	
									<tr >
										<td>
											<ul>
											  <li>AP = Administración de Personal</li>
											  <li>DO = Desarrollo Organizacional</li>
											  <li>CE = Comercio Exterior</li>
											  <li>MP = Planeador de Materiales</li>
											</ul>
										</td>
										 
										<td>
											<ul>
												<li>JA = Jefe de Almacén</li>
												<li>SC = Servicio a Clientes</li>
											   <li> AV = Asesor Ventas </li>
											   <li> MKT = Mercadotecnia</li>
											   <li> P = Pricing</li>
											</ul>  
										</td>
										 
										<td>
											<ul>
											   <li>AGG = Asistente de Gerente General</li>
											   <li> CF = Cont. Y Finanzas</li>
											   <li>CC = Crédito y Cobranza</li>
											   <li> ST = Soporte Técnico</li>
											   <li> ID = Ingeniero de Didáctica</li>
											</ul> 
										</td>
										 
										<td>
											<ul>
											   <li>IM = Especialista  de Industria Automotriz</li>
											   <li> AC = Asesor de Calidad</li>
											   <li> ERYS= Especialista de Reclutamiento y Selección</li>
											</ul> 
										</td>
									</tr>
								</table>
								
							</div>
						</div>
					</div>

				 </div>
			</div>

         
    		</div>
        </div>
    </body>
</html>