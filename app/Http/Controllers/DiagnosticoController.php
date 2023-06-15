<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use Illuminate\Http\Request;
use App\Http\Requests\DiagnosticoRequest;
use App\Models\Mascotas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnostico::simplePaginate(10);

        $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
            ->get();

        return view('admin.diagnostico.index', compact('diagnosticos'))
            ->with('mascotas', $mascotas);
    }

    public function create()
    {
        $diagnosticos = Diagnostico::all();

        $users = User::select(['id', 'name', 'direccion'])
            ->orderBy('name', 'asc')
            ->get();

        $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
            ->get();

        return view('admin.diagnostico.create', compact('diagnosticos'))
            ->with('users', $users)
            ->with('mascotas', $mascotas);
    }

    public function store(DiagnosticoRequest $request)
    {
        $diagnostico = $request->all();

        Diagnostico::create($diagnostico);

        $user = Auth::user();
        $logMessage = 'El usuario [' . $user->name . '] ha creado el diagnóstico [' . $request->nombre_diagnostico . ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);

        return redirect()->action([DiagnosticoController::class, 'index']);
    }

    public function show($id)
    {
        $diagnostico = Diagnostico::findOrFail($id);

        return view('admin.diagnostico.show', compact('diagnostico'));
    }

    public function edit($id)
    {
        $diagnostico = Diagnostico::findOrFail($id);
        
        $users = User::select(['id', 'name','direccion'])
            ->orderBy('name', 'asc')
            ->get();

        $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
            ->get(); 

        return view('admin.diagnostico.edit', compact('diagnostico'))
        -> with ('users', $users)
        -> with ('mascotas', $mascotas);
    }

    public function update(DiagnosticoRequest $request, $id)
    {
        $diagnostico = Diagnostico::findOrFail($id);

        $diagnostico->fill($request->all());

        $diagnostico->save();

        return redirect()->route('diagnostico.index')
            ->with('success-update', 'Diagnóstico actualizado con éxito');
    }

    /*public function destroy($id)
    {
        $diagnostico = Diagnostico::findOrFail($id);
        $diagnostico->delete();

        return redirect()->route('diagnostico.index')->with('success-update', 'Diagnóstico eliminado con éxito');
    }

    public function desactivar(Request $request)
    {
        $diagnostico = Diagnostico::findOrFail($request->Habi_id);
        $diagnostico->estado = 0;
        $diagnostico->save();

        return redirect()->route('diagnostico.desactivados')->with('success-update', 'Diagnóstico desactivado con éxito');
    }

    public function desactivados(Request $request)
    {
        $diagnosticos = Diagnostico::simplePaginate(10)->where('estado', 0);

        return view('admin.diagnostico.desactivados', compact('diagnosticos'));
    }

    public function reactivar(Request $request)
    {
        $diagnostico = Diagnostico::findOrFail($request->Habi_id);
        $diagnostico->estado = 1;
        $diagnostico->save();

        return redirect()->route('diagnostico.index')->with('success-update', 'Diagnóstico restablecido con éxito');
    }*/
}
