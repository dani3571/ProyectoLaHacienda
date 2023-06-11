<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\ReservacionHotel;
use Illuminate\Http\Request;
use App\Http\Requests\ReservacionHotelRequest;
//use Spatie\Permission\Models\ReservacionHotel;
use App\Models\User;
use App\Models\Mascotas;
use App\Models\Habitacion;
use Illuminate\Support\Facades\DB;


class ReservacionHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
       $this->middleware('can:reservacionHotel.index')->only('index');
       $this->middleware('can:reservacionHotel.create')->only('create');
       $this->middleware('can:reservacionHotel.edit')->only('edit');
    }
    public function index()
    {
        $users = User::all();
        $mascotas = Mascotas::all();
        $habitaciones = Habitacion::all();
        $reservacionHotel = ReservacionHotel::simplePaginate(10);

        return view('admin.reservacionHotel.index', compact('reservacionHotel','users','mascotas','habitaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservacionHotel = ReservacionHotel::select(['id', 'estado','mascota_id'])
            ->get();
        
        $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
            ->get();
        
        $users = User::select(['id', 'name','direccion'])
            ->orderBy('name', 'asc')
            ->get();

        $habitacions = Habitacion::where('estado', '=', '1')->get();

        return   view('admin.reservacionHotel.create', compact('reservacionHotel'))
        -> with ('users', $users)
        -> with ('mascotas', $mascotas)
        -> with ('habitacions', $habitacions);
    }

    public function store(ReservacionHotelRequest $request)
    {
       //merge combina los datos que tenemos con los que queremos obtener
       //$request->merge([
        //obtenemos los datos de user como su id con Auth
        //'usuario_id' => Auth::user()->id,
    //]);
    //Guardando la solicitud en una variable
    $reservacionHotel = $request->all();

         ReservacionHotel::create($reservacionHotel);
        return redirect()->action([ReservacionHotelController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservacionHotel  
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservacionHotel = reservacionHotel::findOrFail($id);

        return view('admin.reservacionHotel.show', compact('reservacionHotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservacionHotel  
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          //llamamos al metodo creado en el policy
         // $this->authorize('view', $mascotas);
    /*      $mascotas = Mascotas::select(['id', 'nombre'])
              ->where('estado', 1)
              ->get();
          return view('admin.mascotas.edit', compact('mascotas'));
    */
    
          $reservacionHotel = reservacionHotel::findOrFail($id);
          $users = User::all();
          $mascotas = Mascotas::all();
          $habitacions = Habitacion::all();
          return view('admin.reservacionHotel.edit', compact('reservacionHotel','mascotas','users','habitacions'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservacionHotel  $mascotas
     * @return \Illuminate\Http\Response
     */

     public function update(ReservacionHotelRequest $request, $id)
     {
         /*
              $mascotas->update([
              'nombre' => $request->nombre,
              'tipo' => $request->tipo,
              'raza' => $request->raza,
              'color' => $request->color,
              'fechaNacimiento' => $request->fechaNacimiento,
              'caracter' => $request->caracter,
              'sexo' => $request->sexo,
              'estado' => $request->estado,
              'usuario_id' =>Auth::user()->id,
              
 
         ]);
         return redirect()->action([MascotasController::class, 'index'])
             ->with('success-update', 'Datos de la mascota modificados con exito');
     
     */
     $reservacionHotel = ReservacionHotel::findOrFail($id);
 
     $reservacionHotel->fill($request->all());
 
     $reservacionHotel->save();
 
     return redirect()->route('reservacionHotel.index')
         ->with('success-update', 'Reservación actualizada con éxito');
     }



     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservacionHotel = ReservacionHotel::findOrFail($id);
        $reservacionHotel->delete();
        return redirect()->route('reservacionHotel.index')->with('success-update', 'Reservación eliminada con exito');
        //return redirect()->route('reservacionHotel.inactivos')->with('success-update', 'Reservación eliminada con exito');
    }
    /*
    public function cambiarEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        $mascota->estado = 0;
        $mascota->save();

        return redirect()->route('mascotas.index')->with('success-update', 'Eliminacion logica realizada con exito');
    }

    public function restablecerEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        $mascota->estado = 1;
        $mascota->save();

        return redirect()->route('mascotas.inactivos')->with('success-update', 'Mascota restablecida con éxito');
    }
    */

    public function cancelar(Request $request)
    {
        /*$reservacionHotel = reservacionHotel::findOrFail($request->Reserva_id);
        //modificamos el estado a 0
        $reservacionHotel->estado = 0;
        //Guardamos el registro a la BD
        $reservacionHotel->save();

        return redirect()->route('reservacionHotel.index')->with('success', 'Su reserva fue cancelada');*/
    }

    public function canceladas()
    {
        //utilizamos user_id de la relacion con mascotas
        /*$reservacionHotel = reservacionHotel::where('usuario_id', Auth::user()->id)
            ->where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservacionHotel.canceladas', compact('reservacionHotel'));*/
        $reservacionHotel = ReservacionHotel::simplePaginate(10);

        return view('admin.reservacionHotel.index', compact('reservacionHotel'));
    }

    public function completadas()
    {
        //utilizamos user_id de la relacion con mascotas
        /*$reservacionHotel = reservacionHotel::where('usuario_id', Auth::user()->id)
            ->where('estado', 2)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservacionHotel.completadas', compact('reservacionHotel'));*/
        $reservacionHotel = ReservacionHotel::simplePaginate(10);

        return view('admin.reservacionHotel.index', compact('reservacionHotel'));
    }



    public function SPInsertarReservacionHotel(Request $request)
    {
        // Obtener los datos del formulario
        $fechaIngreso = $request->input('fechaIngreso');
        $fechaSalida = $request->input('fechaSalida');
        // Obtener los demás datos del formulario
        $horaRecepcion = $request->input('horaRecepcion');
        $tratamiento_veterinaria = $request->input('tratamiento_veterinaria');
        $tratamiento_corte_banio = $request->input('tratamiento_corte_banio');
        $observaciones = $request->input('observaciones');
        $zona_direccion = $request->input('zona_direccion');
        $direccion = $request->input('direccion');
        $costo_transporte = $request->input('costo_transporte');
        $costo_comida = $request->input('costo_comida');
        $costo_veterinaria = $request->input('costo_veterinaria');
        $costo_corte_banio = $request->input('costo_corte_banio');
        $costo_extras = $request->input('costo_extras');
        $costo_total = $request->input('costo_total');
        $horaCheckin = $request->input('horaCheckin');
        $horaCheckout = $request->input('horaCheckout');
        $estado = $request->input('estado');
        $usuario_id = $request->input('usuario_id');
        $mascota_id = $request->input('mascota_id');
        $habitacion_id = $request->input('habitacion_id');

    // Ejecutar el procedimiento almacenado
    DB::statement('CALL SPInsertarReservacionHotel(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        $fechaIngreso,
        $fechaSalida,
        $horaRecepcion,
        $tratamiento_veterinaria,
        $tratamiento_corte_banio,
        $observaciones,
        $zona_direccion,
        $direccion,
        $costo_transporte,
        $costo_comida,
        $costo_veterinaria,
        $costo_corte_banio,
        $costo_extras,
        $costo_total,
        $horaCheckin,
        $horaCheckout,
        $estado,
        $usuario_id,
        $mascota_id,
        $habitacion_id
    ]);


        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->route('reservacionHotel.index')->with('success', 'Reserva registrada con éxito');
    }


    public function editProcedimiento(Request $request)
    {
        // Obtener los datos del formulario
        $reservacionHotel_id = $request -> input('reservacionHotel_id');
        $fechaIngreso = $request->input('fechaIngreso');
        $fechaSalida = $request->input('fechaSalida');
        // Obtener los demás datos del formulario
        $tratamientos = $request->input('tratamientos');
        $tranporte = $request->input('tranporte');
        $comida = $request->input('comida');
        $banioYCorte = $request->input('banioYCorte');
        $tratamiento = $request->input('tratamiento');
        $extras = $request->input('extras');
        $total = $request->input('total');
        $estado = $request->input('estado');
        $usuario_id = $request->input('usuario_id');
        $mascota_id = $request->input('mascota_id');
        $habitacion_id = $request->input('habitacion_id');
        
        // Ejecutar el procedimiento almacenado
        // Ejecutar el procedimiento almacenado
DB::statement('CALL ActualizarReservacionHotel(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
    $reservacionHotel_id,
    $fechaIngreso,
    $fechaSalida,
    // Pasar los demás datos del formulario como argumentos
    $tratamientos,
    $tranporte,
    $comida,
    $banioYCorte,
    $tratamiento,
    $extras,
    $total,
    $estado,
    $usuario_id,
    $mascota_id,
    $habitacion_id
]);
        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->route('reservacionHotel.index')->with('success', 'Reserva modificada con éxito');
    }
}