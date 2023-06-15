@extends('adminlte::page')

@section('title', 'Vacunas activas')

@section('content_header')
<h1>Vacunas activas</h1>
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
                <th>Nombre de la vacuna</th>
                <th>Fecha de la vacuna</th>
                <th>Paciente</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vacunas as $vacuna)
                <tr>
                    <td>{{ $vacuna->id }}</td>
                    <td>{{ $vacuna->nombre_vacuna }}</td>
                    <td>{{ $vacuna->fecha_vacuna }}</td>
                    <td>@foreach ($mascotas as $mascota )
                            @if($mascota->id == $vacuna->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('vacunas.edit', $vacuna->id) }}">{{ __('Modificar') }}</a>
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
        $('.desactivarVacuna').click(function (e) {
            e.preventDefault();
            var vacuna_id = $(this).val();
            $('#Vacuna_id').val(vacuna_id);
            $('#ModalDesactivar').modal('show');
        });
    });
</script>
@endsection
