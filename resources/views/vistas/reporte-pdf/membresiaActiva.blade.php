<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Membresías Activas</title>
</head>
<body>
    <h1>Reporte de Membresías Activas</h1>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Membresía</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientesActivos as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->membresia_nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
