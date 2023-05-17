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
        <form class="container-fluid d-flex" action="{{ route('ventas.insertarVentas') }}" method="POST">
            <div class="container-sm col-4 border-right border-secondary">
                <div class="card-body">
                    <h4 class="text-center"> 
                        Ingrese los datos de la venta
                    </h4>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label text-secondary">Fecha</label>
                            <input disabled type="Cantidad" class="form-control" id="" value="{{ now()-> format('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label text-secondary">Id Producto</label>
                            <select class="form-select form-select-sm w-100 form-control" style="padding:6px;" disabled id="IdProducto">
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
                            <label for="" class="form-label text-secondary">Apellido</label>
                            <input type="Text" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label text-secondary">NIT</label>
                            <input type="Number" class="form-control" id="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label text-secondary">Cantidad</label>
                            <input type="Number" class="form-control" id="Cantidad">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label text-secondary">Cantidad disponible</label>
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
                            <label for="" class="form-select text-secondary">Seleccione producto</label>
                            <select class="form-select form-select-sm w-100 form-control" style="padding:6px;" id="Producto">
                              <option value="Correa">Correa</option>
                              <option value="Croquetas">Croquetas</option>
                              <option value="Juguete">Juguete</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label text-secondary">Precio individual</label>
                            <select class="form-select form-select-sm w-100 form-control" disabled style="padding:6px;" id="PrecioIndividual">
                              <option value="10">10bs</option>
                              <option value="20">20bs</option>
                              <option value="30">30bs</option>
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
                                <th scope="col">Detalle</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" class="text-center">
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end" style="margin-left:0px;margin-right:0px;">
                        <div class="align-items-center row">
                            <label for="" class="form-label text-secondary col-3">Total: </label>
                            <input type="text" disabled class="form-control col-4" id="Total">
                            <div class="col-2">
                            </div>
                            <button class="btn btn-primary col-3">Confirmar</button>
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
