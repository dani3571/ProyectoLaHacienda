<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role ;
use PDF;
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
      $this->middleware('can:users.edit')->only('edit');
      $this->middleware('can:users.getPDFusuarios')->only('getPDFusuarios');
    }
    public function index()
    {
      $user = User::where('estado', '1')->paginate(10);
     
      return view('admin.users.index', compact('user'));
    }
    
    public function inactivos()
    {
        $user = User::simplePaginate(10)
        ->where('estado','0');
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
      return redirect()->action([UserController::class,'index'])
                       ->with('success-delete', 'Usuario eliminado con exito');
    }
    public function cambiarEstado($id)
    {
        $user = User::findOrFail($id);
        $user->estado = 0;
        $user->save();
        return redirect()->route('users.index')->with('success', 'Modificacion de estado realizado con exito');
    }
    public function restablecerEstado($id)
    {
        $user = User::findOrFail($id);
        $user->estado = 1;
        $user->save();
        return redirect()->route('users.inactivos')->with('success', 'Usuario restablecido con éxito');
           
    }

    public function getPDFusuarios(Request $request){
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

    public function buscarUsuarios(Request $request)
    {
        $query = $request->query('query');
        // Realiza la búsqueda de usuarios según el criterio de búsqueda
        $usuarios = User::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($usuarios);
    }

    public function detalleMascotas($id){
      $usuario = User::findOrFail($id);
      $mascotas = Mascotas::where('usuario_id', $id)->get();
      return view('admin.users.detalleMascotas', compact('mascotas','usuario'));

    }

}
