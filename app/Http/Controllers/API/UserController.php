<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    /*public function store(Request $request)
    {
    }
    */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $usuario = User::where('email',$email)->first(); 
        if ($usuario) {
            if(Hash::check($password, $usuario->password))
            {
                return response()->json($usuario, 200);
            }
            else
            {
                return response()->json('Credenciales inválidas', 401);
            }

        } else {
            return response()->json('Credenciales inválidas', 401);
        }
    }
    /*
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }*/
}
