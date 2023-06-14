@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nueva habitación</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('habitacion.store')}}">
            @csrf 
            <!--<div class="form-group">
                <label>No</label>
                <input type="text" class="form-control" id="id" name='id' placeholder="id"
                    value="{{ old('id') }}">

                    @error('id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> -->     
            <div class="form-group">
                <label>Número de habitación</label>
                <input type="number" class="form-control" id="nro_habitacion" name='nro_habitacion' placeholder="Ingrese el número de habitación"
                    value="{{ old('nro_habitacion') }}">

                    @error('nro_habitacion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>Tipo de ocupante</label>
                <select class="form-control" name="tipo_ocupante" id="tipo_ocupante" {{ old('tipo_ocupante') }}>
                        <option value="">Seleccione el tipo de habitación</option>

                        <option {{ old('tipo_ocupante') == 'Perro' ? 'selected' : '' }} value="Perro">Perro</option>
                        <option {{ old('tipo_ocupante') == 'Gato' ? 'selected' : '' }} value="Gato">Gato</option>

                    </select>
                    @error('tipo_ocupante')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>Costo de habitación</label>
                <input type="number" class="form-control" id="costo_habitacion" name='costo_habitacion' placeholder="Ingrese el costo de habitación"
                    value="{{ old('costo_habitacion') }}">

                    @error('costo_habitacion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>Tamaño de habitación</label>
                <select class="form-control" name="tamano_habitacion" id="tamano_habitacion">
                        <option value="">Seleccione el tamaño de habitación</option>
                        <option {{ old('tamano_habitacion') == 'Pequeño' ? 'selected' : '' }} value="Pequeño">Pequeño</option>
                        <option {{ old('tamano_habitacion') == 'Mediano' ? 'selected' : '' }} value="Mediano">Mediano</option>
                        <option {{ old('tamano_habitacion') == 'Grande' ? 'selected' : '' }} value="Grande">Grande</option>
                </select>
                    @error('tamano_habitacion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <input type="submit" value="Registrar habitación" class="btn btn-primary">
            <a class="btn btn-danger" href="{{route('habitacion.index')}}">Volver</a>
     </form>
    </div>
</div>
@endsection
