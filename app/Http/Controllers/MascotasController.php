<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MascotaRequest;
use App\Http\Requests\ProfileRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use HasRole;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resp onse
     */
    public function index()
    {
        //Mostrar los mascotas registradas en el admin
        $user = Auth::user();
        //utilizamos user_id de la relacion con mascotas
        if (Auth()->user()->hasRole('Cliente')) {
            $mascotas = Mascotas::where('usuario_id', $user->id)
                ->where('estado', 1)
                ->orderBy('id', 'asc')
                ->simplePaginate(7);
        } else {
            $mascotas = Mascotas::where('estado', 1)
                ->simplePaginate(7);
        }

        return View('admin.mascotas.index', compact('mascotas'));
    }
    public function inactivos()
    {
        //Mostrar los mascotas registradas en el admin
        $user = Auth::user();
        //utilizamos user_id de la relacion con mascotas
        $mascotas = Mascotas::where('usuario_id', $user->id)
            ->where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(7);
        return View('admin.mascotas.inactivos', compact('mascotas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('estado', 1)
            ->get();
        return view('admin.mascotas.create', compact('mascotas'));
    }


    public function store(MascotaRequest $request)
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

        // Mascotas::create($mascotas);
        return redirect()->action([MascotasController::class, 'index'])
            ->with('success', 'Mascota registrada con éxito');
    }





    public function edit($id)
    {
        //devolvemos a la vista admin.mascotas.edit
        $mascota = Mascotas::findOrFail($id);
        return view('admin.mascotas.edit', compact('mascota'));
    }


    public function update(MascotaRequest $request, $id)
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
        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mascota = Mascotas::findOrFail($id);
        //Eliminamos el registro segun la id
        $mascota->delete();
        //mostramos mensaje de exito
        return redirect()->route('mascotas.inactivos')->with('success', 'Registro de mascota eliminada con exito');
    }

    public function cambiarEstado($id){
        $mascota = Mascotas::findOrFail($id);
        //modificamos el estado a 0
        $mascota->estado = 0;
        //Guardamos el registro a la BD
        $mascota->save();
        $user = Auth::user();
        $logMessage = 'El usuario [' . $user->name . '] ha cambiado el estado a INACTIVO la mascota [' . $mascota->nombre . ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
        return redirect()->route('mascotas.index')->with('success', 'Eliminacion logica realizada con exito');
    }
    public function restablecerEstado($id){
        $mascota = Mascotas::findOrFail($id);
        //modificamos el estado a 1
        $mascota->estado = 1;
        //Guardamos el registro a la BD
        $mascota->save();

        $user = Auth::user();
        $logMessage = 'El usuario [' . $user->name . '] ha cambiado el estado a ACTIVO la mascota [' . $mascota->nombre . ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
        return redirect()->route('mascotas.inactivos')->with('success', 'Mascota restablecida con éxito');
    }


    public function getPDF(Request $request)
    {
        $user = Auth::user();
        $name = $user->name;
        $nombreSistema = "SISTEMA GENESIS";
        $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Obtener la hora actual
        $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
        $mascotas = Mascotas::all();
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');

        $view = view('admin.mascotas.reporte', compact('name', 'mascotas', 'nombreSistema', 'fecha', 'hora'));

        // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
        if ($fechaInicio && $fechaFin) {
            $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
        }
        // Generar el PDF con la vista del reporte
        $pdf = PDF::loadHTML($view);

        return $pdf->stream('mascotas.pdf');
    }
}
