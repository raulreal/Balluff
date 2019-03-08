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
          
          
          <!--Table-->
              <table id="tablePreview" class="table">
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
                    <th scope="row"></th>
                    
                    <td><strong>Total</strong></td>
                    <td>
                      
                      
                      <h3>
                        {{ ($registros->lider + $registros->habilidades + $registros->responsabilidades + $registros->conocimiento + $registros->equipo + $registros->retos + $registros->integrado) / .28}} %
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
                          <h1>
                            Si
                         </h1>
                      @else
                         <h1>
                            No
                         </h1>
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
          
          <div class="table-responsive">
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
     </div>
</div>

 <div class="firmas">
                
            @if ($registros->f_empleado)
                <div class="alert alert-success" role="alert">
                  Firmado por {{ $registros->user->name  }} {{ $registros->user->appellido  }} el {{ $registros->fechafirma_e}}
                </div> 
             @else
                  @if ($registros->user->id === $usr->id)
                        <a href="{{ route('ingreso.firma',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                            <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación Empleado</span>
                        </a>
                  @endif
              @endif
                
              @if ($registros->f_jefe)
                <div class="alert alert-success" role="alert">
                  Firmado por {{ $registros->user->miJefe->name }} {{ $registros->user->miJefe->apellido }} el {{ $registros->fechafirma_j}}
                </div> 
             @else
                   @if ($registros->user->miJefe)
                      @if ($registros->user->miJefe->id === $usr->id)
                            <a href="{{ route('ingreso.firma1',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                                <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación Jefe</span>
                            </a>
                      @endif
                  @endif
              @endif
                
              @if ($registros->f_rh)
                <div class="alert alert-success" role="alert">
                  Firmado por Recursos Humanos el {{ $registros->fechafirma_rh}}
                </div> 
             @else           
                   @if ($permisoRh)

                            <a href="{{ route('ingreso.firma2',['user_id' => $registros->id ] ) }}" title="Firmar" class="btn btn-primary firma">
                                <i class="voyager-pen"></i> <span class="hidden-xs hidden-sm"> Firmar evaluación RH</span>
                            </a>
                  @endif
              @endif


                <div><hr/></div>
              </div>
                 
              
@endsection
         
@section('javascript')
  
         
              
@endsection     