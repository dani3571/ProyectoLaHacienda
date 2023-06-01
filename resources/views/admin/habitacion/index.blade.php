@extends('adminlte::page')

@section('title', 'Habitaciones activas')

@section('content_header')
<h1>Reservación de hotel</h1>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Habitacion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('habitacion.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva habitación') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nro Habitacion</th>
										<th>Costo Habitacion</th>
										<th>Capacidad</th>
										<th>Reservacionhotel Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($habitacion as $habitacion)
                                        <tr>
                                        <td>{{ $habitacion->id }}</td>
                                            
											<td>{{ $habitacion->nro_habitacion }}</td>
											<td>{{ $habitacion->costo_habitacion }}</td>
											<td>{{ $habitacion->capacidad }}</td>
											<td>{{ $habitacion->reservacionHotel_id }}</td>

                                            <td>
                                                <form action="{{ route('habitacion.destroy',$habitacion->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('habitacion.show',$habitacion->id) }}"> {{ __('Detalles') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('habitacion.edit',$habitacion->id) }}"> {{ __('Modificar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"> {{ __('Desactivar') }}</button>
                                                </form>
                                            </td>

                                            <TD>
                                            <form action="{{ route('habitacion.asignaReservaHotel', ['id' => $habitacion->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <!-- Campo del formulario -->
                                                <input type="hidden" name="reservacionHotel_id" value="{{ $habitacion->reservacionHotel_id }}">

                                                <!-- Botón de envío -->
                                                <!--<button type="submit">Actualizar</button>-->
                                            </form>
                                        </TD>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@endsection