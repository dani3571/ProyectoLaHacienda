<?php

namespace App\Http\Controllers;

use App\Models\ReservacionPeluqueria;
use Illuminate\Http\Request;

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
        return view('admin.reservas_peluqueria.create', compact('reservas_peluqueria'));
    }
}