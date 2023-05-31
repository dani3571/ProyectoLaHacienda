@extends('adminlte::page')

@section('title', 'Registrar Proveedor')

@section('content_header')
<h1>Registrar nuevo proveedor</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('proveedores.store')}}">
            @csrf 
            <div class="form-group">
                <label>NOMBRE</label>
                <input type="text" class="form-control" id="nombre" name='nombre' placeholder="Nombre del proveedor"
                    value="{{ old('nombre') }}">

                    @error('nombre')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <label>TELEFONO</label>
                <input type="number" maxlength="8" class="form-control" id="telefono" name='telefono' placeholder="telefono del proveedor"
                    value="{{ old('telefono') }}">

                    @error('telefono')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>


                <label>DIRECCION</label>
                <div class="form-group">
                <input type="text" class="form-control" id="direccion" name='direccion' placeholder="direccion del proveedor"
                    value="{{ old('direccion') }}">

                    @error('direccion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

           <div class="form-group">
         
                <label>CIUDAD</label>
                <input type="text" class="form-control" id="ciudad" name='ciudad' placeholder="ciudad del proveedor"
                    value="{{ old('ciudad') }}">

                    @error('ciudad')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" class="form-control" id="url" name='url' placeholder="direccion url del proveedor"
                    value="{{ old('url') }}">

                @error('url')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

                <input type="submit" value="Registrar proveedor" class="btn btn-primary">

     </form>
    </div>
</div>
@endsection
