<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use Phpml\Regression\LeastSquares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
//use Phpml\Regression\SimpleLinearRegression;    
use Phpml\Math\Matrix;
use App\Models\User;
use App\Models\Mascotas;
use App\Http\Requests\MascotaRequest;
use App\Models\Vacunas;
use App\Models\Diagnostico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $mascotas = Mascotas::where('usuario_id', 1)->simplePaginate(10);
        return view('admin.profile', compact('user','mascotas'));
    }

    public function vacunasMascota($id)
    {
    $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
        ->get();

    $vacunas = Vacunas::where('mascota_id', $id)
        ->orderBy('id', 'desc')
        ->simplePaginate(10);

    return view('admin.vacunas', compact('vacunas'))
        ->with('mascotas', $mascotas);
    }

    public function diagnosticosMascota($id)
    {
    $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
        ->get();

    $diagnosticos = Diagnostico::where('mascota_id', $id)
        ->orderBy('id', 'desc')
        ->simplePaginate(10);

    return view('admin.diagnosticos', compact('diagnosticos'))
        ->with('mascotas', $mascotas);
    }

    public function createMascota()
    {
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('estado', 1)
            ->get();
        return view('admin.createMascota', compact('mascotas'));
    }

    public function storeMascota(MascotaRequest $request)
    {
        //merge combina los datos que tenemos con los que queremos obtener
        $request->merge([
            //obtenemos los datos de user como su id con Auth
            'usuario_id' => Auth::user()->id,
        ]);
        $mascota = new Mascotas();
        $mascota->fill($request->all());
        //Si encuentra una foto que elimine la anterior y asigne la nueva
        if ($request->hasFile('image')) {
            //Asignar nueva foto
            $photo = $request['image']->store('mascotas');
        } else {
            //si no tiene foto que se quede con la actual
            $photo = $mascota->image;
        }
        //Asignamos la foto
        $mascota->image = $photo;

        $peso = $request->input('peso');
        $unidad_peso = $request->input('unidad_peso');
        $mascota->peso = $peso . ' ' . $unidad_peso;

        $mascota->save();

        $user = Auth::user();
        $logMessage = 'El usuario [' . $user->name . '] ha registrado la mascota [' . $mascota->nombre . ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);

        // Mostrar un mensaje de éxito
        return redirect()->route('admin.profile')
            ->with('success', 'Mascota actualizada con éxito');
    }

    public function editMascota($id)
    {
        //devolvemos a la vista admin.mascotas.edit
        $mascota = Mascotas::findOrFail($id);
        return view('admin.editMascota', compact('mascota'));
    }

    public function updateMascota(MascotaRequest $request, $id)
    {
        $mascota = Mascotas::findOrFail($id);
    
        // Si encuentra una foto, elimine la anterior y asigne la nueva
        if ($request->hasFile('image')) {
            // Eliminar foto anterior
            File::delete(public_path('storage/' . $mascota->image));
            // Asignar nueva foto
            $photo = $request->file('image')->store('mascotas');
            // Asignar la nueva foto a la mascota
            $mascota->image = $photo;
        }
    
        // Actualizar los campos individuales si han cambiado
        if ($request->nombre != $mascota->nombre) {
            $mascota->nombre = $request->nombre;
        }
        if ($request->raza != $mascota->raza) {
            $mascota->raza = $request->raza;
        }
        if ($request->color != $mascota->color) {
            $mascota->color = $request->color;
        }
        if ($request->fechaNacimiento != $mascota->fechaNacimiento) {
            $mascota->fechaNacimiento = $request->fechaNacimiento;
        }
        if ($request->caracter != $mascota->caracter) {
            $mascota->caracter = $request->caracter;
        }
        if ($request->sexo != $mascota->sexo) {
            $mascota->sexo = $request->sexo;
        }
    
        // Obtener el valor del campo de peso y eliminar cualquier caracter no numérico
        $peso = preg_replace('/[^0-9]/', '', $request->peso);
    
        // Obtener el valor del campo de unidad de peso
        $unidad_peso = $request->unidad_peso;
    
        // Unir el peso y la unidad de peso
        $peso_completo = $peso . ' ' . $unidad_peso;
    
        $mascota->peso = $peso_completo;
    
        // Guardar la información actualizada
        $mascota->save();
    
        // Mostrar un mensaje de éxito
        return redirect()->route('admin.profile')
            ->with('success', 'Mascota actualizada con éxito');
    }

    public function indexCLI()
    {
        return view('admin.indexCLI');
    }

    public function hasRole($roleName)
    {
    foreach ($this->roles as $role) {
        if ($role->name === $roleName) {
            return true;
        }
    }
    return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }
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
        
        //return view('admin.index')->with(compact('months', 'earnings', 'labels', 'data', 'regressionData'));

        if (!Auth::user()->hasRole('Administrador')) {
            return $this->indexCLI();
        } else {
            return view('admin.index')->with(compact('months', 'earnings', 'labels', 'data', 'regressionData'));
        }
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
