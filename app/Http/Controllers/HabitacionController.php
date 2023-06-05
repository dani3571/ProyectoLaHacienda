<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use App\Http\Requests\HabitacionRequest;
//use Spatie\Permission\Models\Habitacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
     
    }
    public function index()
    {
        $habitacion = Habitacion::simplePaginate(10);

        return view('admin.habitacion.index', compact('habitacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $habitacion = Permission::all();

        return   view('admin.habitacion.create', compact('habitacion'));
    }

    public function store(HabitacionRequest $request)
    {
       //merge combina los datos que tenemos con los que queremos obtener
       //$request->merge([
        //obtenemos los datos de user como su id con Auth
        //'usuario_id' => Auth::user()->id,
    //]);
    //Guardando la solicitud en una variable
    $habitacion = $request->all();

        Habitacion::create($habitacion);
        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha creado la habitacion [' .$request->nro_habitacion. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
        return redirect()->action([HabitacionController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitacion  
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habitacion = habitacion::findOrFail($id);

        return view('admin.habitacion.show', compact('habitacion'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitacion  
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

          $habitacion = habitacion::findOrFail($id);

          return view('admin.habitacion.edit', compact('habitacion'));
    
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habitacion  $mascotas
     * @return \Illuminate\Http\Response
     */

     public function update(HabitacionRequest $request, $id)
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
     $habitacion = Habitacion::findOrFail($id);

    if($request->nro_habitacion != $habitacion->nro_habitacion){
        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha modificado el numero de la habitacion [' .$habitacion->nro_habitacion. '] => [' .$request->nro_habitacion. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
    }
    if($request->costo_habitacion != $habitacion->costo_habitacion){
        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha modificado el costo de la habitacion [' .$request->nro_habitacion. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
    }
    if($request->capacidad != $habitacion->capacidad){
        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha modificado la capacidad de la habitacion [' .$request->nro_habitacion. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
    }
 
     $habitacion->fill($request->all());
 
     $habitacion->save();
 
     return redirect()->route('habitacion.index')
         ->with('success-update', 'Habitación con éxito');
     }



     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();
        return redirect()->route('habitacion.index')->with('success-update', 'Reservación eliminada con exito');
        //return redirect()->route('habitacion.inactivos')->with('success-update', 'Reservación eliminada con exito');
    }
    
    public function asignaReservaHotel(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'reservacionHotel_id' => 'required'
        ]);
    
        // Encuentra el registro que deseas actualizar
        $habitacion = Habitacion::find($id);
    
        if (!$habitacion) {
            // Maneja el caso en el que no se encuentre el registro
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }
    
        // Actualiza los campos del modelo con los valores del formulario
        $habitacion->reservacionHotel_id = $request->input('reservacionHotel_id');
    
        // Guarda los cambios en la base de datos
        $habitacion->save();
    
        // Retorna una respuesta en formato JSON
        return response()->json(['success' => 'Registro actualizado correctamente.']);
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
}