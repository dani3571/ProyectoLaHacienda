<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Models\Mascotas;
use App\Models\User;
use App\Http\Requests\ReportesRequest;
use App\Models\Proveedores;
use App\Models\ReservacionPeluqueria;
use App\Models\Ventas;

class ReportesController extends Controller
{
    public function index()
    {
        return view('admin.Reportes.index');
    }

    public function generarReporte(ReportesRequest $request)
    {
        $user = Auth::user();
        $name = $user->name;
        $nombreSistema = "SISTEMA GENESIS";
        $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Obtener la hora actual


        $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
        $tipo = $request->input('tipo');
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');


        //user condicional
        if ($tipo == "users") {
            $user = User::all()
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
            // Cargar la vista del reporte
            $view = view('admin.users.reporte', compact('name', 'nombreSistema', 'fecha', 'hora', 'user', 'fechaInicio', 'fechaFin'));
            // Generar el PDF con la vista del reporte
            $pdf = PDF::loadHTML($view);
            // Descargar o mostrar el PDF en el navegador
            return $pdf->stream('Reporte_Usuarios.pdf');
        }
        //mascotas condicional
        if ($tipo == "mascotas") {
            $mascotas = Mascotas::all()
                ->where('estado', 1)
                ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
      
            // Cargar la vista del reporte
            $view = view('admin.mascotas.reporte', compact('name', 'nombreSistema', 'fecha', 'hora', 'mascotas', 'fechaInicio', 'fechaFin'));

            // Generar el PDF con la vista del reporte
            $pdf = PDF::loadHTML($view);

            // Descargar o mostrar el PDF en el navegador
            return $pdf->stream('reporte.pdf');
        }
        //roles condicional
        if ($tipo == "roles") {
            $role = User::all()
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
            // Cargar la vista del reporte
            $view = view('admin.roles.reportes', compact('name', 'nombreSistema', 'fecha', 'hora', 'role', 'fechaInicio', 'fechaFin'));
            // Generar el PDF con la vista del reporte
            $pdf = PDF::loadHTML($view);
            // Descargar o mostrar el PDF en el navegador
            return $pdf->stream('Reporte_Roles.pdf');
        }

        if ($tipo == "ventas") {
            $ventas = Ventas::all()
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
            // Cargar la vista del reporte
            $view = view('admin.ventas.reporte', compact('name', 'nombreSistema', 'fecha', 'hora', 'ventas', 'fechaInicio', 'fechaFin'));
            // Generar el PDF con la vista del reporte
            $pdf = PDF::loadHTML($view);
            // Descargar o mostrar el PDF en el navegador
            return $pdf->stream('Reporte_Ventas.pdf');
        }
        
        if ($tipo == "proveedores") {
            $proveedores = Proveedores::all()
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
            // Cargar la vista del reporte
            $view = view('admin.proveedores.reporte', compact('name', 'nombreSistema', 'fecha', 'hora', 'proveedores', 'fechaInicio', 'fechaFin'));
            // Generar el PDF con la vista del reporte
            $pdf = PDF::loadHTML($view);
            // Descargar o mostrar el PDF en el navegador
            return $pdf->stream('Reporte_Proveedores.pdf');
        }

        if($tipo == "reservacion_peluquerias")
        {
            $reservas_peluqueria = ReservacionPeluqueria::all();
            $users = User::select(['id', 'name'])
            ->get();
            $mascotas = Mascotas::select(['id', 'nombre'])
            ->get();
            $fechaInicio = $request->input('fechaInicio');
            $fechaFin = $request->input('fechaFin');
            $view = view('admin.reservas_peluqueria.reporte', compact('name', 'reservas_peluqueria', 'reservas_peluqueria', 'mascotas','users', 'nombreSistema', 'fecha', 'hora'));
             // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
            if ($fechaInicio && $fechaFin) {
            $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
            }
            // Generar el PDF con la vista del reporte
            $pdf = PDF::loadHTML($view);
      
            return $pdf->stream('Reporte_Reservas_completadas.pdf');
    

        }
    }
    
   
}
