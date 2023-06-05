<?php

namespace App\Http\Controllers;

use Phpml\Regression\LeastSquares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class AdminController extends Controller
{
    //
    public function index(){
       // Obtener los datos de las ventas de la base de datos
       $data = DB::table('ventas')->select('created_at', 'cantidad')->get();
       // Preparar los datos para la regresión lineal
       $samples = [];
       $targets = [];
       foreach ($data as $item) {
           $month = Carbon::parse($item->created_at)->format('m'); // Obtener el mes de la fecha
           $samples[] = [$month];
           $targets[] = $item->cantidad;
       }

       // Crear y ajustar el modelo de regresión lineal
       $regression = new LeastSquares();
       $regression->train($samples, $targets);

       // Hacer la predicción para el próximo mes
       $currentMonth = Carbon::now()->format('m'); // Obtener el mes actual
       $nextMonth = $currentMonth + 1; // Obtener el mes siguiente
       $prediction = $regression->predict([$nextMonth]);

       // Retornar la predicción
      // return response()->json(['prediction' => $prediction]);
       return view('admin.index')->with(compact('values', 'prediction'));
    
    }


}
