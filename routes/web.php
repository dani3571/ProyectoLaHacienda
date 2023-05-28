<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reservacion_peluqueriaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ReservacionHotelController;
use App\Http\Controllers\HabitacionController;
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
})->name('inicio.inicio');
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
    Route::get('/pdfs', 'UserController@getPDFusuarios')->name('getPD');
    //Roles
    Route::resource('roles','RoleController')
    ->except('show')
    ->names('roles');
    Route::get('/roles/inactivos', [RoleController::class, 'inactivos'])->name('roles.inactivos');
    Route::put('/roles/{role}/cambiar-estado', [RoleController::class, 'cambiarEstado'])->name('roles.cambiar-estado');
    Route::put('/roles/{role}/restablecer-estado', [RoleController::class, 'restablecerEstado'])->name('roles.restablecer-estado');
    Route::get('/pdfss', 'RoleController@getPDFRole')->name('getPDFR');

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
    Route::post('/reservas_peluqueria', [Reservacion_peluqueriaController::class, 'store'])->name('reservas_peluqueria.store');
    Route::get('/reservas_peluqueria/{id}/edit', [Reservacion_peluqueriaController::class, 'edit'])->name('reservas_peluqueria.edit');
    //Route::put('/reservas_peluqueria/{id}/cancelar', [Reservacion_peluqueriaController::class, 'cancelar'])->name('reservas_peluqueria.cancelar');
    Route::post('/reservas_peluqueria/cancelar', [Reservacion_peluqueriaController::class, 'cancelar'])->name('reservas_peluqueria.cancelar');
    Route::get('/reservas_peluqueria/canceladas', [Reservacion_peluqueriaController::class, 'canceladas'])->name('reservas_peluqueria.canceladas');
    Route::get('/reservas_peluqueria/completadas', [Reservacion_peluqueriaController::class, 'completadas'])->name('reservas_peluqueria.completadas');
    Route::get('/reservas_peluqueria/index', [Reservacion_peluqueriaController::class, 'index'])->name('reservas_peluqueria.index');

    //Ventas
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.ventas');
    Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/buscarCliente/{nit}', [VentasController::class, 'buscarCliente'])->name('ventas.buscarCliente');
    Route::get('/ventas/show/{id}', [VentasController::class, 'show'])->name('ventas.show');
    Route::resource('ventas','VentasController')
    ->except('show')
    ->names('ventas');

        //HOTELERÍA
        Route::resource('reservacionHotel','ReservacionHotelController')
        ->except('show')
        ->names('reservacionHotel');
        Route::get('/reservacionHotel/show/{id}', [ReservacionHotelController::class, 'show'])->name('reservacionHotel.show');
        //HABITACIONES
        Route::resource('habitacion','HabitacionController')
        ->except('show')
        ->names('habitacion');
        Route::get('/habitacion/show/{id}', [HabitacionController::class, 'show'])->name('habitacion.show');

    //Reportes
    Route::resource('reportes', 'ReportesController')
    ->except('create', 'store', 'show')
    ->names('reportes');
    Route::post('reportes', 'ReportesController@generarReporte')->name('generar.reporte');

    });

    
    //Perfiles
    Route::resource('profiles', ProfileController::class)
    ->only('edit', 'update')
    ->names('profiles');

    
 