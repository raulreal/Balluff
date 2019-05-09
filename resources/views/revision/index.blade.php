@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-thumbs-up"></i>
      Revisiones de Evaluacion
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
        <div class="panel-heading">
          <div class="pull-left"><h3>Evaluaciones Disponibles  {{$usr->id}}  </h3></div>
          <div class="pull-right"> 
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>id</th>
                <th>Departamento o área</th>
                <th>Puesto</th>
               <th>Puesto</th>
               <th>Puesto</th>
               
             </thead>
             <tbody>
              
              @if($registros->count())  
               @foreach($registros as $registro)  
              <tr>
                <td>{{$registro->id}}</td>
                <td>{{$registro->status1}}</td>
                <td>{{$registro->status2}}</td>
                <td>{{$registro->status3}}</td>

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

@endsection