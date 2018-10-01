@extends('voyager::master')

@section('page_header')
  <br/>
  <div class="container-fluid">
      <div class="alerts">
      </div>
      <div class="alert alert-info">
          <strong>Aviso:</strong> {{setting('noticias.flash')}}
      </div>
  </div>

  <h1 class="page-title">
      <i class="voyager-calendar"></i>
      Noticias
  </h1>
@stop

@section('content')

    <div class="row">
      


        <div class="col-sm-6">
          <div class="col-md-12 canv">
    @if($principal)
            <a href="/post/{{ $principal->slug }}">
              <img src="{{ Voyager::image( $principal->image ) }}" style="width:100%">
            </a>
            <div class ="destacada">Destacada</div>

            <div class ="canv_des">
            <a href="/post/{{ $principal->slug }}">
              <h1> {{ $principal->title }} </h1>
            </a>
            <span>{{ $principal->excerpt}}</span>
                          </div>
          </div>
     @else
          
          <div class ="canv_des">
                            <h1>
                  Sin publicaciones destacadas
            </h1>
            
          @endif
      </div>
      
        <div class="col-sm-3 canv2">
          
          
          
          @if($posts)
          		@foreach($posts as $post)
              <div class="col-md-12 secu">
                <a href="/post/{{ $post->slug }}">
                  <img src="{{ Voyager::image( $post->image ) }}" style="width:100%">
                  <h2>{{ $post->title }}</h2>
                 {{ mb_strimwidth( $post->excerpt, 0, 70, '...') }}
   
                </a>
              </div>
            @endforeach
          {{ $posts->links() }}
          @else
          <div class="col-md-12 secu">
                <h1>
                  Sin publicaciones nuevas
            </h1>
              </div>
          @endif
      </div>
      
        <div class="col-sm-3">
          <div class="col-md-12 bann">          
            <img src="{{ Voyager::image(setting('noticias.ban_home') ) }}" style="width:100%">
          </div>
        <div class="col-md-12 linteres">
        <div class="cabecera">
          <i class="voyager-forward"></i> <h1>Ligas de Interés </h1>
          </div>
              {{menu('Enlaces de interes')}}
                </a>
          </div>
          
      </div>
    </div>

@endsection