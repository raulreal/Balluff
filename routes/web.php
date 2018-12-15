<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


 Route::get('login', function () {
              return view('vendor/voyager/login');
          })->name('login');

// Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::group(['middleware' => 'auth'], function () {
  


          Route::get('/calidad', function () {
              return view('archivos');
          });

          Route::get('/marketing', function () {
              
              return view('archivos2');
          });

  
  Route::get('admin/escritorio', 'PostController@index')->name('home.index');
  
        Route::get('post/{slug}', function($slug){
        $post = App\Post::where('slug', '=', $slug)->firstOrFail();
        return view('post', compact('post'));
      });
  

          Route::get('/test', function () {
              return view('test');
          });

          Route::get('/extensiones', function () {
              return view('extensiones');
          });

 

          Route::get('/b', function () {
              return view('repositorio');
          });

          Route::get('/', function () {
              return redirect('admin/escritorio');
          });
  
          Route::get('/construccion', function () {
              return view('construccion');
          });

          Route::get('events', 'EventController@index')->name('events.index');
          Route::post('events', 'EventController@addEvent')->name('events.add');
  
          Route::get('frida', 'EventController@indexf')->name('frida.index');
          Route::post('frida', 'EventController@addEventf')->name('frida.add');
  
          Route::get('neza', 'EventController@indexn')->name('neza.index');
          Route::post('neza', 'EventController@addEventn')->name('neza.add');
  
          Route::get('paz', 'EventController@indexp')->name('paz.index');
          Route::post('paz', 'EventController@addEventp')->name('paz.add');
  
          Route::get('molina', 'EventController@indexm')->name('molina.index');
          Route::post('molina', 'EventController@addEventm')->name('molina.add');
  
          Route::get('rolf', 'EventController@indexro')->name('rolf.index');
          Route::post('rolf', 'EventController@addEventro')->name('rolf.add');
  
          Route::get('refugio', 'EventController@indexr')->name('refugio.index');
          Route::post('refugio', 'EventController@addEventr')->name('refugio.add');
  
            Route::get('refugio1', 'EventController@indexr1')->name('refugio1.index');
          Route::post('refugio1', 'EventController@addEventr1')->name('refugio1.add');
  
            Route::get('refugio2', 'EventController@indexr2')->name('refugio2.index');
          Route::post('refugio2', 'EventController@addEventr2')->name('refugio2.add');
  
            Route::get('refugio3', 'EventController@indexr3')->name('refugio3.index');
          Route::post('refugio3', 'EventController@addEventr3')->name('refugio3.add');
          
          //Editar fechas
          Route::get('events/{id}/editar', 'EventController@editar')->name('events.editar');
          Route::post('events/actualizar', 'EventController@actualizar')->name('events.actualizar');
  
          //Eliminar evento
          Route::delete('event/eliminar/{id}', 'EventController@eliminar')->name('events.eliminar');
 
         //Asistencia y puntualidad
         Route::get('reportes', function () {
                    return redirect('reportes');
                });
  
  
         Route::get('asistencia', 'AsistenciaController@index')->name('asistencia.index');
         Route::post('asistencia', 'AsistenciaController@addEvent')->name('asistencia.add');
          Route::get('events/{id}/editar', 'AsistenciaController@editar')->name('asistencia.editar');
          Route::post('events/actualizar', 'AsistenciaController@actualizar')->name('asistencia.actualizar');
  
  
        Route::get('graficas', 'GraficaController@index')->name('grafica.index');
  

});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
