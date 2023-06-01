<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $usersWithRoleName = $users->map(function ($user) {
            $user->role_name = $user->roles->pluck('name')->first();
            return $user;
        });
        return response()->json($users);
    }
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    public function create(Request $request)
    {
        $usuario = User::create([
            'name' => $request->input('name'),
            'ci' => $request->input('ci'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'email' => $request->input('email'),
            'personaResponsable' => $request->input('personaResponsable'),
            'telefonoResponsable' => $request->input('telefonoResponsable'),
            'password' => Hash::make($request->input('password'),),
        ]);
        if ($usuario) {
            return response()->json($usuario, 201);
        } else {
            return response()->json(['error' => 'No se pudo crear el usuario'], 500);
        }
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $usuario = User::where('email',$email)->first(); 
        if ($usuario) {
            if(Hash::check($password, $usuario->password))
            {
                $users = User::with('roles')->where('.id',$usuario->id)->get();
                $usersWithFirstRole = $users->map(function ($user) {
                    $user['role_name'] = $user->roles->first()->name;
                    unset($user['roles']);
                    return $user;
                });
                return response()->json($usersWithFirstRole[0], 200);
            }
            else
            {
                return response()->json('Credenciales inválidas', 401);
            }

        } else {
            return response()->json('Credenciales inválidas', 401);
        }
    }
}
