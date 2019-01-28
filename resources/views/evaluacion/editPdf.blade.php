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
                        <td>{{ $registros->user->departamento->nombre }}</td>
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
                              <td>{{$registros->fecha1}}</td>
                              <td>{{$registros->estatus1}}</td>
                              <td>{{$registros->peso1}}</td>
                              <td>{{$registros->alcanzada1}}</td>  
                              <td>{{$registros->comentarios1}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo2}}</td>
                              <td>{{$registros->meta2}}</td>
                              <td>{{$registros->medida2}}</td>
                              <td>{{$registros->fecha2}}</td>
                              <td>{{$registros->estatus2}}</td>
                              <td>{{$registros->peso2}}</td>
                              <td>{{$registros->alcanzada2}}</td>  
                              <td>{{$registros->comentarios2}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo3}}</td>
                              <td>{{$registros->meta3}}</td>
                              <td>{{$registros->medida3}}</td>
                              <td>{{$registros->fecha3}}</td>
                              <td>{{$registros->estatus3}}</td>
                              <td>{{$registros->peso3}}</td>
                              <td>{{$registros->alcanzada3}}</td>  
                              <td>{{$registros->comentarios3}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo4}}</td>
                              <td>{{$registros->meta4}}</td>
                              <td>{{$registros->medida4}}</td>
                              <td>{{$registros->fecha4}}</td>
                              <td>{{$registros->estatus4}}</td>
                              <td>{{$registros->peso4}}</td>
                              <td>{{$registros->alcanzada4}}</td>  
                              <td>{{$registros->comentarios4}}</td>
                           </tr>
                           <tr>
                              <td>{{$registros->objetivo5}}</td>
                              <td>{{$registros->meta5}}</td>
                              <td>{{$registros->medida5}}</td>
                              <td>{{$registros->fecha5}}</td>
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
                              <td>{{$registros->fecha6}}</td>
                              <td>{{$registros->estatus6}}</td>
                              <td>{{$registros->peso6}}</td>
                              <td>{{$registros->alcanzada6}}</td>  
                              <td>{{$registros->comentarios6}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo7}}</td>
                              <td>{{$registros->meta7}}</td>
                              <td>{{$registros->medida7}}</td>
                              <td>{{$registros->fecha7}}</td>
                              <td>{{$registros->estatus7}}</td>
                              <td>{{$registros->peso7}}</td>
                              <td>{{$registros->alcanzada7}}</td>  
                              <td>{{$registros->comentarios7}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo8}}</td>
                              <td>{{$registros->meta8}}</td>
                              <td>{{$registros->medida8}}</td>
                              <td>{{$registros->fecha8}}</td>
                              <td>{{$registros->estatus8}}</td>
                              <td>{{$registros->peso8}}</td>
                              <td>{{$registros->alcanzada8}}</td>  
                              <td>{{$registros->comentarios8}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo9}}</td>
                              <td>{{$registros->meta9}}</td>
                              <td>{{$registros->medida9}}</td>
                              <td>{{$registros->fecha9}}</td>
                              <td>{{$registros->estatus9}}</td>
                              <td>{{$registros->peso9}}</td>
                              <td>{{$registros->alcanzada9}}</td>  
                              <td>{{$registros->comentarios9}}</td>
                           </tr>

                           <tr>
                              <td>{{$registros->objetivo10}}</td>
                              <td>{{$registros->meta10}}</td>
                              <td>{{$registros->medida10}}</td>
                              <td>{{$registros->fecha10}}</td>
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
                                  <td>{{$registros->fecha11}}</td>
                                  <td>{{$registros->estatus11}}</td>
                                  <td>{{$registros->peso11}}</td>
                                  <td>{{$registros->alcanzada11}}</td>  
                                  <td>{{$registros->comentarios11}}</td>
                              </tr>
                              <tr>
                                <td>{{$registros->objetivo12}}</td>
                                <td>{{$registros->meta12}}</td>
                                <td>{{$registros->medida12}}</td>
                                <td>{{$registros->fecha12}}</td>
                                <td>{{$registros->estatus12}}</td>
                                <td>{{$registros->peso12}}</td>
                                <td>{{$registros->alcanzada12}}</td>  
                                <td>{{$registros->comentarios12}}</td>
                              </tr>
                              <tr>
                                <td>{{$registros->objetivo13}}</td>
                                <td>{{$registros->meta13}}</td>
                                <td>{{$registros->medida13}}</td>
                                <td>{{$registros->fecha13}}</td>
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
     
            </div>
          </div>
       </div>
     </div>
  </div>


</body>
</html>