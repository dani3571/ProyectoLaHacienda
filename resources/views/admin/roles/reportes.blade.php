
<link rel="stylesheet" href="{{asset('css/base/css/reportes.css')}}">
<div class="card">
    <div class="card-header">
        <h2>REPORTE DE ROLES</h2>
    </div>
    
    <p>Hola {{$name}} a continuacion se muestra el reporte de roles</p>

    <p>Fecha y hora: {{$horaFormateada = now();}} </p>
    
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    
                    <th></th>
                    <th></th>
                  
                 
                    <th>ID</th>
                    <th></th>   
                   
                    <th>Rol</th>
                    <th></th>
                

                </tr>
            </thead>
            @foreach ($role as $roles )
                <tr>   
                    <td></td>
                    <td></td>
                    <td></td>
                
                    <td>{{$roles->id}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$roles->name}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> <td></td> <td></td>
                    <td></td>
                    <td></td>
                  
                 
                    <td></td>
                     <td></td>
                    <td></td>

                </tr>  
             @endforeach
           
        </table>
    </div>
</div>