@extends('layouts.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login/css/login.css') }}" rel="stylesheet" type="text/css">
@endsection
<!--Asignamos el yield de title-->
@section('title', 'Crear cuenta')
@section('content')
    <form method="POST" class="form" action="{{ route('register') }}" novalidate>
        @csrf
        <h2>Crear cuenta</h2>
            <div class="content-login">
                <div class="input-content">
                    <!--Uitlizamos old para mantener el nombre en caso exista un error en la contraseña-->
                    <input type="text" name="name" placeholder="Nombre completo" value="{{ old('name') }}"
                        autofocus>
                    @error('name')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="input-content">
                    <input type="text" name="ci" placeholder="Carnet de identidad" value="{{ old('ci') }}"
                        autofocus>

                    @error('ci')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>


                <div class="input-content">
                    <input type="text" name="telefono" placeholder="Numero de telefono" value="{{ old('telefono') }}"
                        autofocus>

                    @error('telefono')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>


                <div class="input-content">
                    <input type="text" name="direccion" placeholder="Direccion" value="{{ old('direccion') }}"
                        autofocus>

                    @error('direccion')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror

                </div>

                <div class="input-content">
                    <input type="text" name="email" placeholder="Correo eléctronico" value="{{ old('email') }}"
                        autofocus>

                    @error('email')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror

                </div>

                <div class="input-content">
                    <input type="text" name="personaResponsable" placeholder="Nombre de referencia" value="{{ old('personaResponsable') }}"
                        autofocus>

                    @error('personaResponsable')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="input-content">
                    <input type="text" name="telefonoResponsable" placeholder="Telefono de referencia" value="{{ old('telefonoResponsable') }}"
                        autofocus>

                    @error('telefonoResponsable')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                
                <div class="input-content">
                    <input type="password" name="password" placeholder="Contraseña">
        
                    @error('password')
                        <span class="alert-red">
                            <span>{{$message}}</span>
                        </span>
                   @enderror
        
                </div>
                <div class="input-content">
                    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña">
                </div>
            </div>
            <input type="submit" value="Registrarse" class="button">
            <p>¿Ya tienes una cuenta? <a href="{{route('login')}}" class="link">Iniciar sesión</a></p>
    </form>
    
@endsection
