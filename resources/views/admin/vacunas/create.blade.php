@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nueva vacuna</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('vacunas.store')}}">
            @csrf 

            <div class="form-group">
                <label>Seleccionar cliente</label>
                <select class="form-control" id="usuario_id" name='usuario_id' onchange="val()">
                    <option value="">Seleccione al cliente</option>
                    @foreach ($users as $user )
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                    @error('usuario_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Seleccionar mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                <option value="">Seleccione la mascota</option>
                </select>
                    @error('mascota_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Nombre de la vacuna</label>
                <input type="text" class="form-control" id="nombre_vacuna" name='nombre_vacuna' placeholder="Ingrese el nombre de la vacuna"
                    value="{{ old('nombre_vacuna') }}">

                @error('nombre_vacuna')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div> 

            <div class="form-group">
                <label>Fecha de la vacuna</label>
                <input type="date" class="form-control" id="fecha_vacuna" name='fecha_vacuna' placeholder="Seleccione la fecha de la vacuna"
                    value="{{ old('fecha_vacuna') }}">

                @error('fecha_vacuna')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div> 
            <input type="submit" value="Registrar vacuna" class="btn btn-primary">
            <a class="btn btn-danger" href="{{route('vacunas.index')}}">Volver</a>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    //CARGAR MASCOTAS DEL USUARIO - VACUNAS.
function val() {
    var user_id = document.getElementById("usuario_id").value;
    var s = '<option value="">Seleccione la mascota</option>';
    var count = 0;
    
    @foreach ($mascotas as $mascota)
        if({{ $mascota->usuario_id }} == user_id) {
                s += '<option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>';
                count++;
        }
    @endforeach
    if(count < 1){
        s += '<option value="">El cliente no tiene mascotas registradas</option>';
    }
    //getUserAddress();
    //console.log(user_id);
    const mascota = document.getElementById("mascota_id");
    mascota.innerHTML = s;    
}
</script>
@endsection