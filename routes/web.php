<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

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
    return view('home/index');
});
Route::get('/inicio', function () {
    return view('home/inicio');
});

Auth::routes();

Route::get('/products', [ProductosController::class, 'index', 'productos'])
    ->name('products.productos');
Route::get('/nosotros', [NosotrosController::class, 'index', 'nosotros'])
    ->name('nosotros.nosotros');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

