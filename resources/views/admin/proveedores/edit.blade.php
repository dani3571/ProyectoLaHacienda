@extends('adminlte::page')

@section('title', 'Modificar Proveedor')

@section('content_header')
<h1>Modificar Proveedor</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
            @csrf 
            @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $proveedor->id }}">
                </div>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name='nombre' placeholder="Nombre de la mascota"
                value="{{ $proveedor->nombre }}">

                    @error('nombre')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="number" class="form-control" id="telefono" name='telefono' placeholder="Nombre de la mascota"
                value="{{ $proveedor->telefono }}">

                    @error('telefono')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Direccion</label>
                <input type="text" class="form-control" id="direccion" name='direccion' placeholder="Nombre de la mascota"
                value="{{ $proveedor->direccion }}">

                    @error('direccion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name='ciudad' placeholder="Nombre de la mascota"
                value="{{ $proveedor->ciudad }}">

                    @error('ciudad')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" class="form-control" id="url" name='url' placeholder="Nombre de la mascota"
                value="{{ $proveedor->url }}">

                    @error('url')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>


                


                <input type="submit" value="Modificar Proveedor" class="btn btn-primary">

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
