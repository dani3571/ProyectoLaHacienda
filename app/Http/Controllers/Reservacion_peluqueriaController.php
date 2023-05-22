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
      
      $reservas_peluqueria = ReservacionPeluqueria::where('usuario_id', Auth::user()->id)
            ->where('estado', 1)
            ->orderBy('id', 'asc')
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
        return view('admin.reservas_peluqueria.create', compact('reservas_peluqueria', 'mascotas'));
    }

    public function store(Reservacion_peluqueriaRequest $request)
    {
       //merge combina los datos que tenemos con los que queremos obtener
       $request->merge([
        //obtenemos los datos de user como su id con Auth
        'usuario_id' => Auth::user()->id
        
    ]);
    //Guardando la solicitud en una variable
    $reservacion_peluqueria = $request->all();

        ReservacionPeluqueria::create($reservacion_peluqueria);
        return redirect()->action([Reservacion_peluqueriaController::class, 'index']);
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
        $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($id);
        $reservacion_peluqueria->fill($request->all());
        //guardamos la informacion actualizada
        $reservacion_peluqueria->save();
        //mostramos un mensaje de exito 
        return redirect()->route('reservas_peluqueria.index')->with('success', 'Reserva actualizada con éxito');
    }

    public function cancelar($id)
    {
        $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($id);
        //modificamos el estado a 0
        $reservacion_peluqueria->estado = 0;
        //Guardamos el registro a la BD
        $reservacion_peluqueria->save();

        return redirect()->route('reservas_peluqueria.index');
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
}