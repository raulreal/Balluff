<!DOCTYPE html>
<html>
<head>
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
    border
  }
  
  .panel.panel-primary .panel-heading {
    background-color: #f8fafc !important;
    border-bottom: solid 4px #e9e9e9 !important;
    margin: 20px 0px 5px!important;
    vertical-align: center;
}
  
</style>
</head>
<body>

 <div class="col-md-12"> 
  <div style="width:50%; display:inline-block;"> 
      <h2 class="page-title">
          Evaluacion de Desempeño
      </h2>
      <h3 class="page-title">
          Definición de Objetivos
      </h3>
  </div>
   
  <div style="width:49%; text-align:right; display:inline-block;"> 
      <img src="{{ asset('storage/settings/camino.png') }}" height="50px">
  </div>
   
</div>

  <div class="col-md-12">    
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">
          <div class="panel panel-primary">
              <div class="row datososc">
                  <div class="col-sm-12"><center><h3 style="    margin: 4px;">
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

              <div class="panel-body">					
                <div class="table-container">

                    <div class="panel-heading">
                        <div style="display:inline-block; margin-left:5px;">
                          <img src="{{ asset('storage/settings/icono3.png') }}" height="20">
                        </div>
                       Objetivos CSP ó Individuales | Peso:  {{$registros->peso_oindividuales}} %
                    </div>
                
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
                              <th style="width: 20%">Comentarios adicionales</th>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo1}}</td>
                              <td>{{$registros->meta1}}</td>
                              <td>{{$registros->medida1}}</td>
                              <td>
                                @if($registros->fecha1)
                                  {{ date('Y-m-d', strtotime($registros->fecha1)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus1}}</td>
                              <td>{{$registros->peso1}}</td>
                              <td>{{$registros->alcanzada1}}</td>  
                              <td>{{$registros->comentarios1}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo2}}</td>
                              <td>{{$registros->meta2}}</td>
                              <td>{{$registros->medida2}}</td>
                              <td>
                                @if($registros->fecha2)
                                  {{ date('Y-m-d', strtotime($registros->fecha2)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus2}}</td>
                              <td>{{$registros->peso2}}</td>
                              <td>{{$registros->alcanzada2}}</td>  
                              <td>{{$registros->comentarios2}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo3}}</td>
                              <td>{{$registros->meta3}}</td>
                              <td>{{$registros->medida3}}</td>
                              <td>
                                @if($registros->fecha3)
                                  {{ date('Y-m-d', strtotime($registros->fecha3)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus3}}</td>
                              <td>{{$registros->peso3}}</td>
                              <td>{{$registros->alcanzada3}}</td>  
                              <td>{{$registros->comentarios3}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo4}}</td>
                              <td>{{$registros->meta4}}</td>
                              <td>{{$registros->medida4}}</td>
                              <td>
                                @if($registros->fecha4)
                                  {{ date('Y-m-d', strtotime($registros->fecha4)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus4}}</td>
                              <td>{{$registros->peso4}}</td>
                              <td>{{$registros->alcanzada4}}</td>  
                              <td>{{$registros->comentarios4}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo5}}</td>
                              <td>{{$registros->meta5}}</td>
                              <td>{{$registros->medida5}}</td>
                              <td>
                                @if($registros->fecha5)
                                  {{ date('Y-m-d', strtotime($registros->fecha5)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus5}}</td>
                              <td>{{$registros->peso5}}</td>
                              <td>{{$registros->alcanzada5}}</td>  
                              <td>{{$registros->comentarios5}}</td>
                           </tr>
                           <tr>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td colspan="2">Total Objetivos individuales:</td>
                               <td>100</td>
                               <td></td>
                               <td></td>
                           </tr>
                      </table>
                    </div>

                    <div class="panel-heading">
                        <div style="display:inline-block; margin-left:5px;">
                            <img src="{{ asset('storage/settings/icono2.png') }}" height="20">
                        </div>
                        Objetivos Administrativos | Peso: {{$registros->peso_oadmon}} %
                    </div>
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
                              <th style="width: 20%">Comentarios adicionales</th>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo6}}</td>
                              <td>{{$registros->meta6}}</td>
                              <td>{{$registros->medida6}}</td>
                              <td>
                                @if($registros->fecha6)
                                  {{ date('Y-m-d', strtotime($registros->fecha6)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus6}}</td>
                              <td>{{$registros->peso6}}</td>
                              <td>{{$registros->alcanzada6}}</td>  
                              <td>{{$registros->comentarios6}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo7}}</td>
                              <td>{{$registros->meta7}}</td>
                              <td>{{$registros->medida7}}</td>
                              <td>
                                @if($registros->fecha7)
                                  {{ date('Y-m-d', strtotime($registros->fecha7)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus7}}</td>
                              <td>{{$registros->peso7}}</td>
                              <td>{{$registros->alcanzada7}}</td>  
                              <td>{{$registros->comentarios7}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo8}}</td>
                              <td>{{$registros->meta8}}</td>
                              <td>{{$registros->medida8}}</td>
                              <td>
                                @if($registros->fecha8)
                                  {{ date('Y-m-d', strtotime($registros->fecha8)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus8}}</td>
                              <td>{{$registros->peso8}}</td>
                              <td>{{$registros->alcanzada8}}</td>  
                              <td>{{$registros->comentarios8}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo9}}</td>
                              <td>{{$registros->meta9}}</td>
                              <td>{{$registros->medida9}}</td>
                              <td>
                                @if($registros->fecha9)
                                  {{ date('Y-m-d', strtotime($registros->fecha9)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus9}}</td>
                              <td>{{$registros->peso9}}</td>
                              <td>{{$registros->alcanzada9}}</td>  
                              <td>{{$registros->comentarios9}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo10}}</td>
                              <td>{{$registros->meta10}}</td>
                              <td>{{$registros->medida10}}</td>
                              <td>
                                @if($registros->fecha10)
                                  {{ date('Y-m-d', strtotime($registros->fecha10)) }}
                                @endif                   
                              </td>
                              <td>{{$registros->estatus10}}</td>
                              <td>{{$registros->peso10}}</td>
                              <td>{{$registros->alcanzada10}}</td>  
                              <td>{{$registros->comentarios10}}</td>
                           </tr>
                            
                           <tr>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td  colspan="2">Total Objetivos Administrativos:</td>
                               <td>100</td>
                               <td></td>
                               <td></td>
                          </tr>
                            
                          </tbody>
                      </table>
                    </div>

                    <div class="panel-heading">
                        <div style="display:inline-block; margin-left:5px;">
                            <img src="{{ asset('storage/settings/icono1.png') }}" height="20">
                        </div>
                        Objetivos Cultura Organizacional | Peso: {{$registros->peso_ocultura}} %
                    </div>
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
                                  <th style="width: 20%">Comentarios adicionales</th>
                              </tr>
                              <tr>
                                  <td>{{$registros->objetivo11}}</td>
                                  <td>{{$registros->meta11}}</td>
                                  <td>{{$registros->medida11}}</td>
                                  <td>
                                    @if($registros->fecha11)
                                      {{ date('Y-m-d', strtotime($registros->fecha11)) }}
                                    @endif                   
                                  </td>
                                  <td>{{$registros->estatus11}}</td>
                                  <td>{{$registros->peso11}}</td>
                                  <td>{{$registros->alcanzada11}}</td>  
                                  <td>{{$registros->comentarios11}}</td>
                              </tr>
                              <tr>
                                <td>{{$registros->objetivo12}}</td>
                                <td>{{$registros->meta12}}</td>
                                <td>{{$registros->medida12}}</td>
                                <td>
                                  @if($registros->fecha12)
                                    {{ date('Y-m-d', strtotime($registros->fecha12)) }}
                                  @endif                   
                                </td>
                                <td>{{$registros->estatus12}}</td>
                                <td>{{$registros->peso12}}</td>
                                <td>{{$registros->alcanzada12}}</td>  
                                <td>{{$registros->comentarios12}}</td>
                              </tr>
                              <tr>
                                <td>{{$registros->objetivo13}}</td>
                                <td>{{$registros->meta13}}</td>
                                <td>{{$registros->medida13}}</td>
                                <td>
                                  @if($registros->fecha13)
                                    {{ date('Y-m-d', strtotime($registros->fecha13)) }}
                                  @endif                   
                                </td>
                                <td>{{$registros->estatus13}}</td>
                                <td>{{$registros->peso13}}</td>
                                <td>{{$registros->alcanzada13}}</td>  
                                <td>{{$registros->comentarios13}}</td>
                             </tr>
                             <tr>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td  colspan="2">Total Objetivos de Cultura Organizacional</td>
                               <td>100</td>
                               <td></td>
                               <td></td>
                            </tr>
                      </table>
                      
                      <div> <br> </div>
                      
                      <table>
                        <tr>
                          <td><strong>Total de Objetivos:  </strong></td>
                          <td>{{$registros->peso_total}}</td>
                          <td> %</td>
                          <td> </td>
                        </tr>
                      </table>
                    </div>
         
                </div>
              </div>
              
         @if(isset($resutado))
              <div class="row datososc" style="margin-top:15px;">
                  <div class="col-sm-12"><center><h3 style="margin: 4px;">
                    RESULTADOS
                    </h3></center>
                  </div>
                  <table class="table">
                     <tr>
                        <th>Total objetivos individuales</th>
                        <th>Total objetivos administrativos</th>
                        <th>Total Objetivos de cultura organizacional</th>
                        <th>Evaluación Final</th>
                     </tr>
                     <tr>
                        <td>
                          @if ($registros->e_final)
                            {{$registros->total1 * ($registros->peso_oindividuales/100) }}
                          @else
                            0
                          @endif
                       </td>
                       
                        <td>
                          @if ($registros->e_final)  
                            {{$registros->total2 * ($registros->peso_oadmon/100) }} 
                          @else
                            0
                          @endif
                        </td>
                       
                        <td>
                            @if ($registros->e_final)  
                              {{$registros->total3 * ($registros->peso_ocultura/100) }}
                            @else
                              0
                            @endif
                       </td>
                       
                        <td>
                          {{$registros->e_final}}
                        </td>
                     </tr>
                  </table>
              </div>
         @endif
         
     
            </div>
          </div>
       </div>
     </div>
  </div>


</body>
</html>