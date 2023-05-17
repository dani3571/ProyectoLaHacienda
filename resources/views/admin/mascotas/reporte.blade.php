
<link rel="stylesheet" href="{{asset('css/base/css/reportes.css')}}">
<div class="card">
    <div class="card-header">
        <h2>REPORTE DE MASCOTAS</h2>
    </div>
    
    <p>Hola {{$name}} a continuacion se muestra el reporte de mascotas</p>

    <p>Fecha y hora: {{$horaFormateada = now();}} </p>
    
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Raza</th>
                    <th>Color</th>
                    <th>fechaNacimiento</th>
                    <th>Caracter</th>
                    <th>Sexo</th>

                </tr>
            </thead>
            @foreach ($mascotas as $mascota )
                <tr>
                    <td>{{$mascota->id}}</td>
                    <td>{{$mascota->nombre}}</td>
                    <td>{{$mascota->tipo}}</td>
                    <td>{{$mascota->raza}}</td>
                    <td>{{$mascota->color}}</td>
                    <td>{{$mascota->fechaNacimiento}}</td>
                    <td>{{$mascota->caracter}}</td>
                    <td>{{$mascota->sexo}}</td>
                </tr>  
             @endforeach
           
        </table>
    </div>
</div>