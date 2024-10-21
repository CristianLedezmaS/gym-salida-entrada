<style>
    body {
        font-family: 'Aptos Display', sans-serif;
        background-color: #ffffff; /* Fondo blanco para la hoja */
        color: #333;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        font-size: 32px;
        color: #000; /* Título en negro */
        margin-bottom: 20px;
        font-weight: 700;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
        text-align: left;
        padding: 12px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #154360; /* Fondo azul para el encabezado */
        color: #fff; /* Texto blanco en el encabezado */
        font-size: 16px;
        font-weight: 700;
    }

    tr:nth-child(even) {
        background-color: #e9f2fc; /* Color claro para las filas pares */
    }

    tr:hover {
        background-color: #cce5ff; /* Color más intenso al pasar el ratón */
    }

    p {
        margin-top: 30px;
        text-align: right;
        font-size: 14px;
        color: #555;
    }
</style>

<h1>Reporte de Asistencias</h1>

<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Marcado Por</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $item)
            <tr>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->fecha_hora }}</td>
                <td>{{ $item->marcado_por }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p>Generado el {{ date('d-m-Y H:i:s') }}</p>
