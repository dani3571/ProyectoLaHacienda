@extends('adminlte::page')

@section('title', 'Registrar Proveedor')

@section('content_header')
<h1>Registrar nueva Categoria</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('admin.categorias.store')}}">
            @csrf 
            <div class="form-group">
                <label>NOMBRE</label>
                <input type="text" class="form-control" id="nombre" name='nombre' placeholder="Nombre de la categoria"
                    value="{{ old('nombre') }}">

                    @error('nombre')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <label>DESCRIPCION</label>
                <input type="text" class="form-control" id="descripcion" name='descripcion' placeholder="descripcion de la categoria"
                    value="{{ old('descripcion') }}">

                    @error('descripcion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>


                <input type="submit" value="Registrar categoria" class="btn btn-primary">

     </form>
    </div>
</div>
@endsection
