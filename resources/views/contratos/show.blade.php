@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-book-download"></i>
      Adminsitración de Contratos
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
                        DATOS DEL CONTRATO
                        </h3></center></div>
                      <div class="col-sm-2"><strong>Nombre del Contrato:</strong><br/>        {{$registros->f1name}}    </div>
                      <div class="col-sm-2"><strong>Descripcion:</strong><br/>  
                        @if($registros->f1desc)
                          <td> {{ $registros->f1desc }}</td>
                        @else
                          <td> Sin descripcion </td>
                        @endif
                      </div>
                      <div class="col-sm-2"><strong>Estatus:</strong><br/>         {{$registros->status}}</div>
                      <div class="col-sm-2"><strong>Vigente desde: </strong><br/> 
                        @if($registros->f_firma)
                            {{$registros->f_firma}}
                        @else
                            Contrato por Firmar
                        @endif
                        {{ $registros->f_solicitud}}
                      </div>
                      <div class="col-sm-2"><strong><span class="{{ $registros->diff }}">.</span>Vigente hasta: </strong><br/>        
                        @if($registros->duracion)
                            {{ Carbon\Carbon::parse($registros->duracion)->format('d-m-Y') }}
                        @endif
                      </div>
                   </div>
               </div>
          </div>
        </div>
     

    <div class="panel panel-default">
      <div class="panel-heading">Descargar Contrato </div>  
        <div class="table-responsive tabla1">
               <table class="table">
             <thead>
                <th style="width: 30%"></th>
                <th style="width: 30%"></th>
                <th style="width: 40%"></th>
            </thead>
               <tbody>
                   <td class="titulo_tb" colspan="3">Archivos</td>
                 <tr>
                   <td rowspan="3" class="filetit" > <h5>Archivo Principal</h5> <br/> </td>
                   
                   <td rowspan="3" class="fullup"> 
                     
                     <a href="../storage/contratos/{{$registros->file1}}" target="_blank" title="Descargar Archivo" class="btn btn-sm btn-primary edit">
                            <i class="voyager-download"></i> <span class="hidden-xs hidden-sm">Descargar Archivo</span> </a>
                   
                   </td>
                   <td><input type="text" name="f1name" id="f1name" class="form-control input-sm objetivos" value="{{$registros->f1name}}" readonly></td>
                 </tr>
                 
                  <tr>
                     <td><input type="text" name="f1desc" id="f1desc" class="form-control input-sm objetivos" value="{{$registros->f1desc}}" readonly></td>
                 </tr>
                 
                  <tr>
                   @if($registros->f1p === '1')
                    <td class="estado{{$registros->f1p}}">
                         Archivo Publico
                    </td>
                    @else
                    <td class="estado{{$registros->f1p}}">
                         Archivo Privado
                    </td>
                    @endif
                 </tr>
                 
                 @if($registros->anexo== 'yes')
                 
                 
                 
                 <tr><td class="titulo_tb" colspan="3">Archivos Adicionales</td></tr>
                 
                 @if($registros->file2)
                 
                <tr>
                  <td rowspan="3" class="filetit2" > <h5>Archivo Adicional</h5> <br/> </td>
                   
                   <td rowspan="3" class="fullup"> 
                     
                   @if($permisoGr || $registros->f2p === '1')
                     <a href="../storage/contratos/{{$registros->file2}}" target="_blank" title="Descargar Archivo" class="btn btn-sm btn-primary edit">
                            <i class="voyager-download"></i> <span class="hidden-xs hidden-sm">Descargar Archivo</span> </a>
                     @else
                      Sin Permiso
                     @endif
                     
                   </td>
                   <td><input type="text" name="f2name" id="f2name" class="form-control input-sm objetivos" value="{{$registros->f2name}}" readonly></td>
                 </tr>
                  <tr>
                     <td><input type="text" name="f2desc" id="f2desc" class="form-control input-sm objetivos" value="{{$registros->f2desc}}" readonly></td>
                 </tr>
                  <tr>
                   @if($registros->f2p === '1')
                    <td class="estado{{$registros->f2p}}">
                         Archivo Publico
                    </td>
                    @else
                    <td class="estado{{$registros->f2p}}">
                         Archivo Privado
                    </td>
                    @endif
                 </tr>
                 @endif
                 
                                  @if($registros->file3)
                                   <td class="separador" colspan="3"></td>
                <tr>
                   <td rowspan="3" class="filetit2" > <h5>Archivo Adicional</h5> <br/> </td>
                   
                   <td rowspan="3" class="fullup"> 
                     
                                       @if($permisoGr || $registros->f3p === '1')
                     <a href="../storage/contratos/{{$registros->file3}}" target="_blank" title="Descargar Archivo" class="btn btn-sm btn-primary edit">
                            <i class="voyager-download"></i> <span class="hidden-xs hidden-sm">Descargar Archivo</span> </a>
                     @else
                      Sin Permiso
                     @endif
                   </td>
                   <td><input type="text" name="f3name" id="f3name" class="form-control input-sm objetivos" value="{{$registros->f3name}}" readonly></td>
                 </tr>
                  <tr>
                     <td><input type="text" name="f3desc" id="f3desc" class="form-control input-sm objetivos" value="{{$registros->f3desc}}" readonly></td>
                 </tr>
                  <tr>
                   @if($registros->f3p === '1')
                    <td class="estado{{$registros->f3p}}">
                         Archivo Publico
                    </td>
                    @else
                    <td class="estado{{$registros->f3p}}">
                         Archivo Privado
                    </td>
                    @endif
                 </tr>
                 @endif
                 
                                  @if($registros->file4)
                                   <td class="separador" colspan="3"></td>
                <tr>
                  <td rowspan="3" class="filetit2" > <h5>Archivo Adicional </h5><br/> </td>
                   
                   <td rowspan="3" class="fullup"> 
                     
                                       @if($permisoGr || $registros->f4p === '1')
                     <a href="../storage/contratos/{{$registros->file4}}" target="_blank" title="Descargar Archivo" class="btn btn-sm btn-primary edit">
                            <i class="voyager-download"></i> <span class="hidden-xs hidden-sm">Descargar Archivo</span> </a>
                     @else
                      Sin Permiso
                     @endif
                   </td>
                   <td><input type="text" name="f4name" id="f4name" class="form-control input-sm objetivos" value="{{$registros->f4name}}" readonly></td>
                 </tr>
                  <tr>
                     <td><input type="text" name="f4desc" id="f4desc" class="form-control input-sm objetivos" value="{{$registros->f4desc}}" readonly></td>
                 </tr>
                  <tr>
                   @if($registros->f4p === '1')
                    <td class="estado{{$registros->f4p}}">
                         Archivo Publico
                    </td>
                    @else
                    <td class="estado{{$registros->f4p}}">
                         Archivo Privado
                    </td>
                    @endif
                 </tr>
                 @endif
                 
                @if($registros->file5)
                                   <td class="separador" colspan="3"></td>
                <tr>
                  <td rowspan="3" class="filetit2" > <h5>Archivo Adicional</h5> <br/> </td>
                   
                   <td rowspan="3" class="fullup"> 

                     @if($permisoGr || $registros->f5p === '1')
                     <a href="../storage/contratos/{{$registros->file5}}" target="_blank" title="Descargar Archivo" class="btn btn-sm btn-primary edit">
                            <i class="voyager-download"></i> <span class="hidden-xs hidden-sm">Descargar Archivo</span> </a>
                     @else
                      Sin Permiso
                     @endif
                     
                     
                   </td>
                   <td><input type="text" name="f5name" id="f5name" class="form-control input-sm objetivos" value="{{$registros->f5name}}" readonly></td>
                 </tr>
                  <tr>
                     <td><input type="text" name="f5desc" id="f5desc" class="form-control input-sm objetivos" value="{{$registros->f5desc}}" readonly></td>
                 </tr>
                  <tr>
                   @if($registros->f5p === '1')
                    <td class="estado{{$registros->f5p}}">
                         Archivo Publico
                    </td>
                    @else
                    <td class="estado{{$registros->f5p}}">
                         Archivo Privado
                    </td>
                    @endif
                 </tr>
                 @endif
                 
                 
                 
                 
                 
       </tbody>
     </table>
          
          @else
          
                           
       </tbody>
     </table>
     
     @endif
          
     
         <div class="panel panel-bordered">
      <div class="panel-body">
        <div class="table-responsive">
               <div class="panel panel-primary">
                    <div class="row datososc">
                      <div class="col-sm-12"><center><h3>
                        Solicitado por:
                        </h3></center></div>
                          <div class="row">
                              <div class="col-sm-3"></div>
                              <div class="col-sm-6">
                                <div class="solicitante">                       
                                 <h5> {{$usr->name}} {{$usr->apellido}}  </h5>
                                 <h6> {{ $fecha }} </h6>   
                                </div>
                            </div>
                              <div class="col-sm-3"></div>
                          </div>

                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 botoneslrg">
                <a href="{{ route('contratos.index') }}" class="btn btn-info btn-block" >Atrás</a>
                 

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