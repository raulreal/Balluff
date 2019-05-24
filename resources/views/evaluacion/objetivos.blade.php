@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
      Evaluación de Desempeño
  </h1>
      <div class="float-right camino">
                <img src="{{ asset('storage/settings/camino.png') }}" height="70px">
        </div>
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
            
            
             <div class="panel panel-bordered">
               
                <div class="col-xs-12 col-sm-12 col-md-12 form-inline">
                  
                  <form method="GET" action="{{ route('evaluaciones.show', $registros->id) }}" class="form-inline" >
                      {{ csrf_field() }}
                      <input type="email" name="email_evalucion" class="form-control input-sm objetivos peso_monto1" required placeholder="ejemplo@balluff.com" style="width:200px; height: 30px !important;" >
                      <input type="hidden" name="enviar_pdf" value="1" >
                      
                      <input type="submit"  value="Enviar" class="btn btn-sm btn-primary edit" style="margin-left:-2px;">
                    
                    <a href="{{route('evaluaciones.show', [$id, 'descargar_pdf'=>1])}}" title="Imprimir" class="btn btn-sm btn-primary edit" target="_blanck" style="margin-left:20px;">
                         <span>Imprimir reporte</span>
                    </a>
                  </form>
               </div>	
               
               
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
                      <div class="col-sm-2"><strong>Departamento o área: </strong><br/>
                        @if($registros->user->departamento)
                            {{ $registros->user->departamento->nombre }}
                        @endif
                      </div>
                      <div class="col-sm-2"><strong>Fecha de ingreso: </strong><br/> {{ $registros->user->fecha_ingreso }}</div>
                  </div>
                        
        <div class="panel-body">					
					<div class="table-container">
						<form method="POST" action="{{ route('evaluaciones.update',$registros->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
              <div class="panel-heading">Objetivos CSP ó Individuales <span><strong>{{$registros->peso_oindividuales}} %</strong></span></div>               
            <div class="table-responsive">
              <table class="table">
              <div class="table-responsive">
             <thead>
               <th style="width: 20%">Objetivos</th>
                <th style="width: 10%">Meta</th>
                <th style="width: 10%">Unidad de Medida</th>
                <th style="width: 10%">Fecha de ejecución</th>
                <th style="width: 5%">Peso</th>
                <th style="width: 20%">Comentarios adicionales</th>
             </thead>
             <tbody>
                <tr>
                  <td><textarea type="text" name="objetivo1" id="objetivo1" class="form-control input-sm objetivos" >{{$registros->objetivo1}}</textarea></td>
                  <td><input type="text" name="meta1" id="meta1" class="form-control input-sm objetivos" value="{{$registros->meta1}}" ></td>
                  <td><input type="text" name="medida1" id="medida1" class="form-control input-sm objetivos" value="{{$registros->medida1}}" ></td>
                  <td><input type="text" name="fecha1" id="fecha1" class="form-control input-sm objetivos" value="{{$registros->fecha1}}" ></td>
                  <td><input type="text" name="peso1" id="peso1" class="form-control input-sm objetivos" value="{{$registros->peso1}}" ></td>
                  <td><textarea type="text" name="comentarios1" id="comentarios1" class="form-control input-sm objetivos" >{{$registros->comentarios1}}</textarea></td>
               </tr>
               <tr>
                  <td><textarea type="text" name="objetivo2" id="objetivo2" class="form-control input-sm objetivos" >{{$registros->objetivo2}}</textarea></td>
                  <td><input type="text" name="meta2" id="meta2" class="form-control input-sm objetivos" value="{{$registros->meta2}}" ></td>
                  <td><input type="text" name="medida2" id="medida2" class="form-control input-sm objetivos" value="{{$registros->medida2}}" ></td>
                  <td><input type="text" name="fecha2" id="fecha2" class="form-control input-sm objetivos" value="{{$registros->fecha2}}" ></td>
                  <td><input type="text" name="peso2" id="peso2" class="form-control input-sm objetivos" value="{{$registros->peso2}}" ></td>
                  <td><textarea type="text" name="comentarios2" id="comentarios2" class="form-control input-sm objetivos" >{{$registros->comentarios2}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo3" id="objetivo3" class="form-control input-sm objetivos" >{{$registros->objetivo3}}</textarea></td>
                  <td><input type="text" name="meta3" id="meta3" class="form-control input-sm objetivos" value="{{$registros->meta3}}" ></td>
                  <td><input type="text" name="medida3" id="medida3" class="form-control input-sm objetivos" value="{{$registros->medida3}}" ></td>
                  <td><input type="text" name="fecha3" id="fecha3" class="form-control input-sm objetivos" value="{{$registros->fecha3}}" ></td>
                  <td><input type="text" name="peso3" id="peso3" class="form-control input-sm objetivos" value="{{$registros->peso3}}" ></td>
                  <td><textarea type="text" name="comentarios3" id="comentarios3" class="form-control input-sm objetivos" >{{$registros->comentarios3}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo4" id="objetivo4" class="form-control input-sm objetivos" >{{$registros->objetivo4}}</textarea></td>
                  <td><input type="text" name="meta4" id="meta4" class="form-control input-sm objetivos" value="{{$registros->meta4}}" ></td>
                  <td><input type="text" name="medida4" id="medida4" class="form-control input-sm objetivos" value="{{$registros->medida4}}" ></td>
                  <td><input type="text" name="fecha4" id="fecha4" class="form-control input-sm objetivos" value="{{$registros->fecha4}}" ></td>

                  <td><input type="text" name="peso1" id="peso4" class="form-control input-sm objetivos" value="{{$registros->peso4}}" ></td> 
                  <td><textarea type="text" name="comentarios1" id="comentarios4" class="form-control input-sm objetivos" >{{$registros->comentarios4}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo5" id="objetivo5" class="form-control input-sm objetivos" >{{$registros->objetivo5}}</textarea></td>
                  <td><input type="text" name="meta5" id="meta5" class="form-control input-sm objetivos" value="{{$registros->meta5}}" ></td>
                  <td><input type="text" name="medida5" id="medida5" class="form-control input-sm objetivos" value="{{$registros->medida5}}" ></td>
                  <td><input type="text" name="fecha5" id="fecha5" class="form-control input-sm objetivos" value="{{$registros->fecha5}}" ></td>
                  <td><input type="text" name="peso5" id="peso5" class="form-control input-sm objetivos" value="{{$registros->peso5}}" ></td> 
                  <td><textarea type="text" name="comentarios5" id="comentarios5" class="form-control input-sm objetivos" >{{$registros->comentarios5}}</textarea></td>
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
                <th style="width: 5%">Peso</th>
                <th style="width: 20%">Comentarios adicionales</th>
             </thead>
             <tbody>
                <tr>
                  <td><textarea type="text" name="objetivo6" id="objetivo6" class="form-control input-sm objetivos" >{{$registros->objetivo6}}</textarea></td>
                  <td><input type="text" name="meta6" id="meta6" class="form-control input-sm objetivos" value="{{$registros->meta6}}" ></td>
                  <td><input type="text" name="medida6" id="medida6" class="form-control input-sm objetivos" value="{{$registros->medida6}}" ></td>
                  <td><input type="text" name="fecha6" id="fecha6" class="form-control input-sm objetivos" value="{{$registros->fecha6}}" ></td>
                  <td><input type="text" name="peso6" id="peso6" class="form-control input-sm objetivos" value="{{$registros->peso6}}" ></td> 
                  <td><textarea type="text" name="comentarios6" id="comentarios6" class="form-control input-sm objetivos" >{{$registros->comentarios6}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo7" id="objetivo7" class="form-control input-sm objetivos" >{{$registros->objetivo7}}</textarea></td>
                  <td><input type="text" name="meta7" id="meta7" class="form-control input-sm objetivos" value="{{$registros->meta7}}" ></td>
                  <td><input type="text" name="medida7" id="medida7" class="form-control input-sm objetivos" value="{{$registros->medida7}}" ></td>
                  <td><input type="text" name="fecha7" id="fecha7" class="form-control input-sm objetivos" value="{{$registros->fecha7}}" ></td>
                  <td><input type="text" name="peso2" id="peso7" class="form-control input-sm objetivos" value="{{$registros->peso7}}" ></td>
                  <td><textarea type="text" name="comentarios7" id="comentarios7" class="form-control input-sm objetivos" >{{$registros->comentarios7}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo8" id="objetivo8" class="form-control input-sm objetivos" >{{$registros->objetivo8}}</textarea></td>
                  <td><input type="text" name="meta8" id="meta8" class="form-control input-sm objetivos" value="{{$registros->meta8}}" ></td>
                  <td><input type="text" name="medida8" id="medida8" class="form-control input-sm objetivos" value="{{$registros->medida8}}" ></td>
                  <td><input type="text" name="fecha8" id="fecha8" class="form-control input-sm objetivos" value="{{$registros->fecha8}}" ></td>
                  <td><input type="text" name="peso3" id="peso8" class="form-control input-sm objetivos" value="{{$registros->peso8}}" ></td>
                  <td><textarea type="text" name="comentarios8" id="comentarios8" class="form-control input-sm objetivos" >{{$registros->comentarios8}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo9" id="objetivo9" class="form-control input-sm objetivos" >{{$registros->objetivo9}}</textarea></td>
                  <td><input type="text" name="meta9" id="meta9" class="form-control input-sm objetivos" value="{{$registros->meta9}}" ></td>
                  <td><input type="text" name="medida9" id="medida9" class="form-control input-sm objetivos" value="{{$registros->medida9}}" ></td>
                  <td><input type="text" name="fecha9" id="fecha9" class="form-control input-sm objetivos" value="{{$registros->fecha9}}" ></td>
                  <td><input type="text" name="peso1" id="peso9" class="form-control input-sm objetivos" value="{{$registros->peso9}}" ></td>
                  <td><textarea type="text" name="comentarios9" id="comentarios9" class="form-control input-sm objetivos" >{{$registros->comentarios9}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo10" id="objetivo10" class="form-control input-sm objetivos" >{{$registros->objetivo10}}</textarea></td>
                  <td><input type="text" name="meta10" id="meta10" class="form-control input-sm objetivos" value="{{$registros->meta10}}" ></td>
                  <td><input type="text" name="medida10" id="medida10" class="form-control input-sm objetivos" value="{{$registros->medida10}}" ></td>
                  <td><input type="text" name="fecha10" id="fecha10" class="form-control input-sm objetivos" value="{{$registros->fecha10}}" ></td>
                  <td><input type="text" name="peso10" id="peso10" class="form-control input-sm objetivos" value="{{$registros->peso10}}" ></td>
                  <td><textarea type="text" name="comentarios10" id="comentarios10" class="form-control input-sm objetivos" >{{$registros->comentarios10}}</textarea></td>
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
                <th style="width: 5%">Peso</th>
               <th style="width: 10%">Ponderación</th>
                <th style="width: 20%">Comentarios adicionales</th>
             </thead>
             <tbody>
                <tr>
                  <td><textarea type="text" name="objetivo11" id="objetivo11" class="form-control input-sm objetivos" >{{$registros->objetivo11}}</textarea></td>
                  <td><input type="text" name="meta11" id="meta11" class="form-control input-sm objetivos" value="{{$registros->meta11}}" ></td>
                  <td><input type="text" name="medida11" id="medida11" class="form-control input-sm objetivos" value="{{$registros->medida11}}" ></td>
                  <td><input type="text" name="fecha11" id="fecha11" class="form-control input-sm objetivos" value="{{$registros->fecha11}}" ></td>
                  <td><input type="text" name="peso11" id="peso11" class="form-control input-sm objetivos" value="{{$registros->peso11}}" ></td>
                  <td><input type="text" class="form-control input-sm objetivos" value="{{ $registros->ponderacion11 }}" ></td>
                  <td><textarea type="text" name="comentarios11" id="comentarios11" class="form-control input-sm objetivos" >{{$registros->comentarios11}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo12" id="objetivo12" class="form-control input-sm objetivos" >{{$registros->objetivo12}}</textarea></td>
                  <td><input type="text" name="meta12" id="meta10" class="form-control input-sm objetivos" value="{{$registros->meta12}}" ></td>
                  <td><input type="text" name="medida12" id="medida10" class="form-control input-sm objetivos" value="{{$registros->medida12}}" ></td>
                  <td><input type="text" name="fecha12" id="fecha12" class="form-control input-sm objetivos" value="{{$registros->fecha12}}" ></td>
                  <td><input type="text" name="peso12" id="peso12" class="form-control input-sm objetivos" value="{{$registros->peso12}}" ></td>
                  <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion12  }}" ></td>
                  <td><textarea type="text" name="comentarios12" id="comentarios12" class="form-control input-sm objetivos" >{{$registros->comentarios12}}</textarea></td>
               </tr>
               
               <tr>
                  <td><textarea type="text" name="objetivo13" id="objetivo13" class="form-control input-sm objetivos" >{{$registros->objetivo13}}</textarea></td>
                  <td><input type="text" name="meta13" id="meta13" class="form-control input-sm objetivos" value="{{$registros->meta13}}" ></td>
                  <td><input type="text" name="medida13" id="medida13" class="form-control input-sm objetivos" value="{{$registros->medida13}}" ></td>
                  <td><input type="text" name="fecha13" id="fecha13" class="form-control input-sm objetivos" value="{{$registros->fecha13}}" ></td>
                  <td><input type="text" name="peso13" id="peso10" class="form-control input-sm objetivos" value="{{$registros->peso13}}" ></td>
                  <td><input type="text" class="form-control input-sm objetivos" value="{{  $registros->ponderacion13 }}" ></td>
                  <td><textarea type="text" name="comentarios13" id="comentarios13" class="form-control input-sm objetivos" >{{$registros->comentarios13}}</textarea></td>
               </tr>
            </tbody>
                </div>
          </table>
              
                <div class="col-xs-12 col-sm-12 col-md-12 botoneslrg">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ url()->previous() }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	
              
            </form>
          </div>

 <script type="text/javascript">
  
  /* Sumar dos números. */
function sumar() {
  var total = 0;
  $(".monto").each(function() {
    if (isNaN(parseFloat($(this).val()))) {
      total += 0;
    } else {
      total += parseFloat($(this).val());
    }
  });
  //alert(total);
  document.getElementById('spTotal1').value = total;
}
  function sumar2() {
  var total = 0;
  $(".monto2").each(function() {
    if (isNaN(parseFloat($(this).val()))) {
      total += 0;
    } else {
      total += parseFloat($(this).val());
    }
  });
  //alert(total);
  document.getElementById('spTotal2').value = total;
}
  
    function sumar3() {
  var total = 0;
  $(".monto3").each(function() {
    if (isNaN(parseFloat($(this).val()))) {
      total += 0;
    } else {
      total += parseFloat($(this).val());
    }
  });
  //alert(total);
  document.getElementById('spTotal3').value = total;
}
   
 function sumar4() {
  var total = 0;
   
  var ponderacion1 = parseFloat(document.getElementById('ponderacion1').value)||0
  var ponderacion2 = parseFloat(document.getElementById('ponderacion2').value)||0
  var ponderacion3 = parseFloat(document.getElementById('ponderacion3').value)||0
   
  total = ponderacion1 + ponderacion2 + ponderacion3
 
  document.getElementById('peso_total').value = total;
}
</script>          
@endsection

@section('javascript')
            
     <script type="text/javascript">

        $('.timepicker').each(function () {
          $('.timepicker').each(function () {
            console.log(this);
            $(this).pickadate({
              format: 'yyyy-mm-dd',
              formatSubmit: 'yyyy-mm-dd 00:00:00',
              hiddenSuffix: '',
              min:true,
            })
         });
      });
        
       function truncateDate(date) {
          return new Date(date.getFullYear(), date.getMonth(), date.getDate());
       }
  
       
    </script>
              
            
            
            
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
   <script>
    $(document).ready(function () {
    $('#form').validate({ // initialize the plugin
        rules: {
          objetivo1: {
                required: true
                     },
          objetivo2: {
                required: true
                     },
           objetivo3: {
                required: true
                     },
          peso1: {
                digits: true,
                range: [0, 100]
                     },
          peso2: {
                digits: true,
                range: [0, 100]
                     },
          peso3: {
                digits: true,
                range: [0, 100]
                     },
          peso4: {
                digits: true,
                range: [0, 100]
                     },
          peso5: {
                digits: true,
                range: [0, 100]
                     },
          peso6: {
                digits: true,
                range: [0, 100]
                     },
          peso7: {
                digits: true,
                range: [0, 100]
                     },
          peso8: {
                digits: true,
                range: [0, 100]
                     },
          peso9: {
                digits: true,
                range: [0, 100]
                     },
          peso10: {
                digits: true,
                range: [0, 100]
                     },
          peso11: {
                digits: true,
                range: [0, 100]
                     },
          peso12: {
                digits: true,
                range: [0, 100]
                     },
          peso13: {
                digits: true,
                range: [0, 100]
                     },
          peso_oindividuales:{
                required: true,
                digits: true,
                range: [0, 100]
          },
                    peso_oadmon:{
                required: true,
                digits: true,
                range: [0, 100]
          },
                    peso_ocultura:{
                required: true,
                digits: true,
                range: [0, 100]
          },
          peso_total:{
                required: true,
                digits: true,
                range: [100, 100]
          },
                    total1:{
                required: true,
                digits: true,
                range: [100, 100]
          },
                    total2:{
                required: true,
                digits: true,
                range: [100, 100]
          },
                    total3:{
                required: true,
                digits: true,
                range: [100, 100]
          },
        },
                   messages: {
                  total1: "La suma de cada % deberá dar un total de 100%",
                     total2: "La suma de cada % deberá dar un total de 100%",
                     total3: "La suma de cada % deberá dar un total de 100%",
                     peso_total: "La suma de cada % deberá dar un total de 100%",
                  peso1: "El valor debe ser menor a 100 ",
                     peso2: " El valor debe ser menor a 100 ",
                     peso3: " El valor debe ser menor a 100 ",
                     peso5: " El valor debe ser menor a 100 ",
                     peso6: " El valor debe ser menor a 100 ",
                     peso7: " El valor debe ser menor a 100 ",
                     peso8: " El valor debe ser menor a 100 ",
                     peso9: " El valor debe ser menor a 100 ",
                     peso10: " El valor debe ser menor a 100 ",
                     peso11: " El valor debe ser menor a 100 ",
                     peso12: " El valor debe ser menor a 100 ",
                     peso_oindividuales: "El valor debe ser menor a 100 ",
                     peso_oadmon: "El valor debe ser menor a 100 ",
                     peso_ocultura: "El valor debe ser menor a 100 ",
                     objetivo1: " Al menos debes registrar 3 objetivos ",
                     objetivo2: " Al menos debes registrar 3 objetivos ",
                     objetivo3: " Al menos debes registrar 3 objetivos ",
                }
        });
    });
  </script> 
                        
@endsection   