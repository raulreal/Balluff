@extends('voyager::master')

@section('page_header')

  <br/>

  <h1 class="page-title">
      <i class="voyager-book-download"></i>
      Agregar Contrato
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
                        DATOS DEL PERSONALES
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
              {!! Form::open(array('route' => 'contratos.store','files'=>true)) !!}
              
							{{ csrf_field() }}
              
              <input type="hidden" id="user_id" name="user_id" value="{{$usuario->id }}">
              

    <div class="panel panel-default">
      <div class="panel-heading">Crear Contrato</div>  
      
        <div class="table-responsive tabla1">
          <table class="table">
             <thead>
                <th style="width: 50%"></th>
                <th style="width: 50%"></th>
            </thead>
               <tbody>
               <td class="titulo_tb" colspan="2">Generales del contrato</td>
                 <tr>
                   <td><select class="form-control form-control-sm input-sm select" name="status" id="status">
                     <option  selected disabled>Estatus del contrato (Firma)</option>
                        <option value="Firmado">Firmado</option>
                        <option value="Por firmar">Por Firmar</option>
                      </select>
                  </td>
                   
                  <td><input type="text" name="firmante" id="firmante" class="form-control input-sm objetivos conditional" data-cond-option="status" data-cond-value="Firmado" placeholder="Firmado por:"></td>  
                   

                   
                   
                 </tr>
                 

                 
                 <tr>
                 <td><input type="text" name="f1name" id="nombre" class="form-control input-sm objetivos" placeholder="Nombre del Contrato"></td>  
                 <td><select  class="form-control form-control-sm input-sm" name="categoria" id="categoria">
                     <option  selected disabled>Area / Departamento</option>
                      <option>Gerencia</option>
                      <option>Ventas</option>
                      <option>Finanzas</option>
                      <option>Marketing</option>
                      <option>Recursos Humanos</option>
                      <option>Servicio Técnico</option>
                      <option>Servicio al Cliente</option>
                   <option>Planeación de Materiales</option>

                      </select>
                  </td>
                 
                 </tr>
                <td class="titulo_tb" colspan="2">Vigencia del Contrato</td>

                <tr>
                 </td>
                    <td>{!! Form::text('f_firma', null, ['class' => 'datepicker form-control input-sm', 'placeholder'=>'Fecha de Inicio' ,'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                    <td>{!! Form::text('duracion', null, ['class' => 'datepicker form-control input-sm', 'placeholder'=>'Fecha de Finalizacion' ,'onkeydown'=>'return false', 'autocomplete'=>'off']) !!}</td>
                 </tr>
              </tr>

            </tbody>
          </table>

          <table class="table">
             <thead>
                <th style="width: 30%"></th>
                <th style="width: 30%"></th>
                <th style="width: 40%"></th>
            </thead>
               <tbody>
                   <td class="titulo_tb" colspan="3">Archivos</td>
                 <tr>
                   <td rowspan="3" class="filetit" > <h5>Archivo Principal</h5> </td>
                   <td rowspan="3" class="fullup">{!! Form::file('file1', null,['class'=>'form-control fullup']) !!}</td>
                   <td><input type="text" id="f1name" class="form-control input-sm objetivos" placeholder="Nombre" readonly></td>
                 </tr>
                 
                  <tr>
                     <td><input type="text" name="f1desc" id="f1desc" class="form-control input-sm objetivos" placeholder="Breve Descripcion" ></td>
                 </tr>
                 
                  <tr>
                    <td><select class="form-control form-control-sm input-sm" name="f1p" id="f1p">
                     <option  selected disabled>Publico o Privado</option>
                        <option value="1">Publico</option>
                        <option value="0">Privado</option>
                      </select>
                  </td>
                 </tr>
                 </table>
                  <div class="col-sm-12 aanex">
                          <div class="col-sm-6">¿El contrato cuenta con archivos anexos?</div>
                           <div class="col-sm-6">
                                   <label><input type="radio" name="anexo" value="yes"><span></span> Si</label>
                                     <label><input type="radio" name="anexo" value="no"><span></span> No</label>
                            </div>
                  </div>

                   <table class="table conditional" data-cond-option="anexo" data-cond-value="yes">
                               <thead>
                                  <th style="width: 30%"></th>
                                  <th style="width: 30%"></th>
                                  <th style="width: 40%"></th>
                              </thead>
                                 <tbody>
                                     <td class="titulo_tb" colspan="3">Archivos anexos</td>
                                   <tr>
                   <td rowspan="3" class="filetit2" > <h5>Archivo Adicional 01</h5></td>
                   <td rowspan="3" class="fullup">{!! Form::file('file2', null,['class'=>'form-control fullup']) !!}</td>
                   <td><input type="text" name="f2name" id="f2name" class="form-control input-sm objetivos" placeholder="Nombre del Archivo" ></td>
                 </tr>
                  <tr>
                     <td><input type="text" name="f2desc" id="f2desc" class="form-control input-sm objetivos" placeholder="Breve Descripcion" ></td>
                 </tr>
                  <tr>
                    <td><select class="form-control form-control-sm input-sm" name="f2p" id="f2p">
                     <option  selected disabled>Publico o Privado</option>
                        <option value="1">Publico</option>
                        <option value="0">Privado</option>
                      </select>
                  </td>
                 </tr>
                  <td class="separador" colspan="3"></td>
                  <tr>
                    <td rowspan="3" class="filetit2" > <h5>Archivo Adicional 02</h5></td>
                   <td rowspan="3" class="fullup">{!! Form::file('file3', null,['class'=>'form-control fullup']) !!}</td>
                   <td><input type="text" name="f3name" id="f3name" class="form-control input-sm objetivos" placeholder="Nombre del Archivo" ></td>
                 </tr>
                 
                  <tr>
                     <td><input type="text" name="f3desc" id="f3desc" class="form-control input-sm objetivos" placeholder="Breve Descripcion" ></td>
                 </tr>
                 
                  <tr>
                    <td><select class="form-control form-control-sm input-sm" name="f3p" id="f3p">
                     <option  selected disabled>Publico o Privado</option>
                        <option value="1">Publico</option>
                        <option value="0">Privado</option>
                      </select>
                  </td>
                 </tr>
                  <td class="separador" colspan="3"></td>
                  <tr>
                    <td rowspan="3" class="filetit2" > <h5>Archivo Adicional 03</h5></td>
                   <td rowspan="3" class="fullup">{!! Form::file('file4', null,['class'=>'form-control fullup']) !!}</td>
                   <td><input type="text" name="f4name" id="f4name" class="form-control input-sm objetivos" placeholder="Nombre del Archivo" ></td>
                 </tr>
                 
                  <tr>
                     <td><input type="text" name="f4desc" id="f4desc" class="form-control input-sm objetivos" placeholder="Breve Descripcion" ></td>
                 </tr>
                 
                  <tr>
                    <td><select class="form-control form-control-sm input-sm" name="f3p" id="f4p">
                     <option  selected disabled>Publico o Privado</option>
                        <option value="1">Publico</option>
                        <option value="0">Privado</option>
                      </select>
                  </td>
                 </tr>
                                                     <td class="separador" colspan="3"></td>
                 <tr>
                   <td rowspan="3" class="filetit2" > <h5>Archivo Adicional 04</h5></td>
                   <td rowspan="3" class="fullup">{!! Form::file('file5', null,['class'=>'form-control fullup']) !!}</td>
                   <td><input type="text" name="f5name" id="f5name" class="form-control input-sm objetivos" placeholder="Nombre del Archivo" ></td>
                 </tr>
                 
                  <tr>
                     <td><input type="text" name="f5desc" id="f5desc" class="form-control input-sm objetivos" placeholder="Breve Descripcion" ></td>
                 </tr>
                 
                  <tr>
                    <td><select class="form-control form-control-sm input-sm" name="f5p" id="f5p">
                     <option  selected disabled>Publico o Privado</option>
                        <option value="1">Publico</option>
                        <option value="0">Privado</option>
                      </select>
                  </td>
                 </tr>
            </tbody>
          </table>

               <div class="col-xs-12 col-sm-12 col-md-12 botoneslrg">
                        <div class="col-sm-6"><input type="submit"  value="Guardar" class="btn btn-success btn-block"></div>
                        <div class="col-sm-6"><a href="{{ route('ingreso.index') }}" class="btn btn-info btn-block" >Atrás</a></div>
                        <div class="col-sm-2"></div>
                </div>	

    <div class="row">
        <div class="col-sm-12"></div>
    </div>
          </div>
        </div>

       </div>
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
                min:false,
            })
         });
      }); 
    </script>

 <script>
      $("#f1name").keyup(function() {
             var maxPriceDummy = $(this).val();
             $("#nombre").val(maxPriceDummy);    
          });

          $("#nombre").keyup(function() {
             var maxPrice = $(this).val();
             $("#f1name").val(maxPrice);    
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

  <script> 

(function($) {
  $.fn.conditionize = function(options){ 
    
     var settings = $.extend({
        hideJS: true
    }, options );
    
    $.fn.showOrHide = function(listenTo, listenFor, $section) {
      if ($(listenTo).is('select, input[type=text]') && $(listenTo).val() == listenFor ) {
        $section.slideDown();
      }
      else if ($(listenTo + ":checked").val() == listenFor) {
        $section.slideDown();
      }
      else {
        $section.slideUp();
      }
    } 

    return this.each( function() {
      var listenTo = "[name=" + $(this).data('cond-option') + "]";
      var listenFor = $(this).data('cond-value');
      var $section = $(this);
  
      //Set up event listener
      $(listenTo).on('change', function() {
        $.fn.showOrHide(listenTo, listenFor, $section);
      });
      //If setting was chosen, hide everything first...
      if (settings.hideJS) {
        $(this).hide();
      }
      //Show based on current value on page load
      $.fn.showOrHide(listenTo, listenFor, $section);
    });
  }
}(jQuery));
  
 $('.conditional').conditionize();
             </script>    
@endsection     