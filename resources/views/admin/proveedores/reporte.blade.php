<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Proveedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .report-info {
            margin-bottom: 20px;
        }
        .report-info span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="report-info">
        <span>Fecha del reporte:</span> {{ date('d/m/Y') }}
        <br>
        <span>Realizado por:</span> {{ Auth::user()->name }}
    </div>
    <h1>Reporte de Proveedores</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí debes iterar sobre los proveedores y generar una fila por cada uno -->
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->id }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->ciudad }}</td>
                    <td>{{ $proveedor->url }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
