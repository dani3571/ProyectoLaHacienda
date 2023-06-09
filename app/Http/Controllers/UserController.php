<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use PDF;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  //Proteger las rutas
  public function __construct()
  {
    $this->middleware('can:users.index')->only('index');
    $this->middleware('can:users.edit')->only('edit, update');
    $this->middleware('can:users.cambiar-estado')->only('cambiarEstado');
    $this->middleware('can:users.restablecer-estado')->only('restablecerEstado');
    $this->middleware('can:pdfs')->only('pdfs');
  }
  public function index(Request $request)
  {
          $user = User::where('estado', '1')
          ->with('roles')
          ->simplePaginate(7);
          
      return view('admin.users.index', compact('user'));



    /*
      $query = $request->input('buscadorUsuario');

      $users = User::where('estado', '1');
  
      if ($query) {
          $users->where('nombre', 'LIKE', '%' . $query . '%');
      }
  
      $user = $users->simplePaginate(7);
  
      return view('admin.users.index', compact('user', 'query'));
  */
  /*
    $query = $request->input('query');
    $user = User::where('estado', '1')
      ->where(function ($q) use ($query) {
        $q->where('name', 'LIKE', '%' . $query . '%')
          ->orWhere('email', 'LIKE', '%' . $query . '%');
      })
      ->simplePaginate(7)
      ->appends(['query' => $query]);

    return view('admin.users.index', compact('user', 'query'));
  */
  }

  public function buscarUsuarios(Request $request)
  {
      $query = $request->input('query');
      $user = User::where('estado', '1')
                   ->where(function ($q) use ($query) {
                       $q->where('name', 'LIKE', '%' . $query . '%')
                         ->orWhere('email', 'LIKE', '%' . $query . '%');
                   })
                   ->simplePaginate(7);
  
      // Devolver la vista parcial de la tabla de usuarios
      return view('admin.users.partial.table', compact('user'))->render();
  }
  public function inactivos()
  {
    $user = User::where('estado', '0')->simplePaginate(7);
    return view('admin.users.inactivos', compact('user'));
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */



  public function edit(User $user)
  {
    //recuperar el listado de roles 
    $roles = Role::all();

    return view('admin.users.edit', compact('user', 'roles'));
  }


  public function update(Request $request, User $user)
  {
    //llenar tabla intermedia
    $user->roles()->sync($request->role);
    return redirect()->route('users.edit', $user)
      ->with('success', 'Rol establecido con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();
    return redirect()->action([UserController::class, 'index'])
      ->with('success-delete', 'Usuario eliminado con exito');
  }
  public function cambiarEstado($id)
  {
    $user = User::findOrFail($id);
    $user->estado = 0;
    $user->save();

    $userADMIN = Auth::user();
    $logMessage = 'El usuario [' . $userADMIN->name . '] ha cambiado el estado a INACTIVO al usuario [' . $user->name . ']';
    Log::build([
      'driver' => 'single',
      'path' => storage_path('logs/admin.log'),
    ])->info($logMessage);

    return redirect()->route('users.index')->with('success', 'Modificacion de estado realizado con exito');
  }
  public function restablecerEstado($id)
  {
    $user = User::findOrFail($id);
    $user->estado = 1;
    $user->save();

    $userADMIN = Auth::user();
    $logMessage = 'El usuario [' . $userADMIN->name . '] ha cambiado el estado a ACTIVO al usuario [' . $user->name . ']';
    Log::build([
      'driver' => 'single',
      'path' => storage_path('logs/admin.log'),
    ])->info($logMessage);

    return redirect()->route('users.inactivos')->with('success', 'Usuario restablecido con éxito');
  }

  public function getPDFusuarios(Request $request)
  {
    $user = Auth::user();
    $name = $user->name;
    $nombreSistema = "SISTEMA GENESIS";
    $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
    // Obtener la hora actual
    $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
    $user = User::all();
    $fechaInicio = $request->input('fechaInicio');
    $fechaFin = $request->input('fechaFin');

    $view = view('admin.users.reporte', compact('name', 'user', 'nombreSistema', 'fecha', 'hora'));
    // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
    if ($fechaInicio && $fechaFin) {
      $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
    }
    // Generar el PDF con la vista del reporte
    $pdf = PDF::loadHTML($view);

    return $pdf->stream('Reporte_Usuarios.pdf');
  }



  public function detalleMascotas($id)
  {
    $usuario = User::findOrFail($id);
   // $mascotas = Mascotas::where('usuario_id', $id)->simplePaginate(2);
   $mascotas = Mascotas::join('users', 'mascotas.usuario_id', '=', 'users.id')
   ->select('mascotas.*', 'users.personaResponsable as persona_referencia', 'users.telefonoResponsable')
   ->where('usuario_id', $id)
   ->simplePaginate(2);
    return view('admin.users.detalleMascotas', compact('mascotas', 'usuario'));
  }
}
