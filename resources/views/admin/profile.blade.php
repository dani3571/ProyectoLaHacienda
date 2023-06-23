@extends('adminlte::page')

@section('title', 'Panel de administracion')

@section('content_header')

@stop

@section('content')
<style>
.container {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.profile-container {
  width: 80%;
  margin: 50px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.subtitle-container {
  width: 80%;
  margin: 20px auto;
}

h1, h2 {
  text-align: center;
}

.profile-table {
  width: 100%;
  margin-top: 20px;
}

.profile-table td {
  padding: 10px;
}

.profile-table td:first-child {
  font-weight: bold;
}

.card {
  margin-top: 20px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.card-body {
  display: flex;
}

.foto-mascota {
  flex: 0 0 30%;
  padding: 10px;
}

.datos-mascota {
  flex: 0 0 70%;
  padding: 10px;
}

.img-profile {
  max-width: 190px;
  height: 200px;
}

.columnas-atributos {
  display: flex;
}

.columna-atributos {
  flex: 0 0 50%;
}

</style>

<div class="container">
  <div class="profile-container">
    <h1>Perfil de Usuario</h1>
    <table class="profile-table">
      <tr>
        <td><strong>ID:</strong></td>
        <td id="profile-id">{{$user->id}}</td>
        <td><strong>Nombre:</strong></td>
        <td id="profile-name">{{$user->name}}</td>
      </tr>
      <tr>
        <td><strong>CI:</strong></td>
        <td id="profile-ci">{{$user->ci}}</td>
        <td><strong>Teléfono:</strong></td>
        <td id="profile-telefono">{{$user->telefono}}</td>
      </tr>
      <tr>
        <td><strong>Dirección:</strong></td>
        <td id="profile-direccion">{{$user->direccion}}</td>
        <td><strong>Email:</strong></td>
        <td id="profile-email">{{$user->email}}</td>
      </tr>
      <tr>
        <td><strong>Persona Responsable:</strong></td>
        <td id="profile-responsable">{{$user->personaResponsable}}</td>
        <td><strong>Teléfono Responsable:</strong></td>
        <td id="profile-telefono-responsable">{{$user->telefonoResponsable}}</td>
      </tr>
    </table>
  </div>

  <div class="subtitle-container" id="mascotas">
    <h2>Mascotas</h2>
    <div>
        <a href="{{route('admin.createMascota')}}" class="btn btn-primary btn-sm mb-2">Agregar Mascota</a>
    </div>
    @foreach ($mascotas as $mascota)
    <div class="card tarjeta-ancho">
    <div class="card-body d-flex">
    <!--<div class="foto-mascota">
      <img src="{{$mascota->image ? asset('storage/' . $mascota->image) : asset('images/logo.png')}}" alt="Mascota" class="img-profile">
    </div>-->
    <div class="foto-mascota">
    @if ($mascota->image && file_exists(public_path('storage/' . $mascota->image)))
        <img src="{{ asset('storage/' . $mascota->image) }}" alt="Mascota" class="img-profile">
    @else
        <img src="{{ asset('images/logo.png') }}" alt="Mascota por defecto" class="img-profile">
    @endif
    </div>


    <div class="datos-mascota">
      <h2 class="card-title">{{ $mascota->nombre }}</h2>
      <div class="card-text columnas-atributos">
        <div class="columna-atributos">
          <p><strong>Tipo:</strong> {{ $mascota->tipo }}</p>
          <p><strong>Raza:</strong> {{ $mascota->raza }}</p>
          <p><strong>Color:</strong> {{ $mascota->color }}</p>
          <p><strong>Fecha de Nacimiento:</strong> {{ $mascota->fechaNacimiento }}</p>
          <p><strong>Peso:</strong> {{ $mascota->peso }}</p>
        </div>
        <div class="columna-atributos">
          <p><strong>Tamaño:</strong> {{ $mascota->tamaño }}</p>
          <p><strong>Carácter:</strong> {{ $mascota->caracter }}</p>
          <p><strong>Sexo:</strong> {{ $mascota->sexo }}</p>
          <p><strong>Nombre de referencia:</strong> {{ $mascota->persona_referencia }} - {{$mascota->telefonoResponsable}}</p>
        </div>
      </div>
      <div>
        <a href="{{route('admin.editMascota', $mascota->id)}}" class="btn btn-primary btn-sm mb-2">Modificar datos de mascota</a>
        <a href="{{route('admin.vacunasMascota', $mascota->id)}}" class="btn btn-secondary btn-sm mb-2">Ver vacunas</a>
        <a href="{{route('admin.diagnosticosMascota', $mascota->id)}}" class="btn btn-secondary btn-sm mb-2">Ver diagnósticos</a>
      </div>
    </div>
  </div>
</div>

    @endforeach
  </div>
</div>

@endsection

@section('js')
<script>
  // Suponiendo que tienes los datos del usuario disponibles en un objeto llamado 'user'
  /*var user = {
    id: 1,
    name: "Nombre del Usuario",
    ci: "123456789",
    telefono: "555-123456",
    direccion: "Dirección del Usuario",
    email: "usuario@example.com",
    personaResponsable: "Responsable del Usuario",
    telefonoResponsable: "555-987654"
  };

  // Actualizar los elementos HTML con los datos del usuario
  document.getElementById("profile-id").textContent = user.id;
  document.getElementById("profile-name").textContent = user.name;
  document.getElementById("profile-ci").textContent = user.ci;
  document.getElementById("profile-telefono").textContent = user.telefono;
  document.getElementById("profile-direccion").textContent = user.direccion;
  document.getElementById("profile-email").textContent = user.email;
  document.getElementById("profile-responsable").textContent = user.personaResponsable;
  document.getElementById("profile-telefono-responsable").textContent = user.telefonoResponsable;*/
</script>
@endsection
