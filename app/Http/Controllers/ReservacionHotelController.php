<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\ReservacionHotel;
use Illuminate\Http\Request;
use App\Http\Requests\ReservacionHotelRequest;
//use Spatie\Permission\Models\ReservacionHotel;



class ReservacionHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservacionHotel = ReservacionHotel::simplePaginate(10);

        return view('admin.reservacionHotel.index', compact('reservacionHotel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservacionHotel = Permission::all();

        return   view('admin.reservacionHotel.create', compact('reservacionHotel'));
    }

    public function store(ReservacionHotelRequest $request)
    {
       //merge combina los datos que tenemos con los que queremos obtener
       //$request->merge([
        //obtenemos los datos de user como su id con Auth
        //'usuario_id' => Auth::user()->id,
    //]);
    //Guardando la solicitud en una variable
    $reservacionHotel = $request->all();

         ReservacionHotel::create($reservacionHotel);
        return redirect()->action([ReservacionHotelController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservacionHotel  
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservacionHotel = reservacionHotel::findOrFail($id);

        return view('admin.reservacionHotel.show', compact('reservacionHotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservacionHotel  
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

          $reservacionHotel = reservacionHotel::findOrFail($id);

          return view('admin.reservacionHotel.edit', compact('reservacionHotel'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservacionHotel  $mascotas
     * @return \Illuminate\Http\Response
     */

     public function update(ReservacionHotelRequest $request, $id)
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
     $reservacionHotel = ReservacionHotel::findOrFail($id);
 
     $reservacionHotel->fill($request->all());
 
     $reservacionHotel->save();
 
     return redirect()->route('reservacionHotel.index')
         ->with('success-update', 'Reservación actualizada con éxito');
     }



     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservacionHotel = ReservacionHotel::findOrFail($id);
        $reservacionHotel->delete();
        return redirect()->route('reservacionHotel.index')->with('success-update', 'Reservación eliminada con exito');
        //return redirect()->route('reservacionHotel.inactivos')->with('success-update', 'Reservación eliminada con exito');
    }
    /*
    public function cambiarEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        $mascota->estado = 0;
        $mascota->save();

        return redirect()->route('mascotas.index')->with('success-update', 'Eliminacion logica realizada con exito');
    }

    public function restablecerEstado($id)
    {
        $mascota = Mascotas::findOrFail($id);
        $mascota->estado = 1;
        $mascota->save();

        return redirect()->route('mascotas.inactivos')->with('success-update', 'Mascota restablecida con éxito');
    }
    */
}