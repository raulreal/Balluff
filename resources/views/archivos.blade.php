@extends('voyager::master')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-images"></i> Medios | Calidad
        </h1>
  </div>
@stop




@section('content')

<div class="col-md-12">
  <div class="panel panel-bordered">
    <div class="panel-body cont_arch">
        <div class="table-responsive">
          <iframe src="/laravel-filemanager/repo" style="width: 100%; height: 800px; overflow: hidden; border: none;"></iframe>
        </div>
    </div>
  </div>
</div>

@stop

