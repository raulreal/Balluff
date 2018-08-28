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


Route::group(['middleware' => 'auth'], function () {
  


          Route::get('/calidad', function () {
              return view('archivos');
          });

          Route::get('/marketing', function () {
              return view('archivos2');
          });

          Route::get('/escritorio', function () {
              $posts = App\Post::all();
              return view('escritorio', compact('posts'));
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
              return redirect('/admin');
          });

          Route::get('events', 'EventController@index')->name('events.index');
          Route::post('events', 'EventController@addEvent')->name('events.add');


});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
