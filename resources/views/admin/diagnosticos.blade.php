@extends('adminlte::page')

@section('title', 'Diagnosticos activos')

@section('content_header')
<h1>Diagnosticos activos</h1>
@endsection

@section('content')
@if(session('success-create'))
<div class="alert alert-info">
     {{ session('success-create') }}
</div>
@elseif (session('success-update'))
<div class="alert alert-info">
    {{ session('success-update') }}
</div>
@elseif (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>No</th>                                   
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Fecha de Volver</th>
                <th>Costo</th>
                <th>Paciente</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($diagnosticos as $diagnostico)
                <tr>
                    <td>{{ $diagnostico->id }}</td>
                    <td>{{ $diagnostico->descripcion }}</td>
                    <td>{{ $diagnostico->fecha }}</td>
                    <td>{{ $diagnostico->fechaVolver }}</td>
                    <td>{{ $diagnostico->costo }}</td>
                    <td>@foreach ($mascotas as $mascota)
                            @if($mascota->id == $diagnostico->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('diagnostico.edit', $diagnostico->id) }}">{{ __('Modificar diagnóstico') }}</a>
                    </td>    
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.desactivarDiagnostico').click(function (e) {
            e.preventDefault();
            var diagnostico_id = $(this).val();
            $('#Diagnostico_id').val(diagnostico_id);
            $('#ModalDesactivar').modal('show');
        });
    });
</script>
@endsection
