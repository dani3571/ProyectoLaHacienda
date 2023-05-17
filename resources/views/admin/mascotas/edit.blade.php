@extends('adminlte::page')




@section('title', 'Modificar articulo')




@section('content_header')

    <h2>Modificar artículo</h2>

@endsection




@section('content')




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
                        <span class="alert-red">

                            <span>*{{ $message }}</span>

                        </span>
                    @enderror


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

                    <label>Raza</label>

                    <input type="text" class="form-control" id="raza" name='raza' placeholder="Raza"
                        value="{{ $mascota->raza }}">
                    @error('raza')
                        <span class="alert-red">

                            <span>*{{ $message }}</span>

                        </span>
                    @enderror
                    <label>Color</label>

                    <input type="text" class="form-control" id="color" name='color'
                        placeholder="Color"value="{{ $mascota->color }}">

                    @error('color')
                        <span class="alert-red">

                            <span>*{{ $message }}</span>

                        </span>
                    @enderror

                    <label>Fecha Nacimiento</label>

                    <input type="date" class="form-control" id="fechaNacimiento" name='fechaNacimiento'
                        placeholder="Fecha de Nacimiento" value="{{ $mascota->fechaNacimiento }}">

                    @error('fechaNacimiento')
                        <span class="alert-red">

                            <span>*{{ $message }}</span>

                        </span>
                    @enderror


                    <label>Caracter</label>

                    <input type="text" class="form-control" id="caracter" name='caracter' placeholder="Caracter"
                        value="{{ $mascota->caracter }}">

                    @error('caracter')
                        <span class="alert-red">

                            <span>*{{ $message }}</span>

                        </span>
                    @enderror

                    <label>Sexo</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Macho</label>

                            <input class="form-check-input ml-2" type="radio" name='sexo' value="macho" checked>

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

                    <label for="">Estado</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Privado</label>
                            <input class="form-check-input ml-2" type="radio" name='status' id="status" value="0"
                                checked>
                        </div>

                        <div class="form-check form-check-inline">

                            <label class="form-check-label" for="">Público</label>

                            <input class="form-check-input ml-2" type="radio" name='status' id="status"
                                value="1">

                        </div>

                        @error('estado')
                            <span class="text-danger">

                                <span>{{ $message }}</span>

                            </span>
                        @enderror
                    </div>
                </div>
                <input type="submit" value="Modificar artículo" class="btn btn-primary">
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
