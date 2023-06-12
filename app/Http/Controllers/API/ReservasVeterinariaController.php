<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservacionVeterinaria;

class ReservasVeterinariaController extends Controller
{
    public function index($id)
    {
        $reservaciones = ReservacionVeterinaria::where('usuario_id',$id)
        ->get();
        return response()->json($reservaciones, 200);
    }
    public function history($id)
    {
        $reservaciones = ReservacionVeterinaria::where('usuario_id',$id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaRecepcion', '<=', now()->format('H:i'))
            ->get();
        return response()->json($reservaciones);
    }
    public function create(Request $request)
    {
        $reserva = ReservacionVeterinaria::create([
            'fecha' => $request->input('fecha'),
            'horaRecepcion' => $request->input('horaRecepcion'),
            'motivoReservacion' => $request->input('motivoReservacion'),
            'estado' => $request->input('estado'),
            'usuario_id' => $request->input('usuario_id'),
            'mascota_id' => $request->input('mascota_id'),
        ]);
        if ($reserva) {
            $ultimareserva = ReservacionVeterinaria::latest()->first();
            return response()->json($ultimareserva, 201);
        } else {
            return response()->json(['error' => 'No se pudo crear el usuario'], 500);
        }
    }
}
