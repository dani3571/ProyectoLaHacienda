@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nuevo producto</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
            @csrf 
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" value="{{ old('nombre') }}">

                @error('nombre')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del producto" value="{{ old('descripcion') }}">

                @error('descripcion')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Categoria</label><br>
                <select name="categoria_id">
                    <option value="">Seleccione una categoria</option>
                    @foreach($categoria as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio del Producto" value="{{ old('precio') }}">

                @error('precio')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad del producto" value="{{ old('cantidad') }}">

                @error('cantidad')
                    <span class="text-danger">
                        <span>*{{ $message }}</span>
                    </span>
                @enderror
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
            
            <div class="form-group">
                <label>Fecha Vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="Fecha de Vencimiento" value="{{ old('fecha_vencimiento') }}">

                @error('fecha_vencimiento')
                    <span class="text-danger">
                        <span>*{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <input type="submit" value="Registrar producto" class="btn btn-primary">
        </form>
    </div>
</div>

@endsection
