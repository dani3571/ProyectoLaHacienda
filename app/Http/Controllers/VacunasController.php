<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Vacunas;
use Illuminate\Http\Request;
use App\Http\Requests\VacunasRequest;
//use Spatie\Permission\Models\Vacunas;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Log;
use App\Models\Mascotas;
use App\Models\User;


class VacunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

    }
    public function index()
    {
        $vacunas = Vacunas::simplePaginate(10);

        $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
            ->get();
        //->where('estado', 1);

        return view('admin.vacunas.index', compact('vacunas'))
        -> with ('mascotas', $mascotas);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vacunas = Vacunas::all();
        
        $users = User::select(['id', 'name','direccion'])
            ->orderBy('name', 'asc')
            ->get();

        $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
            ->get();    

        return   view('admin.vacunas.create', compact('vacunas'))
        -> with ('users', $users)
        -> with ('mascotas', $mascotas);
    }

    public function store(VacunasRequest $request)
    {
        $vacuna = $request->all();

        Vacunas::create($vacuna);
        $user = Auth::user();
        $logMessage = 'El usuario ['.$user->name.'] ha creado la vacuna [' .$request->nombre_vacuna. ']';
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/admin.log'),
        ])->info($logMessage);
        return redirect()->action([VacunasController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacunas  
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacuna = Vacunas::findOrFail($id);

        return view('admin.vacunas.show', compact('vacuna'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacunas  
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $vacuna = Vacunas::findOrFail($id);

          $mascotas = Mascotas::select(['id', 'nombre', 'peso', 'tamaño', 'tipo', 'usuario_id'])
            ->get();  

          return view('admin.vacunas.edit', compact('vacuna'))
          -> with ('mascotas', $mascotas);;
    
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacunas  $mascotas
     * @return \Illuminate\Http\Response
     */

     public function update(VacunasRequest $request, $id)
     {
     $vacuna = Vacunas::findOrFail($id);
 
     $vacuna->fill($request->all());
 
     $vacuna->save();
 
     return redirect()->route('vacunas.index')
         ->with('success-update', 'Vacuna con éxito');
     }



     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        $vacuna = Vacunas::findOrFail($id);
        $vacuna->delete();
        return redirect()->route('vacunas.index')->with('success-update', 'Reservación eliminada con exito');
    }

    public function desactivar(Request $request)
    {
        $vacuna = Vacunas::findOrFail($request->Habi_id);
        $vacuna->estado = 0;
        $vacuna->save();

        return redirect()->route('vacunas.desactivadas')->with('success-update', 'Vacuna desactivada con éxito');
    }

    public function desactivadas(Request $request)
    {
        $vacunas = Vacunas::simplePaginate(10)
        ->where('estado', 0);

        return view('admin.vacunas.desactivadas', compact('vacunas'));
    }

    public function reactivar(Request $request)
    {
        $vacuna = Vacunas::findOrFail($request->Habi_id);
        $vacuna->estado = 1;
        $vacuna->save();

        return redirect()->route('vacunas.index')->with('success-update', 'Vacuna restablecida con éxito');
    }*/
}