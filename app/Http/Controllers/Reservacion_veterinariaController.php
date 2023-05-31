<?php

namespace App\Http\Controllers;

use App\Models\ReservacionVeterinaria;
use App\Models\Mascotas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Reservacion_veterinariaRequest;
use Spatie\Permission\Models\Role ;


class Reservacion_veterinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaciones_pasadas = ReservacionVeterinaria::where('usuario_id', Auth::user()->id)
            ->where('estado', 1)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaRecepcion', '<=', now()->format('H:i'))
            ->get();
        foreach($reservaciones_pasadas as $reserva){
            $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($reserva->id);
            //modificamos el estado a 2
            $reservacion_veterinaria->estado = 2;
            //Guardamos el registro a la BD
            $reservacion_veterinaria->save();
        }
        
        $reservas_veterinaria = ReservacionVeterinaria::where('usuario_id', Auth::user()->id)
            ->where('estado', 1)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplePaginate(10);

        $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
        
        $users = User::select(['id', 'name'])
            ->get();

            return view('admin.reservas_veterinaria.index', compact('reservas_veterinaria', 'mascotas', 'users'));

    }

    public function create()
    {
        $reservas_veterinaria = ReservacionVeterinaria::select(['id', 'fecha'])
            ->get();
        
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('usuario_id', Auth::user()->id)
            ->get();
        return view('admin.reservas_veterinaria.create', compact('reservas_veterinaria', 'mascotas'));
    }

    public function store(Reservacion_veterinariaRequest $request)
    {
        $reservas_veterinaria = ReservacionVeterinaria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('estado', 1)
        ->first();
        if ($reservas_veterinaria === null) {
            //merge combina los datos que tenemos con los que queremos obtener
            $request->merge([
                //obtenemos los datos de user como su id con Auth
                'usuario_id' => Auth::user()->id
            ]);
            //Guardando la solicitud en una variable
            $reservacion_veterinaria = $request->all();

            ReservacionVeterinaria::create($reservacion_veterinaria);
            //return redirect()->action([Reservacion_veterinariaController::class, 'index']);
            return redirect()->route('reservas_veterinaria.index')->with('success', 'Reserva registrada con éxito');
        }
        else return redirect()->route('reservas_veterinaria.create')->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function edit($id)
    {
        //devolvemos a la vista admin.reservas_veterinaria.edit
        $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($id);
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('usuario_id', Auth::user()->id)
            ->get();
        return view('admin.reservas_veterinaria.edit', compact('reservacion_veterinaria', 'mascotas'));
    }

    public function update(Reservacion_veterinariaRequest $request, $id)
    {
        $reservas_veterinaria = ReservacionVeterinaria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('id', '!=', $request->id)
        ->where('estado', 1)
        ->first();
        if ($reservas_veterinaria === null) {
            $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($id);
            $reservacion_veterinaria->fill($request->all());
            //guardamos la informacion actualizada
            $reservacion_veterinaria->save();
            //mostramos un mensaje de exito 
            return redirect()->route('reservas_veterinaria.index')->with('success', 'Reserva actualizada con éxito');
        }
        else return redirect()->route('reservas_veterinaria.edit', $id)->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function cancelar(Request $request)
    {
        $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($request->Reserva_id);
        //modificamos el estado a 0
        $reservacion_veterinaria->estado = 0;
        //Guardamos el registro a la BD
        $reservacion_veterinaria->save();

        return redirect()->route('reservas_veterinaria.index')->with('success', 'Su reserva fue cancelada');
    }

    public function canceladas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_veterinaria = ReservacionVeterinaria::where('usuario_id', Auth::user()->id)
            ->where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservas_veterinaria.canceladas', compact('reservas_veterinaria'));
    }

    public function completadas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_veterinaria = ReservacionVeterinaria::where('usuario_id', Auth::user()->id)
            ->where('estado', 2)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservas_veterinaria.completadas', compact('reservas_veterinaria'));
    }
}
