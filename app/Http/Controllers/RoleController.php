<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use PDF;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::simplePaginate(10)
        ->where('estado','1');

        return view('admin.roles.index', compact('roles'));
    }
    public function inactivos()
    {
        $roles = Role::simplePaginate(10)
        ->where('estado','0');

        return view('admin.roles.inactivos', compact('roles'));
       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return   view('admin.roles.create', compact('permissions'));
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
            'name' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->permissions()->sync($request->permissions);

        return redirect()->action([RoleController::class, 'index'])
            ->with('success', 'Rol creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return   view('admin.roles.edit', compact('permissions', 'role'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role->update([
            'name' => $request->name,
        ]);
        $role->permissions()->sync($request->permissions);

        return redirect()->action([RoleController::class, 'index'])
            ->with('success', 'Rol modificado con exito');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
       $role->delete();
       return redirect()->action([RoleController::class, 'index'])
       ->with('success', 'Rol eliminado con exito');
    }


    public function cambiarEstado($id)
    {
        $role = Role::findOrFail($id);
        $role->estado = 0;
        $role->save();
        return redirect()->route('roles.index')->with('success', 'Eliminacion logica realizada con exito');
    }
    public function restablecerEstado($id)
    {
        $role = Role::findOrFail($id);
        $role->estado = 1;
        $role->save();
        return redirect()->route('roles.inactivos')->with('success', 'Rol restablecido con éxito');
           
    }
    public function getPDFRole(){
        $user = Auth::user();
		$name = $user->name;
        $role = Role::all();
		$pdf = PDF::loadView('admin.roles.reportes', compact('name', 'role'));
		return $pdf->stream('prueba.pdf');
	}
  
  

}
