@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')

<h1 class ="text-muted">Nueva venta</h1>
<a href="{{route('ventas.index')}}">
    Volver
</a>
<br>
@endsection
<style>
    .content {
        min-height: 881.5px !important;
    }
</style>
@section('content')
@if (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif
<div class="container-fluid mh-100">
    <div class="row">
        <form class="container-fluid d-flex" action="{{ route('ventas.store') }}" method="POST">
            @csrf
            <div class="container-sm col-4 border-right border-secondary">
                <div class="card-body">
                    <h4 class="text-center"> 
                        Ingrese los datos de la venta
                    </h4>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Fecha" class="form-label text-secondary">Fecha</label>
                            <input readonly type="Text" class="form-control" id="Fecha" value="{{ now()-> format('Y-m-d') }}" name="Fecha">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="IdProducto" class="form-label text-secondary">Id Producto</label>
                            <select class="form-select form-select-sm w-100 form-control" style="padding:6px;" readonly id="IdProducto">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Apellido" class="form-label text-secondary">Apellido</label>
                            <input type="Text" class="form-control" id="Apellido" required name="Apellido">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Nit" class="form-label text-secondary">NIT</label>
                            <input type="Number" class="form-control" id="Nit" required name="Nit">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Cantidad" class="form-label text-secondary">Cantidad</label>
                            <input type="Number" class="form-control" id="Cantidad">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="CantidadDisponible" class="form-label text-secondary">Cantidad disponible</label>
                            <select class="form-select form-select-sm w-100 form-control" style="padding:6px;" disabled id="CantidadDisponible">
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Producto" class="form-select text-secondary">Seleccione producto</label>
                            <select class="form-select form-select-sm w-100 form-control" style="padding:6px;" id="Producto">
                              <option value="Correa">Correa</option>
                              <option value="Croquetas">Croquetas</option>
                              <option value="Juguete">Juguete</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="PrecioIndividual" class="form-label text-secondary">Precio individual</label>
                            <select class="form-select form-select-sm w-100 form-control" disabled style="padding:6px;" id="PrecioIndividual">
                              <option value="10.5">10.50bs</option>
                              <option value="20.1">20.10bs</option>
                              <option value="30.2">30.20bs</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 d-flex justify-content-center">
                            <a href="{{route('ventas.create')}}" class="btn btn-outline-primary mb-3">Cancelar</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 d-flex justify-content-center">
                            <button class="btn btn-primary mb-3" id="btnAgregarProducto">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-sm col-8 ">
                <div class="card-body h-100" style="max-height:468px;  overflow-y: auto;">
                    <table class="table table-sm table-bordered table-striped" id="tabla" >
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">Id</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio Individual</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col-auto">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" class="text-center">
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end" style="margin-left:0px;margin-right:0px;">
                        <div class="align-items-center row">
                            <input type="hidden" id="CantidadTotal" name="CantidadTotal"/>
                            <label for="Total" class="form-label text-secondary col-3">Total: </label>
                            <input type="number" readonly class="form-control col-4" id="Total" name="Total"/>
                            <div class="col-2">
                            </div>
                            <input class="btn btn-primary col-3" type="submit"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/ventas.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/tablaventas.js') }}"></script>
    <script src="{{ asset('js/controlcombobox.js') }}"></script>
@endsection
