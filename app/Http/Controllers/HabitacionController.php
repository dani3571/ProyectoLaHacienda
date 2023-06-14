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
        $habitacion = Habitacion::simplePaginate(10)
        ->where('estado', 1);

        return view('admin.habitacion.index', compact('habitacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $habitacion = Habitacion::all();

        return   view('admin.habitacion.create', compact('habitacion'));
    }

    public function store(HabitacionRequest $request)
    {
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

    public function desactivar(Request $request)
    {
        $habitacion = Habitacion::findOrFail($request->Habi_id);
        $habitacion->estado = 0;
        $habitacion->save();

        return redirect()->route('habitacion.desactivadas')->with('success-update', 'Habitación desactivada con éxito');
    }

    public function desactivadas(Request $request)
    {
        $habitacion = Habitacion::simplePaginate(10)
        ->where('estado', 0);

        return view('admin.habitacion.desactivadas', compact('habitacion'));
    }

    public function reactivar(Request $request)
    {
        $habitacion = Habitacion::findOrFail($request->Habi_id);
        $habitacion->estado = 1;
        $habitacion->save();

        return redirect()->route('habitacion.index')->with('success-update', 'Habitación restablecida con éxito');
    }
}