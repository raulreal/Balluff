@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-thumbs-up"></i>
      Hoja Viajera
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


<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">
         
         
         
         {{ Form::model(Request::all(), array('route' => 'viajera.index','method'=>'GET', 'class'=>'form-search' )) }}
              <div id="search-input" style="    margin-bottom: 5px;">
                  
                  <div class="input-group col-md-6">
                      {{ Form::select('empleados',['' => 'Todos los usuarios','mios'=>'Mis colaboradores'], null, ['class'=>'form-control', 'style'=>"border: 1px solid #f1f1f1;"])  }}
                  </div>
                
                  <div class="input-group col-md-6">
                      {{ Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Nombre'])}}
                  </div>
                
                  <div class="input-group col-md-6">
                      {{ Form::text('apellido', null, ['class'=>'form-control','placeholder'=>'Apellido', 'style'=>'border-left: solid 1px #eee;'])}}
                  </div>
                  
                  <span class="input-group-btn">
                      <button class="btn btn-info btn-lg" type="submit">
                          <i class="voyager-search"></i>
                      </button>
                  </span>
              </div>

              <div class="row">
                  <div class="col-md-12" style="text-align:right;">

                      @if(count(Request::all()))
                          <a href="{{ route('viajera.index') }}" title="Borrar" class="btn btn-sm btn-danger delete" data-id="20" id="delete-20">
                              <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar filtro</span>
                          </a>
                      @endif
                  </div>
              </div>
          {!! Form::close() !!}

            <div class="panel panel-primary">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="pull-left"><h3>Hojas Viajeras Disponibles  {{$usr->puesto}}</h3></div>
          <div class="pull-right"> 
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Colaborador</th>
                <th>Departamento o área</th>
                <th>Puesto</th>
                <th>Jefe inmediato</th>
                <th>Fecha de Ingreso</th>
                <th>Firma Empleado</th>
                <th>Firma Jefe</th>
                <th>Firma RH</th>
                <th>Revisar Evaluación</th>
             </thead>
             <tbody>
              @if($registros->count())  
              @foreach($registros as $registro)  
              <tr>
                <td>{{ $registro->name }} {{ $registro->apellido }} </td>
                @if($registro->departamento)
                <td>{{ $registro->departamento->nombre }}</td>
                @else
                  <td> Sin departamento </td>
                @endif
                <td>{{ $registro->puesto }}</td>
                @if($registro->miJefe)
                  <td> {{ $registro->miJefe->name }} {{ $registro->miJefe->apellido }}</td>
                @else
                  <td> Sin jefe </td>
                @endif
                <td> {{ $registro->fecha_ingreso }} </td>
                <td>
                    @if($registro->viajera)
                        @if($registro->viajera->f_empleado)
                            <span id="status" class='ing{{$registro->viajera->f_empleado}}'>  Si </span>
                        @else
                            <span id="status" class='ing{{$registro->viajera->f_empleado}}'>  No </span>
                        @endif
                    @else
                             <span id="status" class='ing{{$registro->viajera}}'>  No </span>
                    @endif
                </td>
                <td>
                    @if($registro->viajera)
                        @if($registro->viajera->f_jefe)
                           <span id="status" class='ing{{$registro->viajera->f_jefe}}'>  Si</span>
                        @else
                           <span id="status" class='ing{{$registro->viajera->f_jefe}}'>  No
                        @endif
                    @else
                      <span id="status" class='ing{{$registro->viajera}}'>  No</span>
                    @endif
                </td>
                <td>
                    @if($registro->viajera)
                        @if($registro->viajera->f_rh)
                           <span id="status" class='ing{{$registro->viajera->f_rh}}'>  Si</span>
                        @else
                           <span id="status" class='ing{{$registro->viajera->f_rh}}'>  No</span>
                        @endif
                    @else
                      <span id="status" class='ing{{$registro->rh}}'>  No</span>
                    @endif
                </td>
                <td>
                  @if ( !empty($registro->viajera->id) )
                   <a href="{{action('ViajeraController@show', $registro->viajera->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver/Firmar HV </span>
                   </a>
                  @else
                        @if($registro->id === $usr->id)
                             <a href="{{ route('viajera.create',  ['user_id' => $registro->id ] ) }}" title="Ver" class="btn btn-sm btn-warning view">
                              <i class="voyager-plus"></i> <span class="hidden-xs hidden-sm">Añadir Hoja Viajera</span></a>
                        @else
                                      <div class="alert alert-warning" role="alert">Usuario sin HV</div>
                        @endif
                  @endif
                </td>

               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif
            </tbody>
 
          </table>
        </div>
      </div>
    </div>
  </div>
 {{ $registros->links() }}

@endsection