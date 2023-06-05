@extends('adminlte::page')

@section('title', 'Panel de administración')
@section('content_header')
<h1>Registro de actividad en la aplicación</h1>
@endsection
@section('content')
    @if (empty($logContent))
        <p>No hay registros en el archivo de logs.</p>
    @else
        <pre>{{ $logContent }}</pre>
    @endif
@endsection