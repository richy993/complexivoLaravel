<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/marca/{id}/modelos','Admin\modeloController@byMarca');
Route::get('/marca/{id}/modelos1','Admin\modeloController@byMarca1');
Route::get('/modelo/{id}/series','Admin\serieController@byModelo');
