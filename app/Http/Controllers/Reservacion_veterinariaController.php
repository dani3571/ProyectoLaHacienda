<?php

namespace App\Http\Controllers;

use App\Models\ReservacionVeterinaria;
use App\Models\Mascotas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Reservacion_veterinariaRequest;
use Spatie\Permission\Models\Role ;
use PDF;
use Illuminate\Support\Facades\Log;


class Reservacion_veterinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('can:reservas_veterinaria.index')->only('index');
        $this->middleware('can:reservas_veterinaria.create')->only('create', 'store');
        $this->middleware('can:reservas_veterinaria.canceladas')->only('canceladas');
        $this->middleware('can:reservas_veterinaria.completadas')->only('completadas');
        $this->middleware('can:reservas_veterinaria.edit')->only('edit', 'update');
        $this->middleware('can:reservas_veterinaria.cancelar')->only('cancelar');
     }
    public function index()
    {
        $reservaciones_pasadas = ReservacionVeterinaria::where('usuario_id', Auth::user()->id)
            ->where('estado', 1)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaRecepcion', '<=', now()->format('H:i'))
            ->get();
        foreach($reservaciones_pasadas as $reserva){
            $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($reserva->id);
            //modificamos el estado a 2
            $reservacion_veterinaria->estado = 2;
            //Guardamos el registro a la BD
            $reservacion_veterinaria->save();
        }
        
        $reservas_veterinaria = ReservacionVeterinaria::where('estado', 1)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplePaginate(10);

        $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
        
        $users = User::select(['id', 'name'])
            ->get();

            return view('admin.reservas_veterinaria.index', compact('reservas_veterinaria', 'mascotas', 'users'));

    }

    public function create()
    {
        $reservas_veterinaria = ReservacionVeterinaria::where('estado', 1)
        ->get();
        
        $mascotas = Mascotas::select(['id', 'nombre', 'usuario_id'])
            ->get();

        $users = User::select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.reservas_veterinaria.create', compact('reservas_veterinaria', 'mascotas', 'users'));
    }

    public function createCLI()
    {
        $reservas_veterinaria = ReservacionVeterinaria::where('estado', 1)
        ->get();
        
        $mascotas = Mascotas::select(['id', 'nombre', 'usuario_id'])
            ->where('usuario_id', Auth::user()->id)
            ->get();
        
        $user = Auth::user();
            
        return view('admin.reservas_veterinaria.createCLI', compact('reservas_veterinaria', 'mascotas','user'));
    }

    public function indexCLI()
    {
        $user = Auth::user();
        $reservaciones_pasadas = ReservacionVeterinaria::where('estado', 1) 
            ->where('usuario_id', Auth::user()->id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaRecepcion', '<=', now()->format('H:i'))
            ->get();
        foreach($reservaciones_pasadas as $reserva){
            $reservas_veterinaria = ReservacionVeterinaria::findOrFail($reserva->id);
            //modificamos el estado a 2
            $reservas_veterinaria->estado = 2;
            //Guardamos el registro a la BD
            $reservas_veterinaria->save();
        }
        
        $reservas_veterinaria = ReservacionVeterinaria::where('estado', 1)
            ->where('usuario_id', Auth::user()->id)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplepaginate(10);
        
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
        
        return view('admin.reservas_veterinaria.indexCLI', compact('reservas_veterinaria', 'mascotas','user'));

    }
    public function store(Reservacion_veterinariaRequest $request)
    {
        $reservas_veterinaria = ReservacionVeterinaria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('estado', 1)
        ->first();
        if ($reservas_veterinaria === null) {
            //merge combina los datos que tenemos con los que queremos obtener
            /*$request->merge([
                //obtenemos los datos de user como su id con Auth
                'usuario_id' => Auth::user()->id
            ]);*/
            //Guardando la solicitud en una variable
            $reservacion_veterinaria = $request->all();

            ReservacionVeterinaria::create($reservacion_veterinaria);
            //return redirect()->action([Reservacion_veterinariaController::class, 'index']);
            //return redirect()->route('reservas_veterinaria.index')->with('success', 'Reserva registrada con éxito');
            

            // Redireccionar o mostrar un mensaje de éxito
            //return redirect()->route('ReservacionVeterinaria.index')->with('success', 'Reserva registrada con éxito');
            // Redireccionar o mostrar un mensaje de éxito
            // Obtener la URL de la página anterior
            $previousUrl = url()->previous();

            // Verificar la URL de la página anterior y redireccionar según corresponda
            if (strpos($previousUrl, 'createCLI') !== false) {
                // Redireccionar a la página createCLI
                return redirect()->route('reservas_veterinaria.indexCLI')->with('success', 'Reserva registrada con éxito');
            } elseif (strpos($previousUrl, 'create') !== false) {
                // Redireccionar a la página create
                return redirect()->route('reservas_veterinaria.index')->with('success', 'Reserva registrada con éxito');
            } else {
                // Redireccionar a una página predeterminada en caso de no coincidir con las anteriores
                return redirect()->route('reservas_veterinaria.index')->with('success', 'Reserva registrada con éxito');
            }
        }
        //else return redirect()->route('reservas_veterinaria.create')->with('fail', 'Horario no disponible, por favor elija otro');
        else {
            return back()->with('fail', 'Horario no disponible, por favor elija otro');
        }
        
    }

    public function edit($id)
    {
        //devolvemos a la vista admin.reservas_veterinaria.edit
        $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($id);
        $reservas_veterinaria = ReservacionVeterinaria::where('estado', 1)
            ->get();
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('usuario_id', $reservacion_veterinaria->usuario_id )
            ->get();
        return view('admin.reservas_veterinaria.edit', compact('reservacion_veterinaria', 'mascotas','reservas_veterinaria'));
    }

    public function update(Reservacion_veterinariaRequest $request, $id)
    {
        $reservas_veterinaria = ReservacionVeterinaria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('id', '!=', $request->id)
        ->where('estado', 1)
        ->first();
        if ($reservas_veterinaria === null) {
            $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($id);
            $reservacion_veterinaria->fill($request->all());
            //guardamos la informacion actualizada
            $reservacion_veterinaria->save();
            //mostramos un mensaje de exito 
            return redirect()->route('reservas_veterinaria.index')->with('success', 'Reserva actualizada con éxito');
        }
        else return redirect()->route('reservas_veterinaria.edit', $id)->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function cancelar(Request $request)
    {
        $reservacion_veterinaria = ReservacionVeterinaria::findOrFail($request->Reserva_id);
        //modificamos el estado a 0
        $reservacion_veterinaria->estado = 0;
        //Guardamos el registro a la BD
        $reservacion_veterinaria->save();

        return redirect()->route('reservas_veterinaria.index')->with('success', 'Su reserva fue cancelada');
    }

    public function canceladas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_veterinaria = ReservacionVeterinaria::where('usuario_id', Auth::user()->id)
            ->where('estado', 0)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservas_veterinaria.canceladas', compact('reservas_veterinaria'));
    }

    public function completadas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_veterinaria = ReservacionVeterinaria::where('usuario_id', Auth::user()->id)
            ->where('estado', 2)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
        return View('admin.reservas_veterinaria.completadas', compact('reservas_veterinaria'));
    }

    public function reservas_veterinaria_PDF(Request $request)
    {
        $user = Auth::user();
        $name = $user->name;
        $nombreSistema = "SISTEMA GENESIS";
        $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Obtener la hora actual
        $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
        $reservas_veterinaria = ReservacionVeterinaria::where('estado', 2)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->get();
        $mascotas = Mascotas::select(['id', 'nombre'])
        ->get();
        $users = User::select(['id', 'name'])
            ->get();
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        $view = view('admin.reservas_veterinaria.reporte', compact('name', 'reservas_veterinaria', 'mascotas', 'users', 'nombreSistema', 'fecha', 'hora'));
         // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
        if ($fechaInicio && $fechaFin) {
        $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
        }
        // Generar el PDF con la vista del reporte
        $pdf = PDF::loadHTML($view);
  
        return $pdf->stream('Reporte_Reservas_completadas.pdf');
    }
}
