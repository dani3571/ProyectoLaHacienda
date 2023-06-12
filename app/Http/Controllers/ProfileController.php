<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /*public function __construct()
    {
        //si el usuario trata de ingresar a la vista de edit y no esta logueado que lo mande a la pagina de inicio de sesion
        $this->middleware('auth');
    }*/
 
  //Profile $profile
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('subscriber.profiles.edit', compact('profile'));
    }

 
    public function update(ProfileRequest $request, Profile $profile)
    {
    //   $this->authorize('update', $profile);
        $user = Auth::user();
     
        //Si encuentra una foto que elimine la anterior y asigne la nueva
        if ($request->hasFile('photo')) {
            //Eliminar foto anterior 
            File::delete(public_path('storage/' . $profile->photo));
            //Asignar nueva foto
            $photo = $request['photo']->store('profiles');
        } else { 
            //si no tiene foto que se quede con la actual
            $photo = $user->profile->photo;
        }
    

        //Asignar nombre y correo
        $user->name = $request->name;
        $user->ci = $request->ci;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->email = $request->email;
        $user->personaResponsable = $request->personaResponsable;
        $user->telefonoResponsable = $request->telefonoResponsable;
    
        //Asignamos la foto
        $user->profile->photo = $photo;
        //Guardar campos de usuario
      //ojo
      //aunque de error funciona
        $user->save();

        //Guardar campos de perfil
        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);
    }

   
}
