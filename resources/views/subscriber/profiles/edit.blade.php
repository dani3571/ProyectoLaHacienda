@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/css/style_profile.css') }}">
  <style>
 .btn-atras{
    background: rgb(21, 110, 178);
    padding: 4px;
    font-size: 1.2em;
    color: white;
    border-radius: 3px;
}
.btn-atrass{
    display: block;
    width: 8%;
    height: 20px;
    margin-left: 30%;
    margin-top: 0.5%;
}

  </style>
@endsection
@section('title', 'Editar perfil')

@section('content')
    <div class="btn-atrass">
        <a href="{{route('inicio.inicio')}}" class="btn-atras">⬅</a>
    </div>

    <div class="main-content">
        <div class="title-page-admin">
            <h2>Editar Perfil</h2>
        </div>
        <form method="POST" action="{{ route('profiles.update', $profile) }}" enctype="multipart/form-data"
            class="form-article">
            @csrf
            @method('PUT')
            <div class="content-create-article">

                <div class="input-content">
                    <label for="name">Nombre completo:</label>
                    <input type="text" name="name" placeholder="Escribe tu nombre completo"
                        value="{{ $profile->user->name }}" autofocus>

                    @error('name')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="input-content">
                    <label for="ci">Carnet de identidad</label>
                    <input type="text" name="ci" placeholder="Carnet de identidad" value="{{ $profile->user->ci }}"
                        autofocus>

                    @error('ci')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                
                <div class="input-content">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" placeholder="Numero de telefono"  value="{{ $profile->user->telefono }}"autofocus>
                    @error('telefono')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="input-content">
                    <label for="telefono">Direccion</label>
                    <input type="text" name="direccion" placeholder="Direccion"value="{{ $profile->user->direccion }}"
                        autofocus>

                    @error('direccion')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="input-content">
                    <label for="email">Correo eléctronico</label>
                    <input type="text" name="email" placeholder="Correo eléctronico"
                        value="{{ $profile->user->email }}" autofocus>

                    @error('email')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="input-content">
                    <label for="personaResponsable">Nombre de referencia</label>
                    <input type="text" name="personaResponsable" placeholder="Nombre de referencia"
                    value="{{ $profile->user->personaResponsable }}" autofocus>

                    @error('personaResponsable')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="input-content">
                    <label for="personaResponsable">Telefono referencia</label>
                    <input type="text" name="telefonoResponsable" placeholder="Telefono de referencia"  value="{{ $profile->user->telefonoResponsable }}"
                        autofocus>

                    @error('telefonoResponsable')
                        <span class="alert-red">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>


                <div class="input-content">
                    <label for="image">Foto de perfil</label> <br>
                    <input type="file" id="photo" accept="image/*" name="photo" class="form-input-file">
                    <!--Si tiene una foto que la muestre-->
                    @if ($profile->photo)
                    <label>Foto actual</label>
                    <div class="img-article">
                        <center><img src="{{asset('storage/' .Auth::user()->profile->photo)}}" class="img"></center>
                    </div>
                    

                    @error('photo')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                    @endif

                </div>

                <input type="submit" value="Editar perfil" class="button">
        </form>
    </div>
@endsection
