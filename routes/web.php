<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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

//Usuarios
Route::resource('users', 'UserController')
->except('create', 'store', 'show')
->names('users');

//Ruta perfil


Route::namespace('App\Http\Controllers')->prefix('admin')->group(function(){
   //Usuarios
    Route::resource('users', 'UserController')
    ->except('create', 'store', 'show')
    ->names('users');
    //Roles
    Route::resource('roles','RoleController')
    ->except('show')
    ->names('roles');
    //Perfiles
    Route::resource('profiles', ProfileController::class)
    ->only('edit', 'update')
    ->names('profiles');
    //mascotas
    Route::resource('mascotas', 'MascotasController')
    ->except('show')
    ->names('mascotas');

     Route::get('/mascotas/{id}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');

    //Ventas
     Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.ventas');

    Route::resource('ventas','VentasController')
    ->except('show')
    ->names('ventas');
});
