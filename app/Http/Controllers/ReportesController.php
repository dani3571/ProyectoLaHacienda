<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function index()
    {
        //Dashboard
        //Obteniendo los datos
        $fechaActual = date('Y-m-d');
        //usuarios
        $registrosUsuarios = DB::table('users')
            ->whereDate('created_at', $fechaActual)
            ->count();
        //ventas
        $registrosVentas = DB::table('ventas')
            ->whereDate('created_at', $fechaActual)
            ->count();
        //compras
        $registrosCompras = DB::table('compras')
            ->whereDate('created_at', $fechaActual)
            ->count();
        //veterinarias
        $registrosVet = DB::table('reservacion_veterinarias')
            ->whereDate('created_at', $fechaActual)
            ->count();
        //hotel
        $registrosHotel = DB::table('reservacion_hotels')
            ->whereDate('created_at', $fechaActual)
            ->count();
        //peluqueria
        $registrosPeluqueria = DB::table('reservacion_peluquerias')
            ->whereDate('created_at', $fechaActual)
            ->count();

        return view('admin.index', compact('registrosUsuarios', 'registrosVentas', 'registrosCompras','registrosVet','registrosHotel','registrosPeluqueria'));
    }
}
