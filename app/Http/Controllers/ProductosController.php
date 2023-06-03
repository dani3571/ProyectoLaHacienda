<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categorias;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware('can:productos.index')->only('index');
       $this->middleware('can:productos.create')->only('create');
       $this->middleware('can:productos.edit')->only('edit');
       $this->middleware('can:productos.inactivos')->only('inactivos');
     }

     
    public function index()
    {
        $productos = Productos::where('estado', 1)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        
        $categoria = Categorias::all();
        
        return view('admin.productos.index', compact('productos', 'categoria'));
    }
    public function inactivos()
    {
        $productos = Productos::where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        
        $categoria = Categorias::all();
        
        return view('admin.productos.inactivos', compact('productos', 'categoria'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $productos = Productos::select(['id', 'nombre'])
            ->where('estado', 1)
            ->get();
        
        $categoria = Categorias::where('estado', 1)->get();
        
        return view('admin.productos.create', compact('productos', 'categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria_id' => 'required',
            'precio' => 'required',
            'cantidad' => 'required',
            'image' => 'required',
            'fecha_vencimiento' => 'required',
            // Agrega aquí las demás validaciones para los campos del producto
        ]);
        $producto = new Productos();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->categoria_id = $request->categoria_id;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('productos', 'imagenes');
            $producto->image = $path;
        }
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto registrado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productos = Productos::findOrFail($id);
        $categoria = Categorias::all(); // Obtén todos los proveedores desde la base de datos
        return view('admin.productos.edit', compact('productos', 'categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Productos::findOrFail($id);

        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->fecha_vencimiento = $request->input('fecha_vencimiento');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('productos', 'imagenes');
            $producto->image = $path;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success-update', 'Producto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $productos)
    {
        //
    }
    public function cambiarEstado($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->estado = 0;
        $producto->save();

        return redirect()->route('productos.index')->with('success-update', 'EL PROVEEDOR SE A ELIMINADO CON EXITO');
    }
    public function restablecerEstado($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->estado = 1;
        $producto->save();

        return redirect()->route('productos.inactivos')->with('success-update', 'Producto restablecido con éxito');
    }

    public function generatePDFPRD(Request $request)
    {
        $user = Auth::user();
        $name = $user->name;
        $nombreSistema = "SISTEMA GENESIS";
        $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Obtener la hora actual
        $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
        $proveedores = Productos::all(); // Obtén los datos de los proveedores desde la base de datos
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
       
        $view = view('admin.proveedores.reporte', compact('name', 'proveedores', 'nombreSistema', 'fecha', 'hora'));
        
         // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
        if ($fechaInicio && $fechaFin) {
        $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
        }
        // Generar el PDF con la vista del reporte
        $pdf = PDF::loadHTML($view);
     
        return $pdf->stream('reporteProductos.pdf');
      
    }
}
