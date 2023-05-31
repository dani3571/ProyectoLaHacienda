@extends('adminlte::page')

@section('title', 'Modificar Producto')

@section('content_header')
<h1>Modificar Producto</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('productos.update', $productos->id) }}" enctype="multipart/form-data">

            @csrf 
            @method('PUT')
            
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name='nombre' placeholder="Nombre del producto" value="{{ $productos->nombre }}">

                @error('nombre')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Descripcion</label>
                <input type="text" class="form-control" id="descripcon" name='descripcion' placeholder="Nombre del producto" value="{{ $productos->descripcion }}">

                @error('descripcion')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" id="categoria_id" name="categoria_id">
                    <option value="">Seleccionar categoria</option>
                    @foreach ($categoria as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>

                @error('categoria_id')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Precio</label>
                <input type="number" class="form-control" id="precio" name='precio' placeholder="Precio del producto" value="{{ $productos->precio }}">

                @error('precio')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name='cantidad' placeholder="Cantidad del producto" value="{{ $productos->cantidad }}">

                @error('cantidad')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Imagen</label>
                <input type="file" class="form-control-file" id="image" name="image">

                @error('image')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Fecha de compra</label>
                <input type="date" class="form-control" id="fecha_compra" name='fecha_compra' value="{{ $productos->fecha_compra }}">

                @error('fecha_compra')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Fecha de vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name='fecha_vencimiento' value="{{ $productos->fecha_vencimiento }}">

                @error('fecha_vencimiento')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <input type="submit" value="Modificar Producto" class="btn btn-primary">
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
    ClassicEditor.create(document.querySelector('#descripcion'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
