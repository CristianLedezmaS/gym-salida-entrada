<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ingresos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>Reporte de Ingresos</h1>
    <p><strong>Fecha del reporte:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    <p><strong>Rango de fechas:</strong> {{ $inicio }} - {{ $fin }}</p>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Correo</th>
                    <th>Costo Total</th>
                    <th>Fecha de Pago</th>
                    <th>Pago con</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingresos as $ingreso)
                    <tr>
                        <td>{{ $ingreso->nombre }}</td>
                        <td>{{ $ingreso->correo }}</td>
                        <td>{{ number_format($ingreso->costo_total, 2, ',', '.') }} €</td>
                        <td>{{ \Carbon\Carbon::parse($ingreso->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $ingreso->paga_con }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
