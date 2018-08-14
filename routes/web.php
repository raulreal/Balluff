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

Route::get('/archivos', function () {
    return view('archivos');
});

Route::get('/extensiones', function () {
    return view('extensiones');
});


Route::get('/b', function () {
    return view('repositorio');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/', function () {
    return redirect('admin');
});