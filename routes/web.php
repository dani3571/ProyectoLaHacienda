<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentasController;
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

    //mascotas
    Route::resource('mascotas', 'MascotasController')
    ->except('show')
    ->names('mascotas');

     Route::get('/mascotas/{id}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');
     Route::put('/mascotas/{mascota}/cambiar-estado', [MascotasController::class, 'cambiarEstado'])->name('mascotas.cambiar-estado');
     Route::put('/mascotas/{mascota}/restablecer-estado', [MascotasController::class, 'restablecerEstado'])->name('mascotas.restablecer-estado');

     Route::delete('/mascotas/{mascota}/destroy', [MascotasController::class, 'destroy'])->name('mascotas.destroy');
     Route::get('/pdf', 'MascotasController@getPDF')->name('getPDF');

     Route::get('/mascotas/inactivos', [MascotasController::class, 'inactivos'])->name('mascotas.inactivos');
     
     
    //reservas_peluqueria
    Route::resource('reservas_peluqueria', 'Reservacion_peluqueriaController')
    ->except('show')
    ->names('reservas_peluqueria');

     /*Route::get('/reservas_peluqueria/{id}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');
     Route::put('/reservas_peluqueria/{mascota}/cambiar-estado', [MascotasController::class, 'cambiarEstado'])->name('mascotas.cambiar-estado');
     Route::put('/reservas_peluqueria/{mascota}/restablecer-estado', [MascotasController::class, 'restablecerEstado'])->name('mascotas.restablecer-estado');

     Route::delete('/mascotas/{mascota}/destroy', [MascotasController::class, 'destroy'])->name('mascotas.destroy');
     

     Route::get('/mascotas/inactivos', [MascotasController::class, 'inactivos'])->name('mascotas.inactivos');*/

    //Ventas
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.ventas');
    Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/buscarCliente/{nit}', [VentasController::class, 'buscarCliente'])->name('ventas.buscarCliente');
    Route::get('/ventas/show/{id}', [VentasController::class, 'show'])->name('ventas.show');
    Route::resource('ventas','VentasController')
    ->except('show')
    ->names('ventas');
});
    //Perfiles
    Route::resource('profiles', ProfileController::class)
    ->only('edit', 'update')
    ->names('profiles');
 