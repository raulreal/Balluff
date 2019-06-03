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


<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">
         
         
          {{ Form::model(Request::all(), array('route' => 'contratos.index','method'=>'GET', 'class'=>'form-search' )) }}
              <div id="search-input" style="    margin-bottom: 5px;">
                  
                  <div class="input-group col-md-6">
                      {{ Form::select('status',['Firmado' => 'Firmado','Por firmar'=>'Por firmar'], null, ['class'=>'form-control', 'style'=>"border: 1px solid #f1f1f1;", 'placeholder'=>'Selecionar'])  }}
                  </div>
                  
                  <div class="input-group col-md-6">
                      {{ Form::select('categoria',[ 'Gerencia'=>'Gerencia', 'Ventas'=>'Ventas', 'Finanzas'=>'Finanzas', 'Marketing'=>'Marketing', 'Recursos Humanos'=>'Recursos Humanos', 'Servicio Técnico'=>'Servicio Técnico', 'Servicio al Cliente'=>'Servicio al Cliente'], null, ['class'=>'form-control', 'style'=>"border: 1px solid #f1f1f1;", 'placeholder'=>'Selecionar'])  }}
                  </div>
                
                  <div class="input-group col-md-6">
                      {{ Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Nombre'])}}
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
                          <a href="{{ route('contratos.index') }}" title="Borrar" class="btn btn-sm btn-danger delete" data-id="20" id="delete-20">
                              <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar filtro</span>
                          </a>
                      @endif
                  </div>
              </div>
          {!! Form::close() !!}

            <div class="panel panel-primary">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="pull-left"><h3>Contratos Disponibles</h3></div>
          <div class="pull-right"> 
           <a href="{{ URL::to('contratos/create') }}" type="button" class="btn btn-success">Agregar contraro</a>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th width="30%">Nombre del Contrato</th>
               <th width="10%">Estatus</th>
                <th width="10%">Area / Departamento</th>
                <th width="20%">Vigente hasta</th>
                <th width="30%"></th>
             </thead>
             <tbody>
              @if($registros->count())  
              @foreach($registros as $registro)  
              <tr>
                <td>{{ $registro->f1name }}</td>
                <td>{{ $registro->status }}</td>
                <td>{{ $registro->categoria }}</td>
                
                <td>  <span class="{{ $registro->diff }}">.</span> {{ Carbon\Carbon::parse($registro->duracion)->format('d-m-Y') }}</td>
                
                
                <td align="right">       
                  <a href="{{action('ContratoController@show', $registro->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver Contrato</span> </a>
                  <a href="{{action('ContratoController@show', $registro->id)}}" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-paperclip"></i> <span class="hidden-xs hidden-sm">Agregar Actualizacion</span> </a>
                
                </td>

               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">¡No hay registro!</td>
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