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

Route::apiResource('mascotas', 'App\Http\Controllers\API\MascotaController');

Route::apiResource('products', 'App\Http\Controllers\API\ProductosController');

Route::post('login', 'App\Http\Controllers\API\UserController@login');

Route::apiResource('habitaciones', 'App\Http\Controllers\API\HabitacionesController');

Route::apiResource('reservashotel', 'App\Http\Controllers\API\ReservasHoteleriaController');

Route::apiResource('reservaspeluqueria', 'App\Http\Controllers\API\ReservasHoteleriaController');

Route::apiResource('reservasveterinaria', 'App\Http\Controllers\API\ReservasVeterinariaController');
