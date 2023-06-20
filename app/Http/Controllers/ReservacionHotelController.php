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
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Log;


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
        $reservacionHotel = ReservacionHotel::where('estado', 1)->simplePaginate(10);

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
        $reservacionHotel = ReservacionHotel::findOrFail($id);

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
          $reservacionHotel = ReservacionHotel::findOrFail($id);
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

    public function cancelar(Request $request)
{
    $reservacionHotel = ReservacionHotel::findOrFail($request->Reserva_id);
    // modificamos el estado a 0
    $reservacionHotel->estado = 0;
    // Guardamos el registro en la BD
    $reservacionHotel->save();

    // Actualizamos el estado de las habitaciones
    Habitacion::where('id', $reservacionHotel->habitacion_id)
        ->update(['estado' => 1]);

    return redirect()->route('reservacionHotel.index')->with('success', 'Su reserva fue cancelada');
}


    public function canceladas()
    {
        //utilizamos user_id de la relacion con mascotas
        /*$reservacionHotel = ReservacionHotel::where('usuario_id', Auth::user()->id)
            ->where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservacionHotel.canceladas', compact('reservacionHotel'));*/
        $users = User::all();
        $mascotas = Mascotas::all();
        $habitaciones = Habitacion::all();
        $reservacionHotel = ReservacionHotel::where('estado', 0)->simplePaginate(10);

        return view('admin.reservacionHotel.canceladas', compact('reservacionHotel','users','mascotas','habitaciones'));
    }

    public function checkin(Request $request)
    {

        $reservacionHotel = ReservacionHotel::findOrFail($request->input('Reserva_idch'));
        $horaActual = $request->input('horaCheckin');
        // Modificamos el estado a 2
        $reservacionHotel->estado = 2;
        $reservacionHotel->horaCheckin = $horaActual;

        // Guardamos el registro en la BD
        $reservacionHotel->save();

        return redirect()->route('reservacionHotel.activas')->with('success', 'Su reserva está activada');
    }

    public function activas()
    {
        $reservaciones_pasadas = ReservacionHotel::where('estado', 2) 
            //->where('usuario_id', Auth::user()->id)
            ->where('fechaSalida', '<=', now()->format('Y-m-d'))
            ->get();
        foreach($reservaciones_pasadas as $reserva){
            $reservacionHotel = ReservacionHotel::findOrFail($reserva->id);
            //modificamos el estado a 3
            $reservacionHotel->estado = 3;
            $reservacionHotel->costo_extras = 10;
            $reservacionHotel->costo_total = 10;
            //Guardamos el registro a la BD
            $reservacionHotel->save();
        }
        //utilizamos user_id de la relacion con mascotas
        /*$reservacionHotel = ReservacionHotel::where('usuario_id', Auth::user()->id)
            ->where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservacionHotel.canceladas', compact('reservacionHotel'));*/
        $users = User::all();
        $mascotas = Mascotas::all();
        $habitaciones = Habitacion::all();
        $reservacionHotel = ReservacionHotel::where('estado', 2)->simplePaginate(10);

        return view('admin.reservacionHotel.activas', compact('reservacionHotel','users','mascotas','habitaciones'));
    }

    public function checkout(Request $request)
    {

        $reservacionHotel = ReservacionHotel::findOrFail($request->input('Reserva_idcho'));
        $horaActual = $request->input('horaCheckout');
        // Modificamos el estado a 4
        $reservacionHotel->estado = 4;
        $reservacionHotel->horaCheckout = $horaActual;

        // Guardamos el registro en la BD
        $reservacionHotel->save();
        
        // Actualizamos el estado de las habitaciones
        Habitacion::where('id', $reservacionHotel->habitacion_id)
        ->update(['estado' => 1]);

        return redirect()->route('reservacionHotel.completadas')->with('success', 'Su reserva está completada');
    }


    public function completadas()
    {
        //utilizamos user_id de la relacion con mascotas
        /*$reservacionHotel = ReservacionHotel::where('usuario_id', Auth::user()->id)
            ->where('estado', 2)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservacionHotel.completadas', compact('reservacionHotel'));*/
        $users = User::all();
        $mascotas = Mascotas::all();
        $habitaciones = Habitacion::all();
        $reservacionHotel = ReservacionHotel::where('estado', 4)->simplePaginate(10);

        return view('admin.reservacionHotel.completadas', compact('reservacionHotel','users','mascotas','habitaciones'));
    }

    public function pendientes()
    {
        $users = User::all();
        $mascotas = Mascotas::all();
        $habitaciones = Habitacion::all();
        $reservacionHotel = ReservacionHotel::where('estado', 3)->simplePaginate(10);

        return view('admin.reservacionHotel.pendientes', compact('reservacionHotel','users','mascotas','habitaciones'));
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
        //return redirect()->route('reservacionHotel.index')->with('success', 'Reserva registrada con éxito');
        // Redireccionar o mostrar un mensaje de éxito
        // Obtener la URL de la página anterior
        $previousUrl = url()->previous();

        // Verificar la URL de la página anterior y redireccionar según corresponda
        if (strpos($previousUrl, 'createCLI') !== false) {
            // Redireccionar a la página createCLI
            return redirect()->route('reservacionHotel.indexCLI')->with('success', 'Reserva registrada con éxito');
        } elseif (strpos($previousUrl, 'create') !== false) {
            // Redireccionar a la página create
            return redirect()->route('reservacionHotel.create')->with('success', 'Reserva registrada con éxito');
        } else {
            // Redireccionar a una página predeterminada en caso de no coincidir con las anteriores
            return redirect()->route('reservacionHotel.index')->with('success', 'Reserva registrada con éxito');
        }
    }





    public function editProcedimiento(Request $request)
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
        $habitacion_id_nuevo = $request->input('habitacion_id_nuevo');
        
        // Ejecutar el procedimiento almacenado
        DB::statement('CALL SPActualizarReservacionHotel(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
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
            $habitacion_id,
            $habitacion_id_nuevo
        ]);
        
    
        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->route('reservacionHotel.index')->with('success', 'Reserva modificada con éxito');
        $previousUrl = url()->previous();

        // Verificar la URL de la página anterior y redireccionar según corresponda
        if (strpos($previousUrl, 'createCLI') !== false) {
            // Redireccionar a la página createCLI
            return redirect()->route('reservacionHotel.indexCLI')->with('success', 'Reserva registrada con éxito');
        } elseif (strpos($previousUrl, 'create') !== false) {
            // Redireccionar a la página create
            return redirect()->route('reservacionHotel.index')->with('success', 'Reserva registrada con éxito');
        } else {
            // Redireccionar a una página predeterminada en caso de no coincidir con las anteriores
            return redirect()->route('reservacionHotel.index')->with('success', 'Reserva registrada con éxito');
        }
    }
    
    public function indexCLI()
    {
    $user = auth()->user(); // Obtener el usuario autenticado
    $users = User::all();
    $mascotas = Mascotas::all();
    $habitaciones = Habitacion::all();
    $reservacionHotel = ReservacionHotel::where(function ($query) {
        $query->where('estado', '1')
              ->orWhere('estado', '2')
              ->orWhere('estado', '3');
    })->where('usuario_id', $user->id)
      ->simplePaginate(10);

    return view('admin.reservacionHotel.indexCLI', compact('reservacionHotel', 'users', 'mascotas', 'habitaciones'));
    }

    public function completadasCLI()
    {
    $user = auth()->user(); // Obtener el usuario autenticado
    $users = User::all();
    $mascotas = Mascotas::all();
    $habitaciones = Habitacion::all();
    $reservacionHotel = ReservacionHotel::where(function ($query) {
        $query->where('estado', '4');
    })->where('usuario_id', $user->id)
      ->simplePaginate(10);

    return view('admin.reservacionHotel.completadasCLI', compact('reservacionHotel', 'users', 'mascotas', 'habitaciones'));
    }

    public function canceladasCLI()
    {
    $user = auth()->user(); // Obtener el usuario autenticado
    $users = User::all();
    $mascotas = Mascotas::all();
    $habitaciones = Habitacion::all();
    $reservacionHotel = ReservacionHotel::where(function ($query) {
        $query->where('estado', '0');
    })->where('usuario_id', $user->id)
      ->simplePaginate(10);

    return view('admin.reservacionHotel.canceladasCLI', compact('reservacionHotel', 'users', 'mascotas', 'habitaciones'));
    }

    public function createCLI()
{
    $reservacionHotel = ReservacionHotel::select(['id', 'estado','mascota_id'])
        ->get();
    
    $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
        ->get();
    
    $user = auth()->user(); // Obtener el usuario autenticado
    
    $habitacions = Habitacion::where('estado', '=', '1')->get();

    return view('admin.reservacionHotel.createCLI', compact('reservacionHotel'))
        ->with('user', $user) // Pasar el usuario a la vista
        ->with('mascotas', $mascotas)
        ->with('habitacions', $habitacions);
}

public function getPDFhotel(Request $request){
    $user = Auth::user();
    $name = $user->name;
    $nombreSistema = "SISTEMA GENESIS";
    $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
    // Obtener la hora actual
    $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
    $reservacionHotel = ReservacionHotel::where('estado', 4)
        ->where('costo_total', '>', 0)
        ->orderBy('fechaSalida', 'asc')
        ->orderBy('horaRecepcion', 'asc')
        ->get();
    $mascotas = Mascotas::all();
    $users = User::select(['id', 'name'])
        ->get();
    $fechaInicio = $request->input('fechaInicio');
    $fechaFin = $request->input('fechaFin');
    $habitaciones = Habitacion::all();
    
    //return view('admin.reservacionHotel.reporte', compact('name', 'reservacionHotel', 'mascotas', 'users', 'nombreSistema', 'fecha', 'hora','habitaciones'));
    
    $view = view('admin.reservacionHotel.reporte', compact('name', 'reservacionHotel', 'mascotas', 'users', 'nombreSistema', 'fecha', 'hora','habitaciones'));
     // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
    if ($fechaInicio && $fechaFin) {
    $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
    }
    // Generar el PDF con la vista del reporte
    $pdf = PDF::loadHTML($view);

    return $pdf->stream('Reporte_Reservas_completadas.pdf');
}

}