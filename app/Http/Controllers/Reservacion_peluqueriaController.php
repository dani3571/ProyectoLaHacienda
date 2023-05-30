<?php

namespace App\Http\Controllers;

use App\Models\ReservacionPeluqueria;
use App\Models\Mascotas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Reservacion_peluqueriaRequest;
use Spatie\Permission\Models\Role ;


class Reservacion_peluqueriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaciones_pasadas = ReservacionPeluqueria::where('estado', 1) 
            //->where('usuario_id', Auth::user()->id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaEntrega', '<=', now()->format('H:i'))
            ->get();
        foreach($reservaciones_pasadas as $reserva){
            $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($reserva->id);
            //modificamos el estado a 2
            $reservacion_peluqueria->estado = 2;
            //Guardamos el registro a la BD
            $reservacion_peluqueria->save();
        }
        
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 1)
            //->where('usuario_id', Auth::user()->id)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplePaginate(10);
        return view('admin.reservas_peluqueria.index', compact('reservas_peluqueria'));
    }

    public function create()
    {
        $reservas_peluqueria = ReservacionPeluqueria::select(['id', 'fecha'])
            ->get();
        
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('usuario_id', Auth::user()->id)
            ->get();
        
        $users = User::all();
        return view('admin.reservas_peluqueria.create', compact('reservas_peluqueria', 'mascotas', 'users'));
    }

    public function store(Reservacion_peluqueriaRequest $request)
    {
        

        $reservas_peluqueria = ReservacionPeluqueria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('estado', 1)
        ->first();
        if ($reservas_peluqueria === null) {
            //merge combina los datos que tenemos con los que queremos obtener
            $request->merge([
                //obtenemos los datos de user como su id con Auth
                'usuario_id' => Auth::user()->id
            ]);
            //Guardando la solicitud en una variable
            $reservacion_peluqueria = $request->all();

            ReservacionPeluqueria::create($reservacion_peluqueria);
            //return redirect()->action([Reservacion_peluqueriaController::class, 'index']);
            return redirect()->route('reservas_peluqueria.index')->with('success', 'Reserva registrada con éxito');
        }
        else return redirect()->route('reservas_peluqueria.create')->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function edit($id)
    {
        //devolvemos a la vista admin.reservas_peluqueria.edit
        $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($id);
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('usuario_id', Auth::user()->id)
            ->get();
        return view('admin.reservas_peluqueria.edit', compact('reservacion_peluqueria', 'mascotas'));
    }

    public function update(Reservacion_peluqueriaRequest $request, $id)
    {
        $reservas_peluqueria = ReservacionPeluqueria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('id', '!=', $request->id)
        ->where('estado', 1)
        ->first();
        if ($reservas_peluqueria === null) {
            $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($id);
            $reservacion_peluqueria->fill($request->all());
            //guardamos la informacion actualizada
            $reservacion_peluqueria->save();
            //mostramos un mensaje de exito 
            return redirect()->route('reservas_peluqueria.index')->with('success', 'Reserva actualizada con éxito');
        }
        else return redirect()->route('reservas_peluqueria.edit', $id)->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function cancelar(Request $request)
    {
        $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($request->Reserva_id);
        //modificamos el estado a 0
        $reservacion_peluqueria->estado = 0;
        //Guardamos el registro a la BD
        $reservacion_peluqueria->save();

        return redirect()->route('reservas_peluqueria.index')->with('success', 'Su reserva fue cancelada');
    }

    public function canceladas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_peluqueria = ReservacionPeluqueria::where('usuario_id', Auth::user()->id)
            ->where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservas_peluqueria.canceladas', compact('reservas_peluqueria'));
    }

    public function completadas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_peluqueria = ReservacionPeluqueria::where('usuario_id', Auth::user()->id)
            ->where('estado', 2)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservas_peluqueria.completadas', compact('reservas_peluqueria'));
    }
}