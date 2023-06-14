@extends('adminlte::page')

@section('title', 'Habitaciones Inactivas')

@section('content_header')
<h1>Habitaciones activas</h1>
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

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <tr>
            <th>No</th>                                   
			<th>Nro Habitacion</th>
            <th>Tipo de ocupante</th>
			<th>Costo Habitacion</th>
			<th>Tamaño de habitación</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($habitacion as $habitacion)
                <tr>
                <td>{{ $habitacion->id }}</td>
				<td>{{ $habitacion->nro_habitacion }}</td>
                <td>{{ $habitacion->tipo_ocupante }}</td>
				<td>{{ $habitacion->costo_habitacion }}</td>
				<td>{{ $habitacion->tamano_habitacion }}</td>
                <td> 
                <td><button type="button" class="btn btn-sm btn-primary reactivarHabitacion" value="{{$habitacion->id}}" > Restablecer </button></td>    
            </td>                  
                <div class="modal fade" id="ModalReactivar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">                                           
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ route('habitacion.reactivar',$habitacion->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Restablecer habitación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="Habi_id" id="Habi_id">
                                    ¿Restablecer habitación?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger btn-sm">Si. restablecer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
@endsection
@section('js')
<script>
    $(document).ready(function () {
    $('.reactivarHabitacion').click(function (e) {
        e.preventDefault();
        var habi_id = $(this).val();
        $('#Habi_id').val(habi_id);
        $('#ModalReactivar').modal('show');
    });
});
</script>
@endsection