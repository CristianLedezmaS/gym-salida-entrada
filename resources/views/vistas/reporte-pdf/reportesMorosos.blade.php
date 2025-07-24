<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Morosos</title>
</head>
<body>
    <h1>Reporte de Clientes Morosos</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Deuda</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($clientesMorosos as $cliente)
                <tr>
                    <td>{{ $cliente->id_cliente }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->debe }}</td>
                    <td>
            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
