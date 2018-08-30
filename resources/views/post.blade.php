@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
       <i class="voyager-window-list"></i>
       Escritorio
    </h1>
@stop

@section('content')


			<div class="col-md-8 col-md-offset-2">

				<h1>{{ $post->title }}</h1>
				<img src="{{ Voyager::image( $post->image ) }}" style="width:100%">
				<p>{!! $post->body !!}</p>

			</div>
@endsection