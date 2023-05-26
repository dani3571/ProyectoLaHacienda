@extends('layouts.base')
@section('styles')
<link rel="stylesheet" href="{{asset('css/login/css/login.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('title','Ingresar')


@section('content')
<form method="POST" class="form" action="{{route('login')}}">
    <!--Definimos el toker de verificacion-->
    @csrf
    <h2>Bienvenido al Sistema <b>"GENESIS"</b></h2>
    
    <br>
    <h2>Iniciar sesión</h2>
   
    <div class="content-login">
        <div class="input-content">
            <input type="text" name="email" placeholder="Correo eléctronico" value="{{old('email')}}" autofocus>
            
            @error('email')
            <span class="alert-red">
                <span>{{$message}}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="password" name="password" placeholder="Contraseña" value="">

            @error('password')
            <span class="alert-red">
                <span>{{$message}}</span>
            </span>
            @enderror


        </div>
    </div>

    <a href="{{route('password.request')}}" class="password-reset">Olvidé mi contraseña</a>

    <input type="submit" value="Iniciar sesión" class="button">
</form>

<p>¿No tienes una cuenta? <a href="{{route('register')}}" class="link">Crear cuenta</a></p>
@endsection


