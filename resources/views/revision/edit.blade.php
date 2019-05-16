@extends('voyager::master')

@section('page_header')
    <br/>

    <h1 class="page-title">
        <i class="voyager-thumbs-up"></i>
        Revisión {{$revision->tipo}} de Evaluación
    </h1>
@stop

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
    </div>
    
    <input name="desenpeno_id" type="hidden" value="{{$registros->id}}">
               
    <div class="panel-body">
        <div class="table-responsive">
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
                        <form method="POST" action="{{ route('revision.update', $revision->id) }}" role="form">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}
                            
                            <input name="desenpeno_id" type="hidden" value="{{$registros->id}}">
                            
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
                                            @for($i = 1; $i < 6; $i++)
                                                @if( $registros['objetivo'.$i] && $registros['meta'.$i] )
                                                    <tr>
                                                @else
                                                    <tr id="deshabilitar">
                                                @endif
                                                    <td>{{$registros['objetivo'.$i]}}</td>
                                                    <td>{{$registros['meta'.$i]}}</td>
                                                    <td>{{$registros['medida'.$i]}}</td>
                                                    <td>
                                                        @if($registros['fecha'.$i])
                                                            {{date('Y-m-d', strtotime($registros['fecha'.$i]))}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <select class="form-control form-control-sm input-sm" name="status{{$i}}" id="status{{$i}}">
                                                            <option>En proceso</option>
                                                            <option>Postergado</option>
                                                            <option>Completado</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="peso{{$i}}" id="peso{{$i}}" class="form-control input-sm objetivos" 
                                                               placeholder="%" value="{{$registros['peso'.$i]}}" oninput="calculate({{$i}})" readonly>
                                                    </td>  
                                                    <td>
                                                        <input type="text" name="alcanzada{{$i}}" id="alcanzada{{$i}}" class="form-control input-sm objetivos" 
                                                               placeholder="%" value="{{$revision['alcanzada'.$i]}}" oninput="calculate({{$i}});calculateTotal(1)" >
                                                    </td> 
                                                    <td>
                                                        <input type="text" name="ponderacion{{$i}}" id="ponderacion{{$i}}" class="form-control input-sm objetivos" 
                                                               value="{{$revision['ponderacion'.$i]}}" readonly>
                                                    </td>
                                                    <td>
                                                        <textarea name="comentarios{{$i}}" id="comentarios{{$i}}" class="form-control input-sm objetivos" >{{$revision['comentarios'.$i]}}</textarea>
                                                    </td>
                                                </tr>
                                            @endfor

                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total ponderación:    </td>
                                                <td><input type="text" name="total1" id="total1" class="form-control input-sm objetivos" value="{{$revision->total1}}"></td>
                                                <td></td>
                                            </tr>
                                            
                                            <tr class="total-objetivos">
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos CSP ó Individuales:</font>
                                                </td>
                                                <td bgcolor="gray"  align="left" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">
                                                        <span id="totalCSP">{{$revision->totalCSP}}</span> %
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
                                            @for($i = 6; $i < 11; $i++)
                                                @if( $registros['objetivo'.$i] && $registros['meta'.$i] )
                                                    <tr>
                                                @else
                                                    <tr id="deshabilitar">
                                                @endif
                                                    <td>{{$registros['objetivo'.$i]}}</td>
                                                    <td>{{$registros['meta'.$i]}}</td>
                                                    <td>{{$registros['medida'.$i]}}</td>
                                                    <td>
                                                        @if($registros['fecha'.$i])
                                                            {{date('Y-m-d', strtotime($registros['fecha'.$i]))}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <select class="form-control form-control-sm input-sm" name="status{{$i}}" id="status{{$i}}">
                                                            <option>En proceso</option>
                                                            <option>Postergado</option>
                                                            <option>Completado</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="peso{{$i}}" id="peso{{$i}}" class="form-control input-sm objetivos" 
                                                               placeholder="%" value="{{$registros['peso'.$i]}}" oninput="calculate({{$i}})" readonly>
                                                    </td>  
                                                    <td>
                                                        <input type="text" name="alcanzada{{$i}}" id="alcanzada{{$i}}" class="form-control input-sm objetivos" 
                                                               placeholder="%" value="{{$revision['alcanzada'.$i]}}" oninput="calculate({{$i}});calculateTotal(2)" >
                                                    </td> 
                                                    <td>
                                                        <input type="text" name="ponderacion{{$i}}" id="ponderacion{{$i}}" class="form-control input-sm objetivos" 
                                                               value="{{$revision['ponderacion'.$i]}}" readonly>
                                                    </td>
                                                    <td>
                                                        <textarea name="comentarios{{$i}}" id="comentarios{{$i}}" class="form-control input-sm objetivos" >{{$revision['comentarios'.$i]}}</textarea>
                                                    </td>
                                                </tr>
                                            @endfor
                                            
                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total ponderación:</td>
                                                <td><input type="text" name="total2" id="total2" class="form-control input-sm objetivos" value="{{$revision->total2}}"  ></td>
                                                <td></td>
                                            </tr>
                                            
                                            <tr class="total-objetivos">
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos Administrativos:</font>
                                                </td>
                                                <td bgcolor="gray"  align="left" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">
                                                        <span id="totalAdmon">{{$revision->totalAdmon}}</span> %
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
                                            @for($i = 11; $i < 14; $i++)
                                                @if( $registros['objetivo'.$i] && $registros['meta'.$i] )
                                                    <tr>
                                                @else
                                                    <tr id="deshabilitar">
                                                @endif
                                                    <td>{{$registros['objetivo'.$i]}}</td>
                                                    <td>{{$registros['meta'.$i]}}</td>
                                                    <td>{{$registros['medida'.$i]}}</td>
                                                    <td>
                                                        @if($registros['fecha'.$i])
                                                            {{date('Y-m-d', strtotime($registros['fecha'.$i]))}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <select class="form-control form-control-sm input-sm" name="status{{$i}}" id="status{{$i}}">
                                                            <option>En proceso</option>
                                                            <option>Postergado</option>
                                                            <option>Completado</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="peso{{$i}}" id="peso{{$i}}" class="form-control input-sm objetivos" 
                                                               placeholder="%" value="{{$registros['peso'.$i]}}" oninput="calculate({{$i}})" readonly>
                                                    </td>  
                                                    <td>
                                                        <input type="text" name="alcanzada{{$i}}" id="alcanzada{{$i}}" class="form-control input-sm objetivos" 
                                                               placeholder="%" value="{{$revision['alcanzada'.$i]}}" oninput="calculate({{$i}});calculateTotal(3)" >
                                                    </td> 
                                                    <td>
                                                        <input type="text" name="ponderacion{{$i}}" id="ponderacion{{$i}}" class="form-control input-sm objetivos" 
                                                               value="{{$revision['ponderacion'.$i]}}" readonly>
                                                    </td>
                                                    <td>
                                                        <textarea name="comentarios{{$i}}" id="comentarios{{$i}}" class="form-control input-sm objetivos" >{{$revision['comentarios'.$i]}}</textarea>
                                                    </td>
                                                </tr>
                                            @endfor
                                            
                                            <tr>
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total ponderación:    </td>
                                                <td><input type="text" name="total3" id="total3" class="form-control input-sm objetivos" value="{{$revision->total3}}"  ></td>
                                                <td></td>
                                            </tr>
                                            
                                            <tr class="total-objetivos">
                                                <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos Cultura:</font>
                                                </td>
                                                <td bgcolor="gray"  align="left" vertical-align="bottom">
                                                    <font color="#fff" style="line-height:30px; padding-right:5px;">
                                                        <span id="totalCultura">{{$revision->totalCultura}}</span> %
                                                    </font>
                                                </td>
                                                <td bgcolor="gray"></td>
                                            </tr>
                                            
                                        </tbody>
                                    </div>
                                </table>
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
                                            <span id="totalCSP2">{{$revision->totalCSP}}</span> %
                                        </td>

                                        <td>
                                            <span id="totalAdmon2">{{$revision->totalAdmon}}</span> %
                                        </td>

                                        <td >
                                            <span id="totalCultura2">{{$revision->totalCultura}}</span> %
                                        </td>

                                        <td>
                                            <span id="totalGeneral">{{$revision->total}}</span> %
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                <a href="{{ route('revision.index') }}" class="btn btn-info btn-block" >Atrás</a>
                            </div>

                        </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
         
@section('javascript')
    <script>
        const pesoCSP = {{$registros->peso_oindividuales}} || 0;
        const pesoAdmon = {{$registros->peso_oadmon}} || 0;
        const pesoCultura =  {{$registros->peso_ocultura}} || 0;
        
        function calculate(campoId) {
             var myBox1 = document.getElementById('peso'+campoId).value || 0;	
             var myBox2 = document.getElementById('alcanzada'+campoId).value || 0;
             var ponderacion1 = document.getElementById('ponderacion'+campoId) || 0;	
             var myResult = (myBox1 * myBox2)/100;
             ponderacion1.value = myResult;
        }
        
        function calculateTotal(campoId) {
            
            var myBox1 = 0;	
            var myBox2 = 0;	
            var myBox3 = 0;	
            var myBox4 = 0;	
            var myBox5 = 0;	
            var ponderacion1 = null;
            
            if(campoId == 1) {
                myBox1 = document.getElementById('ponderacion1').value || 0;	
                myBox2 = document.getElementById('ponderacion2').value || 0;	
                myBox3 = document.getElementById('ponderacion3').value || 0;	
                myBox4 = document.getElementById('ponderacion4').value || 0;	
                myBox5 = document.getElementById('ponderacion5').value || 0;	
                ponderacion1 = document.getElementById('total1');
            }
            else if(campoId == 2) {
                myBox1 = document.getElementById('ponderacion6').value || 0;	
                myBox2 = document.getElementById('ponderacion7').value || 0;	
                myBox3 = document.getElementById('ponderacion8').value || 0;	
                myBox4 = document.getElementById('ponderacion9').value || 0;	
                myBox5 = document.getElementById('ponderacion10').value || 0;	
                ponderacion1 = document.getElementById('total2');
            }
            else if(campoId == 3) {
                myBox1 = document.getElementById('ponderacion11').value || 0;	
                myBox2 = document.getElementById('ponderacion12').value || 0;	
                myBox3 = document.getElementById('ponderacion13').value || 0;	
                ponderacion1 = document.getElementById('total3');
            }
            
            var myResult = parseInt(myBox1) + parseInt(myBox2) + parseInt(myBox3) + parseInt(myBox4) + parseInt(myBox5);
            ponderacion1.value = myResult;
            
            if(campoId == 1) {
                document.getElementById('totalCSP').textContent = (parseFloat(pesoCSP) * myResult)/100;
                document.getElementById('totalCSP2').textContent = (parseFloat(pesoCSP) * myResult)/100;
            }
            else if(campoId == 2) {
                document.getElementById('totalAdmon').textContent = (parseFloat(pesoAdmon) * myResult)/100;
                document.getElementById('totalAdmon2').textContent = (parseFloat(pesoAdmon) * myResult)/100;
            }
            else if(campoId == 3) {
                document.getElementById('totalCultura').textContent = (parseFloat(pesoCultura) * myResult)/100;
                document.getElementById('totalCultura2').textContent = (parseFloat(pesoCultura) * myResult)/100;
            }
            
            var a = document.getElementById('totalCSP').textContent || 0;
            var b = document.getElementById('totalAdmon').textContent || 0;
            var c = document.getElementById('totalCultura').textContent || 0;
            console.log(a,b,c);
            document.getElementById('totalGeneral').textContent = parseFloat(a) + parseFloat(b) + parseFloat(c);
        }
    </script> 
          
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#form').validate({ // initialize the plugin
                rules: {
                  integrado: {
                        required: true
                             },
                  retos: {
                        required: true
                             },
                  equipo: {
                        required: true
                             },
                  conocimiento: {
                        required: true
                             },
                  responsabilidades: {
                        required: true
                             },
                  habilidades: {
                        required: true
                             },
                  lider: {
                        required: true
                             },
                  recomienda: {
                        required: true
                             },
                  fortalezas: {
                        required: true
                             },
                  mejoras: {
                        required: true
                             },
            },
              messages: {
              integrado: "Campo obligatorio",
              retos: "Campo obligatorio",
              equipo: "Campo obligatorio",
              retos: "Campo obligatorio",
              conocimiento: "Campo obligatorio",
              responsabilidades: "Campo obligatorio",
                 habilidades: "Campo obligatorio",
                 lider: "Campo obligatorio",
                 recomienda: "Campo obligatorio",
                 fortalezas: "Campo obligatorio",
                 mejoras: "Campo obligatorio",
              }
            });
        });
    </script> 
              
@endsection     