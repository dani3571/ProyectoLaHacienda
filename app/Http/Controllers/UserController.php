<?php

namespace App\Http\Controllers;

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
    public function index()
    {
      $user = User::simplePaginate(10);
      return view('admin.users.index', compact('user'));
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
                        ->with('success-update', 'Rol establecido con éxito');
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

    public function getPDFusuarios(){
      $user = Auth::user();
      $name = $user->name;
      $user = User::all();
      $pdf = PDF::loadView('admin.users.reporte', compact('name', 'user'));
      return $pdf->stream('Reporte_Usuarios.pdf');
}

}
