@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-dashboard"></i>
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
</div>

             <div class="panel panel-bordered">
               <div class="panel-body">
                 <div class="table-responsive">
                      <div class="panel panel-primary">
                    <div class="row datososc">
                      <div class="col-sm-12"><center><h3>
                        DATOS PERSONALES
                        </h3></center></div>
                      <div class="col-sm-2"><strong>Nombre del Colaborador:</strong><br/>        {{$usuario->name}}        {{$usuario->apellido}}</div>
                      <div class="col-sm-2"><strong>Nombre del Jefe inmediato:</strong><br/>  
                        @if($usuario->miJefe)
                          <td> {{ $usuario->miJefe->name }} {{ $usuario->miJefe->apellido }}</td>
                        @else
                          <td> Sin jefe </td>
                        @endif
                      </div>
                      <div class="col-sm-2"><strong>Puesto:</strong><br/>         {{$usuario->puesto}}</div>
                      <div class="col-sm-2"><strong>Año: </strong><br/> {{$fecha->year}}</div>
                      <div class="col-sm-2"><strong>Departamento o área: </strong><br/>        
                        @if($usuario->departamento)
                            {{$usuario->departamento->nombre}}
                        @endif
                      </div>
                      <div class="col-sm-2"><strong>Fecha de ingreso: </strong><br/> {{ $usuario->fecha_ingreso }}</div>
                  </div>
						<form method="POST" action="{{ route('evaluaciones.store') }}"  role="form" id="form">
            <form method="post" action="{{url('forms')}}" id="form" >
							{{ csrf_field() }}
              
<div class="col-md-12 objetivos_tab">

    <div class="panel panel-default">
      <div class="panel-heading"><span>Objetivos CSP ó Individuales | Peso:</span> <input type="text" name="peso_oindividuales" id="ponderacion1" class="form-control input-sm objetivos peso_monto1" onkeyup="sumar4();" style="display: inline-block; width: 55px;"><span> %</span>
      <div class="float-right">
                <img src="{{ asset('storage/settings/icono3.png') }}" height="35">
        </div>
      </div>  
      <input type="hidden" name="user_id" id="user_id" value={{ $usuario->id }}   >
                <div class="table-responsive tabla1">
                  <table class="table">
                 <thead>
                   <th style="width: 20%">Objetivos</th>
                    <th style="width: 10%">Meta</th>
                    <th style="width: 10%">Unidad de Medida</th>
                    <th style="width: 10%">Fecha de ejecución</th>
                    <th style="width: 5%">Peso(%)</th>
                    <th style="width: 20%">Comentarios adicionales</th>
                 </thead>
                 <tbody>
                    <tr>
                      <td><textarea name="objetivo1"  id="objetivo1" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta1" id="meta1" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida1" id="medida1" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha1', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha1')]) !!}</td>

                      <td><input type="text" name="peso1" id="peso1" class="form-control input-sm objetivos  monto"  onkeyup="sumar();"  placeholder="%"></td>

                    <td><input type="text" name="comentarios1" id="comentarios1" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  name="objetivo2" id="objetivo2" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta2" id="meta2" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida2" id="medida2" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha2', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha2')]) !!}</td>

                      <td><input type="text" name="peso2" id="peso2" class="form-control input-sm objetivos monto" onkeyup="sumar();" placeholder="%"></td>

                    <td><input type="text" name="comentarios2" id="comentarios2" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  name="objetivo3" id="objetivo3" class="form-control input-sm objetivos"></textarea></td>
                    <td><input type="text" name="meta3" id="meta3" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida3" id="medida3" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha3', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha3')]) !!}</td>

                      <td><input type="text" name="peso3" id="peso3" class="form-control input-sm objetivos monto" onkeyup="sumar();"  placeholder="%"></td>

                    <td><input type="text" name="comentarios3" id="comentarios3" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  name="objetivo4" id="objetivo4" class="form-control input-sm objetivos suma" ></textarea></td>
                    <td><input type="text" name="meta4" id="meta4" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida4" id="medida4" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha4', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha4')]) !!}</td>

                      <td><input type="text" name="peso4" id="peso4" class="form-control input-sm objetivos monto" onkeyup="sumar();" placeholder="%" ></td>

                    <td><input type="text" name="comentarios4" id="comentarios4" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  name="objetivo5" id="objetivo5" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta5" id="meta5" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida5" id="medida5" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha5', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha5')]) !!}</td>

                      <td><input type="text" name="peso5" id="peso5" class="form-control input-sm objetivos monto" onkeyup="sumar();" placeholder="%" ></td>
   
                    <td><input type="text" name="comentarios5" id="comentarios5" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><strong>Total Objetivos individuales: </strong></td>
                   <td><input type="text"  id="spTotal1" value="" name="total1" class="form-control input-sm objetivos" placeholder=" % " readonly ></td>
                   <td></td>
                    </tbody>
                    </div>
                  </table>
      </div>
  <hr />
    <div class="panel panel-default">
    <div class="panel-heading"><span style="display: inline-block">Objetivos Administrativos | Peso:</span> <input type="text" name="peso_oadmon" id="ponderacion2" class="form-control input-sm objetivos peso_monto2" onkeyup="sumar4();" style="display: inline-block; width: 55px;"><span> %</span>            
                     <div class="float-right">
                <img src="{{ asset('storage/settings/icono2.png') }}" height="35">
        </div>
      </div>   
      
      
      <div class="table-responsive tabla1">
                  <table class="table">
                 <thead>
                   <th style="width: 20%">Objetivos</th>
                    <th style="width: 10%">Meta</th>
                    <th style="width: 10%">Unidad de Medida</th>
                    <th style="width: 10%">Fecha de ejecución</th>

                    <th style="width: 5%">Peso(%)</th>
                    <th style="width: 20%">Comentarios adicionales</th>
                 </thead>
                 <tbody>
                    <tr>
                      <td><textarea  name="objetivo6" id="objetivo6" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta6" id="meta6" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida6" id="medida6" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha6', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha6')]) !!}</td>

                      <td><input type="text" name="peso6" id="peso6" class="form-control input-sm objetivos monto2" onkeyup="sumar2();" placeholder="%" ></td>
                    <td><input type="text" name="comentarios6" id="comentarios6" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  name="objetivo7" id="objetivo7" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta7" id="meta7" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida7" id="medida7" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha7', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha7')]) !!}</td>

                      <td><input type="text" name="peso7" id="peso7" class="form-control input-sm objetivos monto2" onkeyup="sumar2();" placeholder="%"></td>

                    <td><input type="text" name="comentarios7" id="comentarios7" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  type="text" name="objetivo8" id="objetivo8" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta8" id="meta8" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida8" id="medida8" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha8', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha8')]) !!}</td>

                      <td><input type="text" name="peso8" id="peso8" class="form-control input-sm objetivos monto2" onkeyup="sumar2();" placeholder="%"></td>

                    <td><input type="text" name="comentarios8" id="comentarios8" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  type="text" name="objetivo9" id="objetivo9" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta9" id="meta9" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida9" id="medida9" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha9', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha9')]) !!}</td>

                      <td><input type="text" name="peso9" id="peso9" class="form-control input-sm objetivos monto2" onkeyup="sumar2();" placeholder="%"></td>

                    <td><input type="text" name="comentarios9" id="comentarios9" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  type="text" name="objetivo10" id="objetivo10" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta10" id="meta10" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida10" id="medida10" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha10', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha10')]) !!}</td>

                      <td><input type="text" name="peso10" id="peso5" class="form-control input-sm objetivos monto2" onkeyup="sumar2();" placeholder="%">
                        
                     </td>

                    <td><input type="text" name="comentarios10" id="comentarios10" class="form-control input-sm objetivos" ></td>
                   </tr>
  <td></td>
                   <td></td>
                   <td></td>
                   <td><strong>Total  Objetivos Total Objetivos Administrativos: </strong></td>
                   <td><input type="text"  id="spTotal2" value="" name="total2" class="form-control input-sm objetivos" placeholder=" % " readonly></td>
                   <td></td>
                    </tbody>
                    </div>

                  </table>
      </div>
<hr />
    <div class="panel panel-default">
    <div class="panel-heading"><span>Objetivos Cultura Organizacional | Peso:</span> <input type="text" name="peso_ocultura" id="ponderacion3" class="form-control input-sm objetivos peso_monto3" style="display: inline-block; width: 55px;" onkeyup="sumar4();"><span> %</span>             
                     <div class="float-right">
                <img src="{{ asset('storage/settings/icono1.png') }}" height="35">
        </div>
      </div>   
      <div class="table-responsive tabla1">
                  <table class="table">
                 <thead>
                   <th style="width: 20%">Objetivos</th>
                    <th style="width: 10%">Meta</th>
                    <th style="width: 10%">Unidad de Medida</th>
                    <th style="width: 10%">Fecha de ejecución</th>

                    <th style="width: 5%">Peso(%)</th>

                    <th style="width: 20%">Comentarios adicionales</th>
                 </thead>
                 <tbody>
                    <tr>
                      <td><textarea  type="text" name="objetivo11" id="objetivo11" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta11" id="meta11" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida11" id="medida11" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha11', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha11')]) !!}</td>

                      <td><input type="text" name="peso11" id="peso11" class="form-control input-sm objetivos  monto3" onkeyup="sumar3();"  placeholder=" % "></td>

                    <td><input type="text" name="comentarios11" id="comentarios11" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  type="text" name="objetivo12" id="objetivo12" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta12" id="meta12" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida12" id="medida12" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha12', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha12')]) !!}</td>

                      <td><input type="text" name="peso12" id="peso12" class="form-control input-sm objetivos  monto3" onkeyup="sumar3();"   placeholder=" % "></td>

                    <td><input type="text" name="comentarios12" id="comentarios12" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <tr>
                     <td><textarea  type="text" name="objetivo13" id="objetivo13" class="form-control input-sm objetivos" ></textarea></td>
                    <td><input type="text" name="meta13" id="meta13" class="form-control input-sm objetivos" ></td>
                    <td><input type="text" name="medida13" id="medida13" class="form-control input-sm objetivos" ></td>
                    <td>{!! Form::text('fecha13', null, ['class' => 'timepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off', 'data-value'=>old('fecha13')]) !!}</td>

                      <td><input type="text" name="peso13" id="peso13" class="form-control input-sm objetivos  monto3" onkeyup="sumar3();"  placeholder=" % "></td>

                    <td><input type="text" name="comentarios13" id="comentarios13" class="form-control input-sm objetivos" ></td>
                   </tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><strong>Total  Objetivos de Cultura Organizacional </strong></td>
                   <td><input type="text"  id="spTotal3" value="" name="total3" class="form-control input-sm objetivos" placeholder=" % " readonly ></td>
                   <td></td>
                    </tbody>
                    </div>
                  </table>
      <table>
        <td><strong style="padding-right:5px;">Total de Objetivos:  </strong></td>
        <td><input type="text"  id="peso_total" value="" name="peso_total" class="form-control input-sm objetivos peso_monto" style="width:50px" readonly ></td>
        <td> %</td>
      </table>
      </div>
         <hr />     
</div>

 <div class="col-xs-12 col-sm-12 col-md-12 botoneslrg">
	<input type="submit"  value="Guardar" class="btn btn-success btn-block">
		<a href="{{ route('evaluacion.indexjfe') }}" class="btn btn-info btn-block" >Atrás</a>
		</div>	
</form>
              
 <script type="text/javascript">

  
  function truncateDate(date) {
    return new Date(date.getFullYear(), date.getMonth(), date.getDate());
  }
  
  
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
            $(this).pickadate({
              format: 'yyyy-mm-dd',
              formatSubmit: 'yyyy-mm-dd 00:00:00',
             hiddenSuffix: ''
            })
         });
      });
        
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
                        