<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
         //utilizamos user_id de la relacion con articulos
         $mascotas = Mascotas::where('usuario_id', $user->id)
         ->where('estado', 1)
         ->orderBy('id', 'asc')
         ->simplePaginate(10);
         return View('admin.mascotas.index', compact('mascotas'));
    }
    public function inactivos()
    {
           //Mostrar los mascotas registradas en el admin
           $user = Auth::user();
           //utilizamos user_id de la relacion con articulos
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

  

    public function store(Request $request)
    {
       //merge combina los datos que tenemos con los que queremos obtener
       $request->merge([
        //obtenemos los datos de user como su id con Auth
        'usuario_id' => Auth::user()->id,
    ]);
    //Guardando la solicitud en una variable
    $mascotas = $request->all();

         Mascotas::create($mascotas);
        return redirect()->action([MascotasController::class, 'index']);
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
    public function edit($id)
    {
          //llamamos al metodo creado en el policy
         // $this->authorize('view', $mascotas);
    /*      $mascotas = Mascotas::select(['id', 'nombre'])
              ->where('estado', 1)
              ->get();
          return view('admin.mascotas.edit', compact('mascotas'));
    */

          $mascota = Mascotas::findOrFail($id);

          return view('admin.mascotas.edit', compact('mascota'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
    $mascota = Mascotas::findOrFail($id);

    $mascota->fill($request->all());

    $mascota->save();

    return redirect()->route('mascotas.index')
        ->with('success-update', 'Mascota actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mascotas $mascotas, $id)
    {
        //
        
    }
    public function cambiarEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        $mascota->estado = 0;
        $mascota->save();

        return redirect()->route('mascotas.index')->with('success-update', 'Mascota actualizada con éxito');
    }

    public function restablecerEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        $mascota->estado = 0;
        $mascota->save();

        return redirect()->route('mascotas.index')->with('success-update', 'Mascota actualizada con éxito');
    }
}
