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
            'id' => $request->input('id'),
            'fechaIngreso' => $request->input('fechaIngreso'),
            'fechaSalida' => $request->input('fechaSalida'),
            'tratamientos' => $request->input('tratamientos'),
            'tranporte' => $request->input('tranporte'),
            'comida' => $request->input('comida'),
            'banioYCorte' => $request->input('banioYCorte'),
            'tratamiento' => $request->input('tratamiento'),
            'extras' => $request->input('extras'),
            'total' => $request->input('total'),
            'estado' => $request->input('estado'),
            'usuario_id' => $request->input('usuario_id'),
            'mascota_id' => $request->input('mascota_id'),
            'habitacion_id' => $request->input('habitacion_id'),
        ]);
        if ($reserva) {
            return response()->json($reserva, 201);
        } else {
            return response()->json(['error' => 'No se pudo crear el usuario'], 500);
        }
    }
}
