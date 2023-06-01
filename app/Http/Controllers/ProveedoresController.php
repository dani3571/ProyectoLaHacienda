<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProveedoresRequest;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware('can:proveedores.index')->only('index');
       $this->middleware('can:proveedores.edit')->only('edit');
       $this->middleware('can:proveedores.create')->only('create');
       $this->middleware('can:proveedores.inactivos')->only('inactivos');
     }
    public function index()
    {
        $proveedores = Proveedores::where('estado', 1)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);

        return view('admin.proveedores.index', compact('proveedores'));
    }


    public function inactivos()
    {
        $proveedores = Proveedores::where('estado', 0)
        ->orderBy('id', 'asc')
        ->simplePaginate(10);

           return View('admin.proveedores.inactivos', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedores::select(['id', 'nombre'])
            ->where('estado', 1)
            ->get();
        return view('admin.proveedores.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Combinar los datos que tenemos con los que queremos obtener
    $request->merge([
        // Obtener los datos del usuario como su ID con Auth
        'usuario_id' => Auth::user()->id,
    ]);
    // Validar los datos del formulario si es necesario
    // Crear una nueva instancia del modelo Proveedores y asignar los datos del formulario
    $proveedor = new Proveedores();
    $proveedor->nombre = $request->input('nombre');
    $proveedor->telefono = $request->input('telefono');
    $proveedor->direccion = $request->input('direccion');
    $proveedor->ciudad = $request->input('ciudad');
    $proveedor->url = $request->input('url');
    // Asignar otros campos según corresponda
    // Guardar el proveedor en la base de datos
    $proveedor->save();
    // Redireccionar o mostrar una respuesta de éxito
    //return view('admin.proveedores.index', compact('proveedores'));
    return redirect()->action([ProveedoresController::class, 'index']);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedores::findOrFail($id);

        return view('admin.proveedores.edit', compact('proveedor'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedores::findOrFail($id);

        $proveedor->nombre = $request->input('nombre');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->ciudad = $request->input('ciudad');
        $proveedor->url = $request->input('url');

        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success-update', 'Proveedor actualizado con éxito');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores.inactivos')->with('success-update', 'EL PROVEEDOR SE HA ELIMINADO DEFINITIVAMENTE');
    }
    public function cambiarEstado($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->estado = 0;
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success-update', 'EL PROVEEDOR SE A ELIMINADO CON EXITO');
    }
    public function restablecerEstado($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->estado = 1;
        $proveedor->save();

        return redirect()->route('proveedores.inactivos')->with('success-update', 'SE PUDO RESTABLECER CON EXITO');
    }
    public function generatePDF(Request $request)
    {
        $user = Auth::user();
        $name = $user->name;
        $nombreSistema = "SISTEMA GENESIS";
        $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Obtener la hora actual
        $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
        $proveedores = Proveedores::all(); // Obtén los datos de los proveedores desde la base de datos
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
       
        $view = view('admin.proveedores.reporte', compact('name', 'proveedores', 'nombreSistema', 'fecha', 'hora'));
        
         // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
        if ($fechaInicio && $fechaFin) {
        $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
        }
        // Generar el PDF con la vista del reporte
        $pdf = PDF::loadHTML($view);
     
        return $pdf->stream('reporteProveeodres.pdf');
      
    }

}
