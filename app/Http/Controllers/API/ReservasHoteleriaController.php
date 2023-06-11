<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservacionHotel;

class ReservasHoteleriaController extends Controller
{
    public function index($id)
    {
        $reservaciones = ReservacionHotel::where('usuario_id',$id)
            ->get();
        return response()->json($reservaciones);
    }
    public function history($id)
    {
        $reservaciones = ReservacionHotel::where('usuario_id',$id)
        ->where('fechaSalida', '<=', now()->format('Y-m-d'))
        ->get();
        return response()->json($reservaciones);
    }
    public function create(Request $request)
    {
        $reserva = ReservacionHotel::create([
            'fechaIngreso' => $request->input('fechaIngreso'),
            'fechaSalida' => $request->input('fechaSalida'),
            'horaRecepcion' => $request->input('horaRecepcion'),
            'tratamiento_veterinaria' => $request->input('tratamiento_veterinaria'),
            'tratamiento_corte_banio' => $request->input('tratamiento_corte_banio'),
            'observaciones' => $request->input('observaciones'),
            'zona_direccion' => $request->input('zona_direccion'),
            'direccion' => $request->input('direccion'),
            'costo_transporte' => $request->input('costo_transporte'),
            'costo_comida' => $request->input('costo_comida'),
            'costo_veterinaria' => $request->input('costo_veterinaria'),
            'costo_corte_banio' => $request->input('costo_corte_banio'),
            'costo_extras' => $request->input('costo_extras'),
            'costo_total' => $request->input('costo_total'),
            'horaCheckin' => $request->input('horaCheckin'),
            'horaCheckout' => $request->input('horaCheckout'),  
            'estado' => $request->input('estado'),
            'usuario_id' => $request->input('usuario_id'),
            'mascota_id' => $request->input('mascota_id'),
            'habitacion_id' => $request->input('habitacion_id'),
        ]);
        if ($reserva) {
            $ultimareserva = ReservacionHotel::latest()->first();
            return response()->json($ultimareserva, 201);
        } else {
            return response()->json(['error' => 'No se pudo crear la reserva'], 500);
        }
    }
}
