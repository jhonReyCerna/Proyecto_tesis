<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras</title>
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
        .header h1, .header h2 {
            margin: 0;
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
        th {
            background-color: #f2f2f2;
        }
        .details {
            margin-top: 10px;
            text-align: right;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Tienda La Curacao</h1>
        <h2>Reporte de Compras</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Almacén</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
                <tr>
                    <td>{{ $compra->id_compra }}</td>
                    <td>{{ $compra->producto->nombre }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->cantidad }}</td>
                    <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('Y-m-d') }}</td>
                    <td>{{ $compra->almacen->nombre }}</td>
                    <td>{{ number_format($compra->precio_unitario, 2) }}</td>
                    <td>{{ number_format($compra->total, 2) }}</td>
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
