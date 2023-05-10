<?php

use App\Http\Controllers\AdminController;
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
//PRINCIPAL 
Route::get('/', function () {
    return view('home/index');
});

Route::get('/inicio', function () {
    return view('home/inicio');
});
Route::get('/index', function () {
    return view('home/index');
})->name('index.index');

Route::get('/nosotros', function () {
    return view('home/nosotros');
})->name('nosotros.nosotros');
Route::get('/contactanos', function () {
    return view('home/contactanos');
})->name('contactanos.contactanos');
Route::get('/servicios', function () {
    return view('home/servicios');
})->name('servicios.servicios');

Auth::routes();

Route::get('/products', [ProductosController::class, 'index', 'productos'])
    ->name('products.productos');


//ADMINISTRADOR
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
