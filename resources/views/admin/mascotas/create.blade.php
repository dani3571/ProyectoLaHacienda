@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Registrar nueva mascota</h1>
@endsection

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Éxito',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('fail'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('fail') }}',
                icon: 'error'
            });
        </script>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('mascotas.store') }}" enctype="multipart/form-data">
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
                    <select class="form-control" name="tipo" id="tipo" {{ old('tipo') }}>
                        <option value="">Seleccione el tipo</option>

                        <option {{ old('tipo') == 'Perro' ? 'selected' : '' }} value="Perro">Perro</option>
                        <option {{ old('tipo') == 'Gato' ? 'selected' : '' }} value="Gato">Gato</option>

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
                    <!--<input type="date" class="form-control" id="fechaNacimiento" name='fechaNacimiento'
                        placeholder="Fecha de Nacimiento" value="{{ old('fechaNacimiento') }}">-->
                    <input type="date" class="form-control" id="fechaNacimiento" name='fechaNacimiento'
                    placeholder="Fecha de Nacimiento" value="{{ old('fechaNacimiento') }}"
                    max="{{ \Carbon\Carbon::yesterday()->format('Y-m-d') }}">
                    @error('fechaNacimiento')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Caracter</label>
                    <input type="text" class="form-control" id="caracter" name='caracter'
                        placeholder="Describa el Caracter" value="{{ old('caracter') }}">

                    @error('caracter')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Peso</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="peso" name="peso"
                                    placeholder="Ingrese el peso" value="{{ old('peso') }}">
                                <select class="form-control input-group-append custom-select-sm" name="unidad_peso">
                                    <option value="kg">kg</option>
                                    <option value="lb">lb</option>
                                </select>
                            </div>
                            @error('peso')
                                <span class="text-danger">
                                    <span>*{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tamaño</label>
                            <select class="form-control" name="tamaño" id="tamaño">
                                <option value="">Seleccione el tamaño de la mascota</option>
                                <option {{ old('tamaño') == 'Pequeño' ? 'selected' : '' }} value="Pequeño">Pequeño</option>
                                <option {{ old('tamaño') == 'Mediano' ? 'selected' : '' }} value="Mediano">Mediano</option>
                                <option {{ old('tamaño') == 'Grande' ? 'selected' : '' }} value="Grande">Grande</option>
                            </select>
                            @error('tipo')
                                <span class="text-danger">
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sexo</label>
                            <br>
                            <center>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="">Macho</label>
                                    <input class="form-check-input ml-2" type="radio" name='sexo' value="macho"
                                        checked>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="">Hembra</label>
                                    <input class="form-check-input ml-2" type="radio" name='sexo' value="hembra">
                                </div>
                            </center>
                            @error('sexo')
                                <span class="text-danger">
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Cargar imagen</label>
                    <input type="file" name="image">

                    @error('image')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>


                <input type="submit" value="Registrar mascota" class="btn btn-primary">

            </form>
        </div>
    </div>

@endsection
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/logo.png') }}">
@section('css')
    <style>
        .nav-item {
            background: dark;
        }

        .menu-open {
            background-color: #4d5059 !important;
        }

        .custom-select-sm {
            width: 60px;
            height: 38px;
            font-size: 15px;
            padding: 0;
        }
    </style>
@endsection
