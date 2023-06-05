<?php

namespace App\Http\Controllers;

use Phpml\Regression\LeastSquares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    //
    public function index()
    {
        // Obtener los datos de ventas de la base de datos
        $data = DB::table('ventas')
            ->select(DB::raw('SUM(cantidad) as total_ventas'), DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'))
            ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
            ->groupBy('month')
            ->get();

        // Preparar los datos para el gráfico
        $labels = [];
        $values = [];

        foreach ($data as $item) {
            $month = Carbon::parse($item->month)->format('M Y'); // Obtener el nombre del mes y año
            $labels[] = $month;
            $values[] = $item->total_ventas;
        }

        // Hacer la predicción para el próximo mes (junio)
        $prediction = $this->predictNextMonthSales($data);

        // Obtener el nombre del próximo mes (junio)
        $nextMonthName = Carbon::now()->addMonth()->format('M Y');

        // Agregar la predicción al array de valores
        $values[] = $prediction;

        // Agregar el nombre del próximo mes al array de etiquetas
        $labels[] = $nextMonthName;

        // Obtener los datos de ganancias de la base de datos
        $data2 = DB::table('detalle_ventas')
        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") AS month, SUM(subtotal) AS earnings')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();
        // Preparar los datos para el gráfico
        $months = [];
        $earnings = [];
        foreach ($data2 as $item2) {
            
            $months[] = Carbon::parse($item2->month)->format('M');
            $earnings[] = $item2->earnings;
        }

        // Hacer la predicción para el próximo mes
        $prediction2 = $this->predictNextMonthEarnings($data2);

        // Preparar los datos para el gráfico de pronóstico
        $nextMonth = Carbon::now()->addMonth()->format('M');
        $months[] = $nextMonth;
        $earnings[] = $prediction2;

        // Pasar los datos a la vista
        return view('admin.index')->with(compact('labels', 'values', 'prediction', 'months', 'earnings'));
    }
    private function predictNextMonthSales($data)
    {
        // Preparar los datos para la regresión lineal
        $samples = [];
        $targets = [];
        foreach ($data as $item) {
            $month = Carbon::parse($item->month)->month;
            $samples[] = [$month];
            $targets[] = $item->total_ventas;
        }

        // Crear y ajustar el modelo de regresión lineal
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // Hacer la predicción para el próximo mes (junio)
        $prediction = $regression->predict([7]); // 6 representa el mes de junio
        return $prediction;
    }
    private function predictNextMonthEarnings($data2)
    {
        // Preparar los datos para la regresión lineal
        $samples = [];
        $targets = [];
        foreach ($data2 as $item2) {
            $month = Carbon::parse($item2->month)->month;
            $samples[] = [$month];
            $targets[] = $item2->earnings;
        }

        // Crear y ajustar el modelo de regresión lineal
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // Hacer la predicción para el próximo mes
        $currentMonth = Carbon::now()->month;
        $nextMonth = $currentMonth + 1;
        $prediction = $regression->predict([$nextMonth]);

        return $prediction;
    }
}