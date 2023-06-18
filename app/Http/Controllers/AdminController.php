<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use Phpml\Regression\LeastSquares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
//use Phpml\Regression\SimpleLinearRegression;    
use Phpml\Math\Matrix;


class AdminController extends Controller
{
    //
    public function index()
    {

        /*
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

*/ // Obtener los datos de ventas desde tu base de datos
        $ventas = Ventas::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(cantidad) as total_cantidad'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $labels = [];
        $data = [];

        foreach ($ventas as $venta) {
            $labels[] = $venta->month;
            $data[] = $venta->total_cantidad;
        }

        // Cálculo de la línea de regresión utilizando el método de los mínimos cuadrados
        $n = count($labels);
        $sumX = array_sum($labels);
        $sumY = array_sum($data);
        $sumX2 = 0;
        $sumXY = 0;

        for ($i = 0; $i < $n; $i++) {
            $sumX2 += $labels[$i] * $labels[$i];
            $sumXY += $labels[$i] * $data[$i];
        }

        $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
        $intercept = ($sumY - $slope * $sumX) / $n;

        // Cálculo de los valores y etiquetas de la línea de regresión
        $regressionData = [];
        foreach ($labels as $label) {
            $regressionData[] = $slope * $label + $intercept;
        }
        //   return view('chart', compact('labels', 'data'));
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
        //   return view('admin.index')->with(compact('labels', 'values', 'prediction', 'months', 'earnings', 'ventas', 'sumatoriaVentas', 'datosLineaRegresion'));
        return view('admin.index')->with(compact('months', 'earnings', 'labels', 'data', 'regressionData'));
    }
    private function predictNextMonthSales($data)
    {
        // Calcular los coeficientes de la regresión lineal
        $n = count($data); // Número de datos
        $sumX = 0; // Sumatoria de los valores de x
        $sumY = 0; // Sumatoria de los valores de y
        $sumXY = 0; // Sumatoria de los productos xy
        $sumX2 = 0; // Sumatoria de los cuadrados de x

        foreach ($data as $item) {
            $x = Carbon::parse($item->month)->month; // Obtener el mes como valor de x
            $y = $item->total_ventas;

            $sumX += $x;
            $sumY += $y;
            $sumXY += $x * $y;
            $sumX2 += $x * $x;
        }

        $meanX = $sumX / $n; // Media de los valores de x
        $meanY = $sumY / $n; // Media de los valores de y

        // Calcular la pendiente (b) de la línea de regresión
        $slope = ($sumXY - $n * $meanX * $meanY) / ($sumX2 - $n * ($meanX * $meanX));

        // Calcular la intersección (a) con el eje y
        $intercept = $meanY - $slope * $meanX;

        // Formatear y normalizar los valores de las ventas
        $formattedValues = [];
        foreach ($data as $item) {
            $formattedValues[] = number_format($item->total_ventas, 2, '.', '') / 1000; // Aplicar formateo y normalización
        }

        $regressionLineValues = [];
        foreach ($formattedValues as $index => $value) {
            $x = $index + 1; // Valor de x correspondiente al índice
            $regressionLineValues[] = $slope * $x + $intercept;
        }

        // Calcular la predicción para el próximo mes
        $nextMonth = Carbon::now()->addMonth()->format('Y-m');
        $nextMonthSales = $slope * Carbon::parse($nextMonth)->month + $intercept;

        // Calcular los valores de la línea de regresión extendida hasta julio
        $extendedRegressionLineValues = [];
        for ($i = 1; $i <= count($formattedValues) + 7; $i++) {
            $extendedRegressionLineValues[] = $slope * $i + $intercept;
        }

        return $nextMonthSales;
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
