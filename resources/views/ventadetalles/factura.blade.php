
<!-- resources/views/factura.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Factura de Venta</h2>
        <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
        <p><strong>ID Venta:</strong> {{ $venta->id_venta }}</p>
        <p><strong>Cliente:</strong> {{ $cliente->nombre }}</p>
    </div>

    <table>
        <tr>
            <th>Total a Pagar</th>
            <th>Estado</th>
        </tr>
        <tr>
            <td>{{ $venta->totalPagar }}</td>
            <td>{{ $venta->estado }}</td>
        </tr>
    </table>
</body>
</html>
