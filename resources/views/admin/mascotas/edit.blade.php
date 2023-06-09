@extends('adminlte::page')

@section('title', 'Modificar mascota')

@section('content_header')
    <h1>Modificar Mascota</h1>
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
            <form method="POST" action="{{ route('mascotas.update', $mascota->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $mascota->id }}">
                </div>

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name='nombre'
                        placeholder="Nombre de la mascota" value="{{ $mascota->nombre }}">

                    @error('nombre')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>


                <label>Tipo</label>
                <div class="form-group">
                    <select class="form-control" name="tipo" id="tipo">
                        <option value="{{ $mascota->tipo }}">Seleccione el tipo</option>
                        <option value="Perro">Perro</option>
                        <option value="Gato">Gato</option>
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
                        value="{{ $mascota->raza }}">

                    @error('raza')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" class="form-control" id="color" name='color' placeholder="Color"
                        value="{{ $mascota->color }}">

                    @error('color')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" name='fechaNacimiento'
                        placeholder="Fecha de Nacimiento" value="{{ $mascota->fechaNacimiento }}">

                    @error('fechaNacimiento')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="form-group">

                    <label>Caracter</label>
                    <input type="text" class="form-control" id="caracter" name='caracter'
                        placeholder="Describa el Caracter" value="{{ $mascota->caracter }}">

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
                            <input type="text" class="form-control" id="peso" name='peso'
                                placeholder="Ingrese el peso" value="{{ $mascota->peso }}">
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
                            <select class="form-control" name="tamaño" id="tamaño" value="{{ $mascota->tamaño }}">
                                <option value="">Seleccione el tamaño de la mascota</option>
                                <option value="Pequeño">Pequeño</option>
                                <option value="Mediano">Mediano</option>
                                <option value="Grande">Grande</option>
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
                    <label>Cambiar imagen</label>
                    <input type="file" class="form-control-file mb-2" id="image" name='image'>

                    <div class="rounded mx-auto d-block">
                        <img src="{{ asset('images/mascotas/' . $mascota->image) }}" style="width: 250px">
                    </div>

                    @error('image')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <input type="submit" value="Modificar mascota" class="btn btn-primary">

            </form>
        </div>
    </div>
   
  
@endsection


@section('js')
    <!--Utilizando Jquery-Plugin-stringToSlug-->
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $("#title").stringToSlug({

                setEvents: 'keyup keydown blur',

                getPut: '#slug',

                space: '-'
            });
        });
    </script>

    <!--Utilizando ckeditor5 para el textarea-->

    <!--Utilizando ckeditor5 github este sera para que aparezca una barra de herramientas arriba del textarea-->

    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor.create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });
    </script>
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
    </style>
@endsection
