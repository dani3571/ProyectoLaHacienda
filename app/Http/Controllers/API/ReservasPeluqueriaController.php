<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservacionPeluqueria;

class ReservasPeluqueriaController extends Controller
{
    public function index($id)
    {
        $reservaciones = ReservacionPeluqueria::where('usuario_id', $id)->get();
        return response()->json($reservaciones);
    }
    public function history($id)
    {
        $reservaciones = ReservacionPeluqueria::where('usuario_id', $id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaEntrega', '<=', now()->format('H:i'))
            ->get();
        return response()->json($reservaciones);
    }
    public function create(Request $request)
    {
        $reserva = ReservacionPeluqueria::create([
            'name' => $request->input('name'),
            'ci' => $request->input('ci'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'email' => $request->input('email'),
            'personaResponsable' => $request->input('personaResponsable'),
            'telefonoResponsable' => $request->input('telefonoResponsable'),
            'password' => Hash::make($request->input('password'),),
        ]);
        if ($reserva) {
            return response()->json($reserva, 201);
        } else {
            return response()->json(['error' => 'No se pudo crear el usuario'], 500);
        }
    }
}
