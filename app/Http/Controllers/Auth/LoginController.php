<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

 //   protected $redirectTo = RouteServiceProvider::Cliente;
 protected $redirectTo;

 protected function redirectTo()
 {
     $user = Auth::user();
 
     if ($user->hasRole('Administrador')) {
         $this->redirectTo = RouteServiceProvider::HOME;
     } elseif ($user->hasRole('Cliente')) {
         $this->redirectTo = RouteServiceProvider::Cliente;
     } 
     elseif ($user->hasRole('Veterinario')) {
        $this->redirectTo = RouteServiceProvider::Veterinario;
    } 
    elseif ($user->hasRole('AdiestradorPeluquero')) {
        $this->redirectTo = RouteServiceProvider::Adiestrador;
    } 
    elseif ($user->hasRole('Recepcionista')) {
        $this->redirectTo = RouteServiceProvider::Recepcionista;
    } 
    elseif ($user->hasRole('AyudanteCirugias')) {
        $this->redirectTo = RouteServiceProvider::AyudanteCirugias;
    } 
     return $this->redirectTo;
 }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

