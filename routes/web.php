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

Route::get('/', function () {
	return view('/auth/login');
});


//

Auth::routes();

//graficas
Route::get('/graficas','rdbtChartController@index');
Route::post('/graficas','rdbtChartController@store');



Route::get('/home', 'HomeController@index')->name('home');

//incidencia
Route::get('/AsCliente','asignacionController@indexCliente',function(){
	
})->middleware('client');

Route::get('/AsSoporte','asignacionController@indexSoporte',function(){

})->middleware('support');


Route::get('/Asignacion','asignacionController@index');
Route::post('/Asignacion','asignacionController@store');
use App\rdbtAsignacion;
use App\rdbtCorrectivo;
use App\rdbtEquipoMarca;
Route::get('/ver/{id}/incidencia',function($id){

	$user=auth()->user();
	$inc=rdbtAsignacion::findOrFail($id);

	$informe=rdbtCorrectivo::where('rdbt_asignacion_id',$inc->id)->get();

	if($user->id==$inc->client_id || $user->id==$inc->support_id ){
		$incident=rdbtAsignacion::findOrFail($id);//mensajes chat
		$messages=$incident->messages;
		return view('incidencia.show')->with(compact('incident','messages','informe'));
	}
	return redirect("/home");
	
});

Route::get('/incidencia/{id}/result',function($id){
	
	$incident=rdbtAsignacion::findOrFail($id);

	$incident->active = 0 ;

	$incident->save();

	return back();
})->middleware('support')->name('asignacion.solve.view');


Route::get('/prevencion/{id}/result',function($id){
	
	$incident=rdbtEquipoMarca::findOrFail($id);

	$incident->active = 0 ;

	$incident->save();

	return back();
})->middleware('support')->name('preventivo.solve.view');

Route::get('/incidencia/{id}/abrir','asignacionController@open');


//Route::get('/incidencia/{id}/derivar','asignacionController@next');

//preventivo


Route::get('/preventivo/cliente','prevencionController@index');

Route::get('/ver/{id}','prevencionController@show',function(){
	
})->middleware('client');

Route::get('/preventivo/soporte','prevencionController@indexSoporte',function(){

})->middleware('support');

Route::get('/ver/{id}/view','prevencionController@showSoporte',function(){
	
})->middleware('support');

Route::post('/preventivo/informe','prevencionController@create',function(){

})->middleware('support');

Route::post('/correctivo/informe','correctivoController@create',function(){

})->middleware('support');
//administrador

Route::get('/preventivo','prevencionController@indexAdmin',function(){
	
})->middleware('admin');

Route::get('/ver/{id}/Admin','prevencionController@showAdmin',function(){
	
})->middleware('admin');
//mensajes

Route::post('/mensajes','MessageController@store');

Route::get('/reporte/{id}/client','AsignacionController@report')->name('clientes.report.view');

Route::get('/reporte/{id}/prevencion','prevencionController@report')->name('prevencion.report.view');
Route::get('/reporte/{id}/prevencionCliente','prevencionController@reportCliente')->name('prevencion.reportCliente.view');
//administrador
Route::group(['middleware'=>'admin','namespace'=>'Admin'],function(){

//preventivo
Route::get('/reporte','AsignacionAdminController@report');


//Asignacion
	Route::get('/AsAdministrador','AsignacionAdminController@indexAdministrador');
	Route::post('/AsAdministrador/{id}/asignar','AsignacionAdminController@take');
	Route::get('/ver/{id}/incident','AsignacionAdminController@show');
	Route::get('/incidencia/{id}/editar','AsignacionAdminController@edit');
	Route::post('/incidencia/{id}/editar','AsignacionAdminController@update');

	//usuarios
	Route::get('/usuarios','userController@index');
	Route::post('/usuarios','userController@store');
	Route::get('/usuarios/{id}','userController@edit')->name('usuarios.edit.view');
	Route::post('/usuarios/{id}','userController@update');
	Route::get('/usuarios/{id}/eliminar','userController@delete')->name('usuarios.delete.view');
	//equipos
	Route::get('/equipos','equipoController@index');
	Route::post('/equipos','equipoController@store');
	Route::put('/equipos/{equipo}/editar','equipoController@update')->name('equipos.update.view');
	Route::get('/equipos/{id}/eliminar','equipoController@delete')->name('equipos.delete.view');
	Route::get('/equipos/{id}/restaurar','equipoController@restore')->name('equipos.restore.view');
	
	Route::get('/marcas','marcaController@index');
	Route::post('/marcas','marcaController@store');
	Route::put('/marcas/{marca}/editar','marcaController@update')->name('marcas.update.view');
	Route::get('/marcas/{id}/eliminar','marcaController@delete')->name('marcas.delete.view');
	Route::get('/marcas/{id}/restaurar','marcaController@restore')->name('marcas.restore.view');
	//modelo
	Route::get('/modelos','modeloController@index');
	Route::post('/modelos','modeloController@store');
	Route::put('/modelos/{modelo}/editar','modeloController@update')->name('modelos.update.view');
	Route::get('/modelos/{id}/eliminar','modeloController@delete')->name('modelos.delete.view');
	Route::get('/modelos/{id}/restaurar','modeloController@restore')->name('modelos.restore.view');
	//serie
	Route::get('/series','serieController@index');
	Route::post('/series','serieController@store');
	Route::put('/series/{serie}/editar','serieController@update')->name('series.update.view');
	Route::get('/series/{id}/eliminar','serieController@delete')->name('series.delete.view');
	Route::get('/series/{id}/restaurar','serieController@restore')->name('series.restore.view');

	Route::get('/asignar','asignarController@index');

	//equipo-marca
	Route::get('/Equipo-marca','EquipoMarcaController@index');
	Route::post('/Equipo-marca','EquipoMarcaController@store');
	Route::put('/Equipo-marca/{id}/editar','EquipoMarcaController@update')->name('Equipomarca.update.view');
	Route::get('/Equipo-marca/{id}/eliminar','EquipoMarcaController@delete')->name('Equipo-marca.delete.view');
	Route::get('/Equipo-marca/{id}/restaurar','EquipoMarcaController@restore')->name('Equipo-marca.restore.view');

	//asignar soporte a mantenimiento preventivo
	Route::put('/preventivo/{id}/atender','EquipoMarcaController@take')->name('preventivo.take.view');

	//marca

	//asignacion

});



