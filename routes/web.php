<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reservacion_peluqueriaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ReservacionHotelController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\Reservacion_veterinariaController;
use App\Http\Controllers\LogController;
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
    Route::put('/users/{users}/cambiar-estado', [UserController::class, 'cambiarEstado'])->name('users.cambiar-estado');
    Route::put('/users/{users}/restablecer-estado', [UserController::class, 'restablecerEstado'])->name('users.restablecer-estado');
    Route::get('/users/inactivos', [UserController::class, 'inactivos'])->name('users.inactivos');
    Route::get('/users/buscar-usuarios', 'UserController@buscarUsuarios')->name('users.buscar');
    Route::get('/users/{id}/detalleMascotas', 'UserController@detalleMascotas')->name('users.detalleMascotas'); 

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
    Route::post('/reservas_peluqueria/registrarCosto', [Reservacion_peluqueriaController::class, 'registrarCosto'])->name('reservas_peluqueria.registrarCosto');
    Route::get('/reservas_peluqueria/canceladas', [Reservacion_peluqueriaController::class, 'canceladas'])->name('reservas_peluqueria.canceladas');
    Route::get('/reservas_peluqueria/completadas', [Reservacion_peluqueriaController::class, 'completadas'])->name('reservas_peluqueria.completadas');
    Route::get('/reservas_peluqueria/index', [Reservacion_peluqueriaController::class, 'index'])->name('reservas_peluqueria.index');
    Route::get('/reservas_peluqueria/getPDFpeluqueria', 'Reservacion_peluqueriaController@getPDFpeluqueria')->name('getPDFpeluqueria');

    //proveedores
    Route::resource('proveedores', 'ProveedoresController')
    ->except('show','edit')
    ->names('proveedores');

    Route::get('/proveedores/{id}/edit', [ProveedoresController::class, 'edit'])->name('proveedores.edit');
    Route::get('/admin/proveedores/{id}/edit', [ProveedoresController::class, 'edit'])->name('admin.proveedores.edit');


    Route::put('/proveedores/{proveedor}/cambiarestado', [ProveedoresController::class, 'cambiarEstado'])->name('proveedores.cambiarestado');
    Route::put('/proveedores/{proveedor}/restablecer-estado', [ProveedoresController::class, 'restablecerEstado'])->name('proveedores.restablecer-estado');
    Route::get('/proveedores/inactivos', [ProveedoresController::class, 'inactivos'])->name('proveedores.inactivos');
    Route::get('/proveedores/index', [ProveedoresController::class, 'index'])->name('proveedores.index');
    Route::delete('/proveedores/{proveedor}/destroy', [ProveedoresController::class, 'destroy'])->name('proveedores.destroy');
    Route::get('/proveedores/pdf', [ProveedoresController::class, 'generatePDF'])->name('proveedores.pdf');
    
    //Productos
    Route::resource('productos', 'ProductosController')
    ->except('show','edit')
    ->names('productos');
    
    Route::get('/productos/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}/cambiarestado', [ProductosController::class, 'cambiarEstado'])->name('productos.cambiarestado');
    Route::put('/productos/{producto}/restablecer-estado', [ProductosController::class, 'restablecerEstado'])->name('productos.restablecer-estado');
    Route::get('/productos/pdf', [ProveedoresController::class, 'generatePDFRD'])->name('productos.pdf');

    //Route::delete('/productos/{producto}/destroy', [ProductosController::class, 'destroy'])->name('productos.destroy');
    //Route::get('/reporte-productos-pdf', [ProductosController::class, 'generarReporte'])->name('reporte.productos.pdf');

    Route::get('/productos/inactivos', [ProductosController::class, 'inactivos'])->name('productos.inactivos');


    //Categorias
    Route::resource('categorias', 'CategoriasController')
    ->except('show','edit')
    ->names('categorias');

    Route::get('categorias/{id}/edit', [CategoriasController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('categorias/{id}', [CategoriasController::class, 'update'])->name('admin.categorias.update');
    Route::post('/admin/categorias', [CategoriasController::class, 'store'])->name('admin.categorias.store');
    Route::put('/categorias/{categoria}/cambiarestado', [CategoriasController::class, 'cambiarEstado'])->name('categorias.cambiarestado');
    Route::put('/categorias/{categoria}/restablecer-estado', [CategoriasController::class, 'restablecerEstado'])->name('categorias.restablecer-estado');
    Route::get('/categorias/inactivos', [CategoriasController::class, 'inactivos'])->name('categorias.inactivos');
    

    //Ventas
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.ventas');
    Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/buscarCliente/{nit}', [VentasController::class, 'buscarCliente'])->name('ventas.buscarCliente');
    Route::get('/ventas/show/{id}', [VentasController::class, 'show'])->name('ventas.show');
    Route::get('/ventas/getPDFventas', 'VentasController@getPDFventas')->name('getPDFVentas');
    Route::resource('ventas','VentasController')
    ->except('show')
    ->names('ventas');

    //Compras
    Route::get('/compras/index', [ComprasController::class, 'index'])->name('compras.ventas');
    Route::post('/compras', [ComprasController::class, 'store'])->name('compras.store');
    Route::get('/compras/show/{id}', [ComprasController::class, 'show'])->name('compras.show');
    Route::get('/compras/getPDFcompras', 'ComprasController@getPDFcompras')->name('getPDFcompras');
    Route::resource('compras','ComprasController')
    ->except('show')
    ->names('compras');

        //HOTELERÍA
        Route::resource('reservacionHotel','ReservacionHotelController')
        ->except('show')
        ->names('reservacionHotel');
        Route::get('/reservacionHotel/show/{id}', [ReservacionHotelController::class, 'show'])->name('reservacionHotel.show');
        Route::post('/reservacionHotel/insertar-reservacionHotel', 'ReservacionHotelController@SPInsertarReservacionHotel')->name('reservacionHotel.SPInsertarReservacionHotel');
        Route::post('/reservacionHotel/edit-procedimiento', 'ReservacionHotelController@editProcedimiento')->name('reservacionHotel.editProcedimiento');
        Route::get('/reservacionHotel/index', [reservacionHotelController::class, 'index'])->name('reservacionHotel.index');
        Route::get('/reservacionHotel/canceladas', [reservacionHotelController::class, 'canceladas'])->name('reservacionHotel.canceladas');
        Route::get('/reservacionHotel/completadas', [reservacionHotelController::class, 'completadas'])->name('reservacionHotel.completadas');
        Route::get('/reservacionHotel/index', [reservacionHotelController::class, 'index'])->name('reservacionHotel.index');
        //HABITACIONES
        Route::resource('habitacion','HabitacionController')
        ->except('show')
        ->names('habitacion');
        Route::get('/habitacion/show/{id}', [HabitacionController::class, 'show'])->name('habitacion.show');
        //Ruta ajax habitaciones
        Route::put('/habitacion/{id}/asigna-reserva-hotel', 'HabitacionController@asignaReservaHotel')->name('habitacion.asignaReservaHotel');

        //VETERINARIA
        Route::resource('reservas_veterinaria', 'Reservacion_veterinariaController')->except('show')->names('reservas_veterinaria');
        Route::post('/reservas_veterinaria/cancelar', [Reservacion_veterinariaController::class, 'cancelar'])->name('reservas_veterinaria.cancelar');
        Route::get('/reservas_veterinaria/canceladas', [Reservacion_veterinariaController::class, 'canceladas'])->name('reservas_veterinaria.canceladas');
        Route::get('/reservas_veterinaria/completadas', [Reservacion_veterinariaController::class, 'completadas'])->name('reservas_veterinaria.completadas');
        Route::get('/reservas_veterinaria/index', [Reservacion_veterinariaController::class, 'index'])->name('reservas_veterinaria.index');

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

    //Logs
    Route::get('/logs', 'App\Http\Controllers\LogController@show');

    
 