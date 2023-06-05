<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('can:categorias.index')->only('index');
      $this->middleware('can:categorias.edit')->only('edit');
      $this->middleware('can:categorias.create')->only('create');
      $this->middleware('can:categorias.inactivos')->only('inactivos');
    }




    public function index()
    {
        $categoria = Categorias::where('estado', 1)->get();

        return view('admin.categorias.index', compact('categoria'));
    }

    public function inactivos()
    {
        $categorias = Categorias::where('estado', 0)->get();

        return view('admin.categorias.inactivos', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias.create');
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
        ]);
        
        $categoria = new Categorias;
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha creado la categoria [' .$categoria->nombre. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
        
        return redirect()->route('categorias.index')->with('success', 'Categoría registrada exitosamente');
        
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
        $categoria = Categorias::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
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
        $categoria = Categorias::findOrFail($id);

        if($request->input('nombre') != $categoria->nombre){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado el nombre de la categoria [' .$categoria->nombre. '] => [' .$request->input('nombre'). ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }
        if($request->input('descripcion') != $categoria->descripcion){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado la descripcion de la categoria [' .$request->input('nombre'). ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }

        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        // Actualizar otros campos según sea necesario
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function cambiarEstado($id)
    {
        $categoria = Categorias::findOrFail($id);
        $categoria->estado = 0;
        $categoria->save();

        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha cambiado el estado a INACTIVO la categoria [' .$categoria->nombre. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);

        return redirect()->route('categorias.index')->with('success-update', 'La categoría ha sido eliminada exitosamente');
    }
    public function restablecerEstado($id)
    {
        $categoria = Categorias::findOrFail($id);
        $categoria->estado = 1;
        $categoria->save();

        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha cambiado el estado a ACTIVO la categoria [' .$categoria->nombre. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);

        return redirect()->route('categorias.inactivos')->with('success-update', 'SE PUDO RESTABLECER CON ÉXITO');
    }


}
