<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('users', 'App\Http\Controllers\API\UserController');
Route::post('crearusuario', 'App\Http\Controllers\API\UserController@create');

Route::apiResource('mascotas', 'App\Http\Controllers\API\MascotaController');

Route::apiResource('products', 'App\Http\Controllers\API\ProductosController');

Route::post('login', 'App\Http\Controllers\API\UserController@login');

Route::get('hotelreservas/{id}','App\Http\Controllers\API\ReservasHoteleriaController@index');
Route::get('hotelreservashistorial/{id}','App\Http\Controllers\API\ReservasHoteleriaController@history');
Route::post('hotelreservas','App\Http\Controllers\API\ReservasHoteleriaController@store');


Route::get('veterinariareservas/{id}', 'App\Http\Controllers\API\ReservasVeterinariaController@index');
Route::get('veterinariareservashistorial/{id}', 'App\Http\Controllers\API\ReservasVeterinariaController@history');
Route::post('veterinariareservas', 'App\Http\Controllers\API\ReservasVeterinariaController@store');


Route::get('peluqueriareservas/{id}', 'App\Http\Controllers\API\ReservasPeluqueriaController@index');
Route::get('peluqueriareservashistorial/{id}', 'App\Http\Controllers\API\ReservasPeluqueriaController@history');
Route::post('peluqueriareservas', 'App\Http\Controllers\API\ReservasPeluqueriaController@store');