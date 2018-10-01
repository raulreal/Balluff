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
          
          //Editar fechas
          Route::get('events/{id}/editar', 'EventController@editar')->name('events.editar');
          Route::post('events/actualizar', 'EventController@actualizar')->name('events.actualizar');
  
          //Eliminar evento
          Route::delete('event/eliminar/{id}', 'EventController@eliminar')->name('events.eliminar');
  
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
