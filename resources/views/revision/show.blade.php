@extends('voyager::master')

@section('page_header')

  <br/>

  <h1 class="page-title">
      <i class="voyager-thumbs-up"></i>
      Revision {{$registros->tipo}} de Evaluación
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
                      <div class="col-sm-12"><center><h3>
                        DATOS PERSONALES
                        </h3></center></div>
                      <div class="col-sm-2"><strong>Nombre del Colaborador:</strong><br/> {{ $registros->desenpeno->user->name }} {{ $registros->desenpeno->user->apellido }}</div>
                      <div class="col-sm-2"><strong>Nombre del Jefe inmediato:</strong><br/>  
                        @if($registros->desenpeno->user->miJefe)
                          <td> {{ $registros->desenpeno->user->miJefe->name }} {{ $registros->desenpeno->user->miJefe->apellido }}</td>
                        @else
                          <td> Sin jefe </td>
                        @endif
                      </div>
                      <div class="col-sm-2"><strong>Puesto:</strong><br/>  {{ $registros->desenpeno->user->puesto }} <h1>

                        </h1></div>
                      <div class="col-sm-2"><strong>Año: </strong><br/> 2019</div>
                      <div class="col-sm-2"><strong>Departamento o área: </strong><br/>
                        @if($registros->desenpeno->user->departamento)
                            {{ $registros->desenpeno->user->departamento->nombre }}
                        @endif
                      </div>
                      <div class="col-sm-2"><strong>Fecha de ingreso: </strong><br/> {{ $registros->desenpeno->user->fecha_ingreso }}</div>
                  </div>
                        
        <div class="panel-body">					
					<div class="table-container">
           
  <form method="POST" action="{{ route('revision.store') }}"  role="form">
							{{ csrf_field() }}
      <input name="desenpeno_id" type="hidden" value="{{$registros->id}}">
              <div class="panel-heading">Objetivos CSP ó Individuales <span><strong>{{$registros->desenpeno->peso_oindividuales}} %</strong></span></div>               
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
                  <td><p>{{$registros->desenpeno->objetivo1}}</p></td>
                  <td><p>{{$registros->desenpeno->meta1}}</p></td>
                  <td><p>{{$registros->desenpeno->medida1}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha1}}</p></td>
                  <td><p>{{$registros->status1}}</p></td>
                  <td>{{$registros->desenpeno->peso1}}</td>  
                  <td>{{$registros->alcanzada1}}</td>  
                  <td>{{$registros->ponderacion1}}</td>
                  <td>{{$registros->comentarios1}}</td>
               </tr>
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo2}}</p></td>
                  <td><p>{{$registros->desenpeno->meta2}}</p></td>
                  <td><p>{{$registros->desenpeno->medida2}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha2}}</p></td>
                  <td><p>{{$registros->status1}}</p></td>
                  <td>{{$registros->desenpeno->peso2}}</td>  
                  <td>{{$registros->alcanzada2}}</td>  
                  <td>{{$registros->ponderacion2}}</td>
                  <td>{{$registros->comentarios2}}</td>
               </tr>
               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo3}}</p></td>
                  <td><p>{{$registros->desenpeno->meta3}}</p></td>
                  <td><p>{{$registros->desenpeno->medida3}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha3}}</p></td>
                  <td><p>{{$registros->status1}}</p></td>
                  <td>{{$registros->desenpeno->peso3}}</td>  
                  <td>{{$registros->alcanzada3}}</td>  
                  <td>{{$registros->ponderacion3}}</td>
                  <td>{{$registros->comentarios3}}</td>
               </tr>
               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo4}}</p></td>
                  <td><p>{{$registros->desenpeno->meta4}}</p></td>
                  <td><p>{{$registros->desenpeno->medida4}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha4}}</p></td>
                  <td><p>{{$registros->status4}}</p></td>
                  <td>{{$registros->desenpeno->peso4}}</td>  
                  <td>{{$registros->alcanzada4}}</td>  
                  <td>{{$registros->ponderacion4}}</td>
                  <td>{{$registros->comentarios4}}</td>
               </tr>
               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo5}}</p></td>
                  <td><p>{{$registros->desenpeno->meta5}}</p></td>
                  <td><p>{{$registros->desenpeno->medida5}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha5}}</p></td>
                  <td><p>{{$registros->status5}}</p></td>
                  <td>{{$registros->desenpeno->peso5}}</td>  
                  <td>{{$registros->alcanzada5}}</td>  
                  <td>{{$registros->ponderacion5}}</td>
                  <td>{{$registros->comentarios5}}</td>
               </tr>
               
               <tr>
                 <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos individuales:    </td>
                 <td>{{$registros->total1}}</td>
                 <td></td>
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
                  <td><p>{{$registros->desenpeno->objetivo6}}</p></td>
                  <td><p>{{$registros->desenpeno->meta6}}</p></td>
                  <td><p>{{$registros->desenpeno->medida6}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha6}}</p></td>
                  <td><p>{{$registros->status6}}</p></td>
                  <td>{{$registros->desenpeno->peso6}}</td>  
                  <td>{{$registros->alcanzada6}}</td>  
                  <td>{{$registros->ponderacion6}}</td>
                  <td>{{$registros->comentarios6}}</td>
               </tr>
               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo7}}</p></td>
                  <td><p>{{$registros->desenpeno->meta7}}</p></td>
                  <td><p>{{$registros->desenpeno->medida7}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha7}}</p></td>
                  <td><p>{{$registros->status7}}</p></td>
                  <td>{{$registros->desenpeno->peso7}}</td>  
                  <td>{{$registros->alcanzada7}}</td>  
                  <td>{{$registros->ponderacion7}}</td>
                  <td>{{$registros->comentarios7}}</td>
               </tr>
               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo8}}</p></td>
                  <td><p>{{$registros->desenpeno->meta8}}</p></td>
                  <td><p>{{$registros->desenpeno->medida8}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha8}}</p></td>
                  <td><p>{{$registros->status8}}</p></td>
                  <td>{{$registros->desenpeno->peso8}}</td>  
                  <td>{{$registros->alcanzada8}}</td>  
                  <td>{{$registros->ponderacion8}}</td>
                  <td>{{$registros->comentarios8}}</td>
               </tr>
               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo9}}</p></td>
                  <td><p>{{$registros->desenpeno->meta9}}</p></td>
                  <td><p>{{$registros->desenpeno->medida9}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha9}}</p></td>
                  <td><p>{{$registros->status9}}</p></td>
                  <td>{{$registros->desenpeno->peso9}}</td>  
                  <td>{{$registros->alcanzada9}}</td>  
                  <td>{{$registros->ponderacion9}}</td>
                  <td>{{$registros->comentarios9}}</td>
               </tr>
               
               <tr>
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo10}}</p></td>
                  <td><p>{{$registros->desenpeno->meta10}}</p></td>
                  <td><p>{{$registros->desenpeno->medida10}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha10}}</p></td>
                  <td><p>{{$registros->status10}}</p></td>
                  <td>{{$registros->desenpeno->peso10}}</td>  
                  <td>{{$registros->alcanzada10}}</td>  
                  <td>{{$registros->ponderacion10}}</td>
                  <td>{{$registros->comentarios10}}</td>
               </tr>
               
               <tr>
                 <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total objetivos  administrativos:    </td>
                 <td>{{$registros->total2}}</td>
                 <td></td>
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
                  <td><p>{{$registros->desenpeno->objetivo11}}</p></td>
                  <td><p>{{$registros->desenpeno->meta11}}</p></td>
                  <td><p>{{$registros->desenpeno->medida11}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha11}}</p></td>
                  <td><p>{{$registros->status10}}</p></td>
                  <td>{{$registros->desenpeno->peso11}}</td>  
                  <td>{{$registros->alcanzada11}}</td>  
                  <td>{{$registros->ponderacion11}}</td>
                  <td>{{$registros->comentarios11}}</td>
               </tr>
               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo12}}</p></td>
                  <td><p>{{$registros->desenpeno->meta12}}</p></td>
                  <td><p>{{$registros->desenpeno->medida12}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha12}}</p></td>
                  <td><p>{{$registros->status12}}</p></td>
                  <td>{{$registros->desenpeno->peso12}}</td>  
                  <td>{{$registros->alcanzada12}}</td>  
                  <td>{{$registros->ponderacion12}}</td>
                  <td>{{$registros->comentarios12}}</td>
               </tr>
               

               
                <tr>
                  <td><p>{{$registros->desenpeno->objetivo13}}</p></td>
                  <td><p>{{$registros->desenpeno->meta13}}</p></td>
                  <td><p>{{$registros->desenpeno->medida13}}</p></td>
                  <td><p>{{$registros->desenpeno->fecha13}}</p></td>
                  <td><p>{{$registros->status13}}</p></td>
                  <td>{{$registros->desenpeno->peso13}}</td>  
                  <td>{{$registros->alcanzada13}}</td>  
                  <td>{{$registros->ponderacion13}}</td>
                  <td>{{$registros->comentarios13}}</td>
               </tr>
                 <tr>
                 <td bgcolor="gray" colspan="7" align="right" vertical-align="bottom"><font color="#fff" style="line-height:30px; padding-right:5px;">Total Objetivos de cultura organizacional:    </td>
                 <td>{{$registros->total3}}</td>
                 <td></td>
               </tr>
  
            </tbody>
                </div>
          </table>
    
							</div>
						</form>
          </div>
                        </div>
                   </div>
                   
                <div class="col-xs-12 col-sm-12 col-md-12">
									<a href="{{ route('revision.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	
            
                 </div>
</div>
            <div class="firmas">
                
            @if ($registros->f_empleado)
                <div class="alert alert-success" role="alert">
                  Firmado por {{ $registros->user->name  }} {{ $registros->user->appellido  }}
                </div> 
             @else
                  @if ($registros->desenpeno->user->id === $usr->id)
                        <a href="{{ route('revision.firma',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                            <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación Empleado</span>
                        </a>
                  @endif
              @endif
                
              @if ($registros->f_jefe)
                <div class="alert alert-success" role="alert">
                  Firmado por {{ $registros->desenpeno->user->miJefe->name }} {{ $registros->desenpeno->user->miJefe->apellido }}
                </div> 
             @else
                  @if ($registros->desenpeno->user->miJefe->id === $usr->id)
                        <a href="{{ route('revision.firma1',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
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

                            <a href="{{ route('revision.firma2',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                                <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación RH</span>
                            </a>
                  @endif
              @endif


                
              </div>
              
@endsection
         
@section('javascript')
            
 <script>     
  function calculate() {
		var myBox1 = document.getElementById('peso1').value;	
		var myBox2 = document.getElementById('alcanzada1').value;
		var ponderacion1 = document.getElementById('ponderacion1');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}       
     function calculate2() {
		var myBox1 = document.getElementById('peso2').value;	
		var myBox2 = document.getElementById('alcanzada2').value;
		var ponderacion1 = document.getElementById('ponderacion2');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
     function calculate3() {
		var myBox1 = document.getElementById('peso3').value;	
		var myBox2 = document.getElementById('alcanzada3').value;
		var ponderacion1 = document.getElementById('ponderacion3');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}       
     function calculate4() {
		var myBox1 = document.getElementById('peso4').value;	
		var myBox2 = document.getElementById('alcanzada4').value;
		var ponderacion1 = document.getElementById('ponderacion4');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
     function calculate5() {
		var myBox1 = document.getElementById('peso5').value;	
		var myBox2 = document.getElementById('alcanzada5').value;
		var ponderacion1 = document.getElementById('ponderacion5');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}       
     function calculate6() {
		var myBox1 = document.getElementById('peso6').value;	
		var myBox2 = document.getElementById('alcanzada6').value;
		var ponderacion1 = document.getElementById('ponderacion6');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
     function calculate7() {
		var myBox1 = document.getElementById('peso7').value;	
		var myBox2 = document.getElementById('alcanzada7').value;
		var ponderacion1 = document.getElementById('ponderacion7');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}       
     function calculate8() {
		var myBox1 = document.getElementById('peso8').value;	
		var myBox2 = document.getElementById('alcanzada8').value;
		var ponderacion1 = document.getElementById('ponderacion8');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
        function calculate9() {
		var myBox1 = document.getElementById('peso9').value;	
		var myBox2 = document.getElementById('alcanzada9').value;
		var ponderacion1 = document.getElementById('ponderacion9');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
        function calculate10() {
		var myBox1 = document.getElementById('peso10').value;	
		var myBox2 = document.getElementById('alcanzada10').value;
		var ponderacion1 = document.getElementById('ponderacion10');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
        function calculate11() {
		var myBox1 = document.getElementById('peso11').value;	
		var myBox2 = document.getElementById('alcanzada11').value;
		var ponderacion1 = document.getElementById('ponderacion11');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
        function calculate12() {
		var myBox1 = document.getElementById('peso12').value;	
		var myBox2 = document.getElementById('alcanzada12').value;
		var ponderacion1 = document.getElementById('ponderacion12');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
        function calculate13() {
		var myBox1 = document.getElementById('peso13').value;	
		var myBox2 = document.getElementById('alcanzada13').value;
		var ponderacion1 = document.getElementById('ponderacion13');	
		var myResult = (myBox1 * myBox2)/100;
		 ponderacion1.value = myResult;
	}  
   
     function calculatet1() {
		var myBox1 = document.getElementById('ponderacion1').value;	
    var myBox2 = document.getElementById('ponderacion2').value;	
    var myBox3 = document.getElementById('ponderacion3').value;	
    var myBox4 = document.getElementById('ponderacion4').value;	
    var myBox5 = document.getElementById('ponderacion5').value;	
		var ponderacion1 = document.getElementById('total1');	
		var myResult = parseInt(myBox1) + parseInt(myBox2) + parseInt(myBox3) + parseInt(myBox4) + parseInt(myBox5) ;
		 ponderacion1.value = myResult;
	}  
   
        function calculatet2() {
		var myBox1 = document.getElementById('ponderacion6').value;	
    var myBox2 = document.getElementById('ponderacion7').value;	
    var myBox3 = document.getElementById('ponderacion8').value;	
    var myBox4 = document.getElementById('ponderacion9').value;	
    var myBox5 = document.getElementById('ponderacion10').value;	
		var ponderacion1 = document.getElementById('total2');	
		var myResult = parseInt(myBox1) + parseInt(myBox2) + parseInt(myBox3) + parseInt(myBox4) + parseInt(myBox5) ;
		 ponderacion1.value = myResult;
	}  
   
        function calculatet3() {
		var myBox1 = document.getElementById('ponderacion11').value;	
    var myBox2 = document.getElementById('ponderacion12').value;	
    var myBox3 = document.getElementById('ponderacion13').value;	
		var ponderacion1 = document.getElementById('total3');	
		var myResult = parseInt(myBox1) + parseInt(myBox2) + parseInt(myBox3) ;
		 ponderacion1.value = myResult;
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