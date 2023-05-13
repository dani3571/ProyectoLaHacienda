@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profiles/css/style_profile.css') }}">
@endsection
@section('title', 'Editar perfil')

@section('content')
    <div class="btn-article">
        <a href="{{route('home.index')}}" class="btn-new-article">⬅</a>
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
