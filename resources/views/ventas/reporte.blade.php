<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .header {
            text-align: center;
            padding: 10px;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
            filter: blur(3px);
        }
        .header h1, .header h2 {
            margin: 0;
        }
        .details {
            margin-top: 10px;
            text-align: right;
            font-size: 0.9em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body >
    <div class="header" >
        <h1>Tienda La Curacao</h1>
        <h2>Reporte de Ventas</h2>
    </div>


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id_venta }}</td>
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>{{ number_format($venta->total, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="details">
      
        <?php date_default_timezone_set('America/Lima'); ?>
        <p>Fecha y hora de generación: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
    </div>
</body>
</html>
