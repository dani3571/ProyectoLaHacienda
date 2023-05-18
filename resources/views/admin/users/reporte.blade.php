
<link rel="stylesheet" href="{{asset('css/base/css/reportes.css')}}">
<div class="card">
    <div class="card-header">
        <h2>REPORTE DE USUARIOS</h2>
    </div>
    
    <p>Hola {{$name}} a continuacion se muestra el reporte de usuarios</p>

    <p>Fecha y hora: {{$horaFormateada = now();}} </p>
    
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">CI</th>
                    <th scope="col">Telefono</th>             
                    <th scope="col">Direccion</th>
                    <th scope="col">Email</th>
                    <th scope="col">persona de referencia</th>
                    <th scope="col">telefono de referencia</th>
              

                </tr>
            </thead>
            @foreach ($user as $users )
                <tr>
                    <td>{{$users->name}}</td>
                    <td>{{$users->ci}}</td>
                    <td>{{$users->telefono}}</td>          
                    <td>{{$users->direccion}}</td>
                    <td>{{$users->email}}</td>          
                    <td>{{$users->personaResponsable}}</td>
                    <td>{{$users->telefonoResponsable}}</td>
          
                </tr>  
             @endforeach
           
        </table>
    </div>
</div>