<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'ci' => ['required', 'string', 'max:60', 'min:7'],
            'telefono' => ['required', 'string', 'max:20','min:8'],
            'direccion' => ['required', 'string', 'max:255','min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','min:10'],
            'personaResponsable' => ['required', 'string', 'max:60','min:2'],
            'telefonoResponsable' => ['required', 'string', 'max:20','min:10'],         
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'ci' => $data['ci'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'email' => $data['email'],
            'personaResponsable' => $data['personaResponsable'],
            'telefonoResponsable' => $data['telefonoResponsable'],
            
            'password' => Hash::make($data['password']),
        ]);
    }
}
