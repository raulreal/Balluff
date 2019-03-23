<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/admin/escritorio">
                    <div id my_image class="logo-icon-container">
                      <img id="my_image" src=""/>
                        </div>
                </a>
            </div><!-- .navbar-header -->
          
          <div id="tst">
            
            <img id="my_image" src=""/>

          
          </div>
          
            <div class="panel widget center bgimage"
                 style="background-image:url({{ Voyager::image( Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg') ) }}); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                    <h4>{{ ucwords(Auth::user()->name) }}</h4>
                    <p>{{ Auth::user()->email }}</p>

                    <a href="{{ route('voyager.profile') }}" class="btn btn-primary">{{ __('voyager::generic.profile') }}</a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
      
        {!! menu('admin', 'admin_menu') !!}
        
    </nav>
</div>


<script>
  
  $("document").ready(function(){
    if ($("#balluff").hasClass('expanded') ) {
        console.log("logo grande");
      $("#my_image").attr("src","{{ voyager::image(setting('admin.logo')) }}");
    }   
    else {
        console.log("logo pequeño");
       $("#my_image").attr("src","{{ voyager::image(setting('site.logosm')) }}");

    }      
});

$( "#balluff" ).click(function() {            
    if ($(this).hasClass('expanded') ) {
        console.log("logo grande");
      $("#my_image").attr("src","{{ voyager::image(setting('admin.logo')) }}");
    }   
    else {
        console.log("logo pequeño");
       $("#my_image").attr("src","{{ voyager::image(setting('site.logosm')) }}");
    }      
});
 
  
</script>