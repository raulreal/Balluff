@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
       <i class="voyager-telephone"></i>
       Extensiones telefónicas
    </h1>
@stop

@section('content')


<div class="col-md-12">
   <div class="panel panel-bordered">
       <div class="panel-body">
                 0011       
      </div>
  </div>
</div>
 
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
