<?php

namespace App\Http\Controllers;

use App\Models\ReservacionPeluqueria;
use App\Models\Mascotas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Reservacion_peluqueriaRequest;
use Spatie\Permission\Models\Role ;
use PDF;
use Illuminate\Support\Facades\Log;


class Reservacion_peluqueriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('can:reservas_peluqueria.index')->only('index');
        
        $this->middleware('can:reservas_peluqueria.edit')->only('edit');
     }
    public function index()
    {
        $reservaciones_pasadas = ReservacionPeluqueria::where('estado', 1) 
            //->where('usuario_id', Auth::user()->id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaEntrega', '<=', now()->format('H:i'))
            ->get();
        foreach($reservaciones_pasadas as $reserva){
            $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($reserva->id);
            //modificamos el estado a 2
            $reservacion_peluqueria->estado = 2;
            //Guardamos el registro a la BD
            $reservacion_peluqueria->save();
        }
        
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 1)
            //->where('usuario_id', Auth::user()->id)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplepaginate(10);
        
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
        
        $users = User::select(['id', 'name'])
            ->get();

        return view('admin.reservas_peluqueria.index', compact('reservas_peluqueria', 'mascotas', 'users'));
    }

    public function reservas_CLI()
    {
        $reservaciones_pasadas = ReservacionPeluqueria::where('estado', 1) 
            //->where('usuario_id', Auth::user()->id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            //->where('horaEntrega', '<=', now()->format('H:i'))
            ->get();
        foreach($reservaciones_pasadas as $reserva){
            $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($reserva->id);
            //modificamos el estado a 2
            $reservacion_peluqueria->estado = 2;
            //Guardamos el registro a la BD
            $reservacion_peluqueria->save();
        }
        
        $reservas_activas = ReservacionPeluqueria::where('estado', 1)
            ->where('usuario_id', Auth::user()->id)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplepaginate(3);
        
        $reservas_completadas = ReservacionPeluqueria::where('estado', 2)
            ->where('usuario_id', Auth::user()->id)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplepaginate(3);

        $reservas_canceladas = ReservacionPeluqueria::where('estado', 0)
            ->where('usuario_id', Auth::user()->id)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplepaginate(3);

        $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
        
        return view('admin.reservas_peluqueria.reservas_CLI', compact('reservas_activas', 'reservas_completadas', 'reservas_canceladas', 'mascotas'));
    }

    public function create()
    {
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 1)
        ->get();
        
        $mascotas = Mascotas::select(['id', 'nombre', 'usuario_id'])
            ->get();
        
        $users = User::select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();
            
        return view('admin.reservas_peluqueria.create', compact('reservas_peluqueria', 'mascotas', 'users'));
    }

    public function create_CLI()
    {
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 1)
        ->get();
        
        $mascotas = Mascotas::select(['id', 'nombre', 'usuario_id'])
            ->where('usuario_id', Auth::user()->id)
            ->get();
        
        $user = Auth::user();
            
        return view('admin.reservas_peluqueria.create_CLI', compact('reservas_peluqueria', 'mascotas', 'user'));
    }

    public function store(Reservacion_peluqueriaRequest $request)
    {
        

        $reservas_peluqueria = ReservacionPeluqueria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('estado', 1)
        ->first();
        
        if ($reservas_peluqueria === null) {
            //Verificamos si el campo Observaciones esta vacio
            if($request->Observaciones === null){
                //merge combina los datos que tenemos con los que queremos obtener
                $request->merge([
                    //Si el campo Observaciones esta vacio entonces
                    //Colocamos ninguna como predeterminado
                    'Observaciones' => "ninguna"
                ]);
            }

            //Guardando la solicitud en una variable
            $reservacion_peluqueria = $request->all();
            
            ReservacionPeluqueria::create($reservacion_peluqueria);

            $cliente = User::findOrFail($request->usuario_id);
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha registrado una nueva reservacion de peluqueria para el cliente [' .$cliente->name. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
            
            return redirect()->route('reservas_peluqueria.index')->with('success', 'Reserva registrada con éxito');
        }
        else return redirect()->route('reservas_peluqueria.create')->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function store_CLI(Reservacion_peluqueriaRequest $request)
    {
        $reservas_peluqueria = ReservacionPeluqueria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('estado', 1)
        ->first();
        
        if ($reservas_peluqueria === null) {
            //Verificamos si el campo Observaciones esta vacio
            if($request->Observaciones === null){
                //merge combina los datos que tenemos con los que queremos obtener
                $request->merge([
                    //Si el campo Observaciones esta vacio entonces
                    //Colocamos ninguna como predeterminado
                    'Observaciones' => "ninguna"
                ]);
            }

            //Guardando la solicitud en una variable
            $reservacion_peluqueria = $request->all();
            
            ReservacionPeluqueria::create($reservacion_peluqueria);

            $cliente = User::findOrFail($request->usuario_id);
            $user = Auth::user();
            $logMessage = 'El cliente ['.$user->name.'] ha registrado una nueva reservacion de peluqueria';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
            
            return redirect()->route('reservas_peluqueria.reservas_CLI')->with('success', 'Reserva registrada con éxito');
        }
        else return redirect()->route('reservas_peluqueria.create_CLI')->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function edit($id)
    {
        //devolvemos a la vista admin.reservas_peluqueria.edit
        $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($id);
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 1)
        ->get();
        $mascotas = Mascotas::select(['id', 'nombre'])
            ->where('usuario_id', $reservacion_peluqueria->usuario_id )
            ->get();
        return view('admin.reservas_peluqueria.edit', compact('reservacion_peluqueria', 'mascotas', 'reservas_peluqueria'));
    }

    public function update(Reservacion_peluqueriaRequest $request, $id)
    {
        $reservas_peluqueria = ReservacionPeluqueria::where('fecha', '=', $request->fecha)
        ->where('horaRecepcion', '=', $request->horaRecepcion)
        ->where('id', '!=', $request->id)
        ->where('estado', 1)
        ->first();
        if ($reservas_peluqueria === null) {
            
            $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($id);

            $cliente = User::findOrFail($request->usuario_id);
            $user = Auth::user();
            $logMessage = 'El usuario ['.$user->name.'] ha modificado una reservacion de peluqueria del cliente [' .$cliente->name. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);
            $reservacion_peluqueria->fill($request->all());
            //guardamos la informacion actualizada
            $reservacion_peluqueria->save();
            //mostramos un mensaje de exito 
            return redirect()->route('reservas_peluqueria.index')->with('success', 'Reserva actualizada con éxito');
        }
        else return redirect()->route('reservas_peluqueria.edit', $id)->with('fail', 'Horario no disponible, por favor elija otro');
    }

    public function cancelar(Request $request)
    {
        $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($request->Reserva_id);
        //modificamos el estado a 0
        $reservacion_peluqueria->estado = 0;
        if($request->motivo != null){
            $reservacion_peluqueria->motivoCancelacion = $request->motivo;
        }
        //Guardamos el registro a la BD
        $reservacion_peluqueria->save();

        $cliente = User::findOrFail($reservacion_peluqueria->usuario_id);
        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha cancelado una reservacion de peluqueria del cliente [' .$cliente->name. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);

        return redirect()->route('reservas_peluqueria.index')->with('success', 'La reserva fue cancelada correctamente');
    }

    public function canceladas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 0)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplePaginate(10);

        $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
    
        $users = User::select(['id', 'name'])
            ->get();
        return View('admin.reservas_peluqueria.canceladas', compact('reservas_peluqueria', 'mascotas', 'users'));
    }

    public function completadas()
    {
        //utilizamos user_id de la relacion con mascotas
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 2)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->simplePaginate(10);

            $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
        
            $users = User::select(['id', 'name'])
            ->get();

        return View('admin.reservas_peluqueria.completadas', compact('reservas_peluqueria', 'mascotas', 'users'));
    }

    public function registrarCosto(Request $request)
    {
        $reservacion_peluqueria = ReservacionPeluqueria::findOrFail($request->Reserva_id);
        $cliente = User::findOrFail($reservacion_peluqueria->usuario_id);
        $user = Auth::user();
        if($request->confirmacion == 1){
            //resgitramos el costo
            $reservacion_peluqueria->costo = $request->costo;
            //Guardamos
            $reservacion_peluqueria->save();

            $logMessage = 'El usuario ['.$user->name.'] ha resgistrado el costo de una reservacion de peluqueria del cliente [' .$cliente->name. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);

            return redirect()->route('reservas_peluqueria.completadas')->with('success', 'Se registro el costo correctamente');
        }else{
            //modificamos el estado a 0
            $reservacion_peluqueria->estado = 0;
            if($request->Observaciones != null){
                $reservacion_peluqueria->motivoCancelacion = $request->motivo;
            }
            //Guardamos el registro en la BD
            $reservacion_peluqueria->save();
            
            $logMessage = 'El usuario ['.$user->name.'] ha cancelado una reservacion de peluqueria del cliente [' .$cliente->name. ']';
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/admin.log'),
            ])->info($logMessage);

            return redirect()->route('reservas_peluqueria.completadas')->with('success', 'La reserva fue cancelada correctamente');
        }
    }

    public function getPDFpeluqueria(Request $request){
        $user = Auth::user();
        $name = $user->name;
        $nombreSistema = "SISTEMA GENESIS";
        $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Obtener la hora actual
        $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
        $reservas_peluqueria = ReservacionPeluqueria::where('estado', 2)
            ->where('costo', '>', 0)
            ->orderBy('fecha', 'asc')
            ->orderBy('horaRecepcion', 'asc')
            ->get();
        $mascotas = Mascotas::select(['id', 'nombre'])
        ->get();
        $users = User::select(['id', 'name'])
            ->get();
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        $view = view('admin.reservas_peluqueria.reporte', compact('name', 'reservas_peluqueria', 'mascotas', 'users', 'nombreSistema', 'fecha', 'hora'));
         // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
        if ($fechaInicio && $fechaFin) {
        $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
        }
        // Generar el PDF con la vista del reporte
        $pdf = PDF::loadHTML($view);
  
        return $pdf->stream('Reporte_Reservas_completadas.pdf');
    }
}