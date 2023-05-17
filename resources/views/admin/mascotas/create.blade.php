@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nueva mascota</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('mascotas.store')}}">
            @csrf 
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name='nombre' placeholder="Nombre de la mascota"
                    value="{{ old('nombre') }}">

                    @error('nombre')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>


                <label>Tipo</label>
                <div class="form-group">
                    <select class="form-control" name="tipo" id="tipo">
                        <option value="">Seleccione el tipo</option>
                   
                            <option value="Perro">Perro</option>
                            <option value="Perro">Gato</option>
            
                    </select>
                    @error('tipo')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

           <div class="form-group">
         
                <label>Raza</label>
                <input type="text" class="form-control" id="raza" name='raza' placeholder="Raza"
                    value="{{ old('raza') }}">

                    @error('raza')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="text" class="form-control" id="color" name='color' placeholder="Color"
                    value="{{ old('color') }}">

                @error('color')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Fecha Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name='fechaNacimiento' placeholder="Fecha de Nacimiento"
                    value="{{ old('fechaNacimiento') }}">

                @error('fechaNacimiento')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
         
                <label>Caracter</label>
                <input type="text" class="form-control" id="caracter" name='caracter' placeholder="Caracter"
                    value="{{ old('caracter') }}">

                @error('caracter')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
         
                <label>Sexo</label>
                   <div class="form-check form-check-inline">
                        <label class="form-check-label" for="">Macho</label>
                        <input class="form-check-input ml-2" type="radio" name='sexo' value="macho"
                            checked>
                    </div>

                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="">Hembra</label>
                        <input class="form-check-input ml-2" type="radio" name='sexo' value="hembra">
                    </div>
                    @error('sexo')
                    <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror

                </div>


              

                <input type="submit" value="Registrar mascota" class="btn btn-primary">

     </form>
    </div>
</div>
@endsection
