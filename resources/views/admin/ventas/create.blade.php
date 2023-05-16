@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')

<h1>Nueva venta</h1>
<br>
@endsection

@section('content')
@if (session('success-delete'))
<style>
    .content {
        height: 100vh !important;
    }
</style>
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif
<div class="container-fluid mh-100">
    
    <div class="row ">
        <div class="container-sm col-3 border-right border-secondary">
            <div class="card-body">
                Ingrese los datos de la venta
            </div>
        </div>
        <div class="container-sm col-9">
            <div class="card-body">
                a
            </div>
        </div>
    </div>
</div>
@endsection