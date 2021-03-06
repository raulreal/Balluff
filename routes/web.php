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
  
        Route::get('/salas_refugio', function () {
              return view('refugio0');
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

        Route::get('reporte', 'AsistenciaController@reporte')->name('asistencia.reportes');
        Route::get('reportes/{id}', 'AsistenciaController@reportes')->name('asistencia.reportess');
  
         Route::get('asistencia', 'AsistenciaController@index')->name('asistencia.index');
         Route::post('asistencia', 'AsistenciaController@addEvent')->name('asistencia.add');
         Route::post('asistencia/cerrar', 'AsistenciaController@cerrar')->name('asistencia.cerrar');
         Route::post('asistencia/receso', 'AsistenciaController@receso')->name('asistencia.receso');
         Route::post('asistencia/recesocls', 'AsistenciaController@recesocls')->name('asistencia.recesocls');
 
 // Evaluacion de Desempeño
          
        Route::resource('evaluaciones', 'DesenpenoController');
        Route::get('evaluacion', 'DesenpenoController@indexjfe')->name('evaluacion.indexjfe');
  
        Route::get('efirma/{id}', 'DesenpenoController@show2')->name('evaluacion.show2');
        Route::get('objetivos/{id}', 'DesenpenoController@editob')->name('evaluacion.editob');
  
        Route::get('evaluacion/firmar', 'DesenpenoController@firma')->name('evaluacion.firma');
        Route::get('evaluacion/firmar1', 'DesenpenoController@firma1')->name('evaluacion.firma1');
        Route::get('evaluacion/firmar2', 'DesenpenoController@firma2')->name('evaluacion.firma2');
        Route::get('mi-evaluacion', 'DesenpenoController@mievaluacion')->name('desenpeno.mievaluacion');
  
   // Evaluacion de Nuevo ingreso
          
        Route::resource('ingreso', 'IngresoController');
        Route::get('firmar', 'IngresoController@firma')->name('ingreso.firma');
        Route::get('firmar1', 'IngresoController@firma1')->name('ingreso.firma1');
        Route::get('firmar2', 'IngresoController@firma2')->name('ingreso.firma2');
        Route::get('mi-ingreso', 'IngresoController@mievaluacion')->name('ingreso.mievaluacion');
  
  
     // Evaluacion de Nuevo ingreso
          
        Route::resource('revision', 'RevisionController');
          Route::get('revision_firmar', 'RevisionController@firma')->name('revision.firma');
        Route::get('revision_firmar1', 'RevisionController@firma1')->name('revision.firma1');
        Route::get('revision_firmar2', 'RevisionController@firma2')->name('revision.firma2');
      
  

     // Hoja viajera
          
        Route::resource('viajera', 'ViajeraController');
        Route::get('viajera_firmar', 'ViajeraController@firma')->name('viajera.firma');
        Route::get('viajera_firmar1', 'ViajeraController@firma1')->name('viajera.firma1');
        Route::get('viajera_firmar2', 'ViajeraController@firma2')->name('viajera.firma2');
        Route::get('mi-viajera', 'ViajeraController@mievaluacion')->name('viajera.mievaluacion');
  
     // Formato de requsicion
          
        Route::resource('requisicion', 'RequisicionController');
        Route::get('firmarr', 'RequisicionController@firma')->name('requisicion.firma');
        Route::get('firmarr1', 'RequisicionController@firma1')->name('requisicion.firma1');
        Route::get('firmarr2', 'RequisicionoController@firma2')->name('requisicion.firma2');
        Route::get('mi-requisicion', 'RequisicionController@mievaluacion')->name('requisicion.mievaluacion');
  
  
  
       // Contratos
          
        Route::resource('contratos', 'ContratoController');
        Route::get('firmarc', 'ContratoController@firma')->name('contrato.firma');
        Route::get('firmarc1', 'ContratoController@firma1')->name('contrato.firma1');
        Route::get('firmarc2', 'ContratoController@firma2')->name('contrato.firma2');
        Route::get('mis-contratos', 'ContratoController@mievaluacion')->name('contrato.mievaluacion');

  //tmp
        Route::get('graficas', 'GraficaController@index')->name('grafica.index');
  
  //Facturas
        Route::resource('facturas', 'FacturaController');
  
  //Vacaciones
        Route::resource('vacaciones', 'VacacionesController');
        Route::get('vacaciones-usuarios', 'VacacionesController@index2')->name('vacaciones.index2');
        Route::get('vacaciones-firmar', 'VacacionesController@firma')->name('vacaciones.firma');
        Route::get('vacaciones-firmar1', 'VacacionesController@firma1')->name('vacaciones.firma1');
        Route::get('vacaciones-firmar2', 'VacacionesController@firma2')->name('vacaciones.firma2');
        Route::get('mis-vacaciones', 'VacacionesController@misVacaciones')->name('vacaciones.misvacaciones');
  
  //Opciones
        Route::get('opciones-generales', 'OpcionController@edit')->name('opciones.edit');
        Route::put('opciones-generales', 'OpcionController@update')->name('opciones.update');
        Route::patch('opciones-generales', 'OpcionController@update')->name('opciones.update');
        
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
