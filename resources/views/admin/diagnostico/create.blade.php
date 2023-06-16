@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nuevo diagnóstico</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('diagnostico.store') }}">
            @csrf

            <div class="form-group">
                <label>Seleccionar cliente</label>
                <select class="form-control" id="usuario_id" name='usuario_id' onchange="val()">
                    <option value="">Seleccione al cliente</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                <label>Descripción del diagnóstico</label>
                <textarea class="form-control" id="descripcion" name="descripcion"
                    placeholder="Ingrese la descripción del diagnóstico">{{ old('descripcion') }}</textarea>

                @error('descripcion')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Fecha del diagnóstico</label>
                <input type="date" class="form-control" id="fecha" name='fecha'
                    placeholder="Seleccione la fecha del diagnóstico" value="{{ old('fecha') }}">

                @error('fecha')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Fecha esperada para el siguiente diagnóstico</label>
                <input type="date" class="form-control" id="fechaVolver" name='fechaVolver'
                    placeholder="Seleccione la fecha esperada" value="{{ old('fechaVolver') }}">

                @error('fechaVolver')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Costo de diagnóstico</label>
                <input type="number" class="form-control" id="costo" name='costo'
                    placeholder="Ingrese el costo de diagnóstico" value="{{ old('costo') }}">

                @error('costo')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <input type="submit" value="Registrar diagnóstico" class="btn btn-primary">
            <a class="btn btn-danger" href="{{ route('diagnostico.index') }}">Volver</a>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    //CARGAR MASCOTAS DEL USUARIO - DIAGNÓSTICOS.
    function val() {
        var user_id = document.getElementById("usuario_id").value;
        var s = '<option value="">Seleccione la mascota</option>';
        var count = 0;

        @foreach ($mascotas as $mascota)
        if ({{ $mascota->usuario_id }} == user_id) {
            s += '<option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>';
            count++;
        }
        @endforeach
        if (count < 1) {
            s += '<option value="">El cliente no tiene mascotas registradas</option>';
        }
        const mascota = document.getElementById("mascota_id");
        mascota.innerHTML = s;
    }
</script>
@endsection
