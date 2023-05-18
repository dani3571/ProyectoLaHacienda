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
      $reservas_peluqueria = ReservacionPeluqueria::simplePaginate(10);
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
}