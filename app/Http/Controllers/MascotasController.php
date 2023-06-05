<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MascotaRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use HasRole;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
                ->simplePaginate(10);
        } else {
            $mascotas = Mascotas::all()
                ->where('estado', 1);
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
            ->simplePaginate(10);
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
        /*
       
        //Guardando la solicitud en una variable
       $mascotas = $request->all();
   
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('mascotas', 'imagenes');
            $mascotas->image = $path;
        }
        //$mascotas->usuario_id = $request->usuario_id;
*/
        //merge combina los datos que tenemos con los que queremos obtener
        $request->merge([
            //obtenemos los datos de user como su id con Auth
            'usuario_id' => Auth::user()->id,
        ]);
        $mascota = new Mascotas();
        $mascota->fill($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('', 'mascotas');
            $imageName = basename($path);
            $mascota->image = $imageName;
        }
       
        /*
        $image = $request->file('image');
        //   $path = $image->store('public/images/mascotas');
        $path = Storage::disk('mascotas')->putFile('', $image, 'public');
         //  $path = $image->store('images/mascotas', 'public'); 
         $imageName = basename($path);
        
         */
        $mascota->save();

        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha registrado la mascota [' .$mascota->nombre. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);

        // Mascotas::create($mascotas);
        return redirect()->action([MascotasController::class, 'index'])
            ->with('success', 'Mascota registrada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function show(Mascotas $mascotas)
    {
        /*
        $this->authorize('published', $mascotas);
        $comments = $article->comments()->simplePaginate(5);
        return view('subscriber.articles.show', compact('article', 'comments'));
   */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */

    //llamamos al metodo creado en el policy
    // $this->authorize('view', $mascotas);
    /*      $mascotas = Mascotas::select(['id', 'nombre'])
              ->where('estado', 1)
              ->get();
          return view('admin.mascotas.edit', compact('mascotas'));
    */
    /*
             $mascotas->update([
             'nombre' => $request->nombre,
             'tipo' => $request->tipo,
             'raza' => $request->raza,
             'color' => $request->color,
             'fechaNacimiento' => $request->fechaNacimiento,
             'caracter' => $request->caracter,
             'sexo' => $request->sexo,
             'estado' => $request->estado,
             'usuario_id' =>Auth::user()->id,
             

        ]);
        return redirect()->action([MascotasController::class, 'index'])
            ->with('success-update', 'Datos de la mascota modificados con exito');
    
    */


    public function edit($id)
    {
        //devolvemos a la vista admin.mascotas.edit
        $mascota = Mascotas::findOrFail($id);
        return view('admin.mascotas.edit', compact('mascota'));
    }


    public function update(MascotaRequest $request, $id)
    {
        $mascota = Mascotas::findOrFail($id);

        if($request->nombre != $mascota->nombre){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado el nombre de la mascota [' .$mascota->nombre. '] => [' .$request->nombre. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }
        if($request->raza != $mascota->raza){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado la raza de la mascota [' .$request->nombre. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }
        if($request->color != $mascota->color){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado el color de la mascota [' .$request->nombre. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }
        if($request->fechaNacimiento != $mascota->fechaNacimiento){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado la fecha de nacimiento de la mascota [' .$request->nombre. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }
        if($request->caracter != $mascota->caracter){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado el caracter de la mascota [' .$request->nombre. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }
        if($request->sexo != $mascota->sexo){
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado el sexo de la mascota [' .$request->nombre. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
        }
        

        $mascota->fill($request->all());  
        //guardamos la informacion actualizada
        $mascota->save();
        //mostramos un mensaje de exito 
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

    public function cambiarEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        //modificamos el estado a 0
        $mascota->estado = 0;
        //Guardamos el registro a la BD
        $mascota->save();

        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha cambiado el estado a INACTIVO la mascota [' .$mascota->nombre. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);

        return redirect()->route('mascotas.index')->with('success', 'Eliminacion logica realizada con exito');
    }

    public function restablecerEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        //modificamos el estado a 1
        $mascota->estado = 1;
        //Guardamos el registro a la BD
        $mascota->save();

        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha cambiado el estado a ACTIVO la mascota [' .$mascota->nombre. ']';
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
