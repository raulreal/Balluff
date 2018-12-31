@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-dashboard"></i>
      Evaluacion de Desempeño
  </h1>
@stop

@section('content')


@section('content')

<div class="col-md-12">
   <div class="panel panel-bordered">
     <div class="panel-body">
       <div class="table-responsive">

            <div class="panel panel-primary">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="pull-left"><h3>Evaluaciones Disponibles</h3></div>
          <div class="pull-right">

            <div class="btn-group">
              <a href="{{ route('desenpeno.create') }}" class="btn btn-info" >Añadir Evaluación</a>
            </div>


            
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Colaborador</th>
                <th>Departamento o área</th>
                <th>Puesto</th>
                 <th>Antiguedad</th>
                <th>Editar</th>
                <th>Eliminar</th>
             </thead>
             <tbody>
              @if($registros->count())  
              @foreach($registros as $registro)  
              <tr>
                <td>Raul Real Rojero</td>
                <td>Tecnología de la información</td>
                <td>Asistente de Gerencía</td>
                <td>2 años 8 meses</td>
                <td><a class="btn btn-primary btn-xs" href="{{action('DesenpenoController@edit', $registro->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{action('DesenpenoController@destroy', $registro->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">
 
                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
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
      {{ $registros->links() }}
    </div>
  </div>


@endsection