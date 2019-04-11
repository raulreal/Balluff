@extends('voyager::master')

@section('page_header')
  <br/>

  <h1 class="page-title">
      <i class="voyager-alarm-clock"></i>
      Reportes de asistencia y puntualidad
  </h1>
@stop

@section('content')


@section('content')

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                
                {{ Form::model(Request::all(), array('route' => 'asistencia.reportes','method'=>'GET', 'class'=>'form-search' )) }}    
                    
                    <div id="search-input" style="margin-bottom: 5px;">
                        
                        <input type="hidden" name="exportar_pdf" value="1">
                        
                        <div class="input-group col-md-6">
                            {{ Form::select('mes', 
                                ['01' => 'Enero',
                                 '02' => 'Febrero',
                                 '03' => 'Marzo',
                                 '04' => 'Abril',
                                 '05' => 'Mayo',
                                 '06' => 'Junio',
                                 '07' => 'Julio',
                                 '08' => 'Agosto',
                                 '09' => 'Septiembre',
                                 '10' => 'Octubre',
                                 '11' => 'Noviembre',
                                 '12' => 'Diciembre'], 
                                null,
                               ['placeholder' => 'Seleccionar Mes',
                            'class' => 'form-control', 'required'])}}
                        </div>
                        
                        <span class="input-group-btn" style="width: auto; background-color: #f5f5f5; font-weight: bold; height: 34px; border: 1px solid #cccccc;">
                            <button class="btn btn-info btn-lg" name="general" value="1" type="submit" style="margin: 0 !important; right: 2px;font-size: 15px; border-right: 1px solid #eee; height: 32px;">
                                <i class="voyager-cloud-download" style="display:inline-block; transform: none; position: relative; top: 4px;"></i> <span>Descargar reporte general</span>
                            </button>
                        </span>
                        
                      <span class="input-group-btn" style="width: auto; background-color: #f5f5f5; font-weight: bold; height: 34px; border: 1px solid #cccccc; margin-left:5px;">
                            <button class="btn btn-info btn-lg" name="detalle" value="2" type="submit" style="margin: 0 !important; right: 2px;font-size: 15px; border-right: 1px solid #eee; height: 32px;">
                                <i class="voyager-cloud-download" style="display:inline-block; transform: none; position: relative; top: 4px;"></i> <span>Descargar reporte detalle</span>
                            </button>
                        </span>
                      
                    </div>
                    
                {!! Form::close() !!}
                
                
                <div class="panel panel-primary">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="pull-left"><h3>Registro puntualidad y asistencia</h3></div>
                            <div class="table-container">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                        <th>Colaborador</th>
                                        <th>Departamento o área</th>
                                        <th>Puesto</th>
                                        <th>Fecha de ingreso</th>
                                        <th>Ver Reporte</th>
                                    </thead>
                                    <tbody>
                                        @if($registros->count())  
                                            @foreach($registros as $registro)  
                                            <tr>
                                                <td>{{ $registro->name }} {{ $registro->apellido }}</td>
                                                <td>
                                                @if( $registro->departamento)
                                                    {{ $registro->departamento->nombre }}
                                                @endif
                                                </td>
                                                <td>{{ $registro->puesto }}</td>
                                                <td>{{ $registro->fecha_ingreso }}</td>
                                                <td>
                                                    <a href=reportes/{{ $registro->id }} title="Ver" class="btn btn-sm btn-warning view">
                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                    </a>
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
            </div>
        </div>
    </div>
</div>


@endsection