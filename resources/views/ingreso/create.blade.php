@extends('voyager::master')

@section('page_header')

  <br/>

  <h1 class="page-title">
      <i class="voyager-thumbs-up"></i>
      Evaluación de nuevo ingreso  
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
                      <div class="col-sm-2"><strong>Fecha: </strong><br/> {{ $fecha->toDateString() }}</div>
                      <div class="col-sm-2"><strong>Departamento o área: </strong><br/>        
                        @if($usuario->departamento)
                            {{$usuario->departamento->nombre}}
                        @endif
                      </div>
                   </div>
               </div>
          </div>
        </div>
     
						<form method="POST" action="{{ route('ingreso.store') }}"  role="form" id="form">
							{{ csrf_field() }}
              
              <input name="user_id" type="hidden" value="{{$usuario->id}}">
              <div class="like">
                <div class="li_head">
                  Instrucciones: A continuación se establecen los criterios a considerar para que un nuevo ingreso permanezca en la organización. Como Jefe Inmediato califica  el nivel de desarrollo en las competencias indicadas.
                </div>
              <label class="statement">1. Como se ha integrado a su equipo de trabajo </label>
                <ul class='likert'>
                  <li>
                    <input type="radio" name="integrado" value="1">
                    <label>Inaceptable</label>
                  </li>
                  <li>
                    <input type="radio" name="integrado" value="2">
                    <label>Insuficiente</label>
                  </li>
                  <li>
                    <input type="radio" name="integrado" value="3">
                    <label>Bien</label>
                  </li>
                  <li>
                    <input type="radio" name="integrado" value="4">
                    <label>Muy bien</label>
                  </li>
                </ul>
              
              <label class="statement">2.	Su actitud ante responsabilidades retos en su trabajo, es… </label>
                <ul class='likert'>
                  <li>
                    <input type="radio" name="retos" value="1">
                    <label>Inaceptable</label>
                  </li>
                  <li>
                    <input type="radio" name="retos" value="2">
                    <label>Insuficiente</label>
                  </li>
                  <li>
                    <input type="radio" name="retos" value="3">
                    <label>Bien</label>
                  </li>
                  <li>
                    <input type="radio" name="retos" value="4">
                    <label>Muy bien</label>
                  </li>
                </ul>
              <label class="statement">3.	Como es su actitud con el equipo de trabajo </label>
                <ul class='likert'>
                  <li>
                    <input type="radio" name="equipo" value="1">
                    <label>Inaceptable</label>
                  </li>
                  <li>
                    <input type="radio" name="equipo" value="2">
                    <label>Insuficiente</label>
                  </li>
                  <li>
                    <input type="radio" name="equipo" value="3">
                    <label>Bien</label>
                  </li>
                  <li>
                    <input type="radio" name="equipo" value="4">
                    <label>Muy bien</label>
                  </li>
                </ul>
              <label class="statement">4.	Su conocimiento técnico del puesto es…</label>
                <ul class='likert'>
                  <li>
                    <input type="radio" name="conocimiento" value="1">
                    <label>Inaceptable</label>
                  </li>
                  <li>
                    <input type="radio" name="conocimiento" value="2">
                    <label>Insuficiente</label>
                  </li>
                  <li>
                    <input type="radio" name="conocimiento" value="3">
                    <label>Bien</label>
                  </li>
                  <li>
                    <input type="radio" name="conocimiento" value="4">
                    <label>Muy bien</label>
                  </li>
                </ul>
              <label class="statement">5. Conoce sus responsabilidades y actividades del puesto, de manera…</label>
                <ul class='likert'>
                  <li>
                    <input type="radio" name="responsabilidades" value="1">
                    <label>Inaceptable</label>
                  </li>
                  <li>
                    <input type="radio" name="responsabilidades" value="2">
                    <label>Insuficiente</label>
                  </li>
                  <li>
                    <input type="radio" name="responsabilidades" value="3">
                    <label>Bien</label>
                  </li>
                  <li>
                    <input type="radio" name="responsabilidades" value="4">
                    <label>Muy bien</label>
                  </li>
                </ul>
              <label class="statement">6. Cuenta con las habilidades para desempeñar el puesto,de manera… </label>
                <ul class='likert'>
                  <li>
                    <input type="radio" name="habilidades" value="1">
                    <label>Inaceptable</label>
                  </li>
                  <li>
                    <input type="radio" name="habilidades" value="2">
                    <label>Insuficiente</label>
                  </li>
                  <li>
                    <input type="radio" name="habilidades" value="3">
                    <label>Bien</label>
                  </li>
                  <li>
                    <input type="radio" name="habilidades" value="4">
                    <label>Muy bien</label>
                  </li>
                </ul>
              
           <label class="statement">7. Como líder te sientes convencido que el nuevo ingreso se desempeñará en el puesto, de manera…</label>
                <ul class='likert'>
                  <li>
                    <input type="radio" name="lider" value="1">
                    <label>Inaceptable</label>
                  </li>
                  <li>
                    <input type="radio" name="lider" value="2">
                    <label>Insuficiente</label>
                  </li>
                  <li>
                    <input type="radio" name="lider" value="3">
                    <label>Bien</label>
                  </li>
                  <li>
                    <input type="radio" name="lider" value="4">
                    <label>Muy bien</label>
                  </li>
                </ul>
              </div>
              
              
              <div class="recomienda">
                  <label class="statement"> ¿ Recomienda a la persona evaluada para permanecer en el puesto?</label>
                      <input type="radio" id="test1" name="recomienda" value="1">
                      <label for="test1">Si</label>

                      <input type="radio" id="test2" name="recomienda" value="0" >
                      <label for="test2">No</label>

              </div>
              
                  <div class="row resumen">
                      <div class="col-sm-12 t_neg"><center>Resumen fortalezas y áreas de mejora</center></div>
                      <div class="col-sm-6 t_gris">Fortalezas<br/>
                        {!! Form::textarea('fortalezas', null, ['id' => 'mejoras', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
                    </div>
                      <div class="col-sm-6 t_gris">Áreas de mejora<br/>
                        {!! Form::textarea('mejoras', null, ['id' => 'mejoras', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
                    </div>
                  </div>
              
              
              <div class="table-responsive">
                <div class="col-sm-12 t_neg"><center>Plan de seguimiento – Áreas de mejora</center></div>
          <table  class="table table-bordered table-hover">
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
              <td><input type="text" name="habilidad1" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="accion1" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="entregable1" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="estatus1" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td>{!! Form::text('fecha1', null, ['class' => 'datepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
            </tr>
            <tr>
              <td><input type="text" name="habilidad2" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="accion2" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="entregable2" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="estatus2" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td>{!! Form::text('fecha2', null, ['class' => 'datepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
            </tr>
            <tr>
              <td><input type="text" name="habilidad3" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="accion3" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="entregable3" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td><input type="text" name="estatus3" id="comentarios1" class="form-control input-sm objetivos" ></td>
              <td>{!! Form::text('fecha3', null, ['class' => 'datepicker form-control input-sm', 'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
            </tr>
            
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5" class="text-center"></td>
            </tr>
          </tfoot>
        </table>
             <div class="col-xs-12 col-sm-12 col-md-12 botoneslrg">
              <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                <a href="{{ route('ingreso.index') }}" class="btn btn-info btn-block" >Atrás</a>
                </div>	
            </form>
              
@endsection
         
@section('javascript')
             

              
    <script type="text/javascript">

        $('.datepicker').each(function () {
          $('.datepicker').each(function () {
            $(this).pickadate({
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd 00:00:00',
                hiddenSuffix: '',
                min:true,
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