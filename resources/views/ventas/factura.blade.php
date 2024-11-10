<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Venta #{{ $venta->id_venta }}</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #f4f6f8;
            color: #333;
        }

        h1, h2, h3 {
            font-family: 'Helvetica Neue', sans-serif;
            color: #2c3e50;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header h3 {
            font-size: 16px;
            color: #7f8c8d;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            font-size: 14px;
        }

        .table th {
            background-color: #2a9d8f;
            color: #fff;
        }

        .table td {
            background-color: #f9f9f9;
        }

        .table .subtotal {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
            padding-top: 10px;
            border-top: 2px solid #2c3e50;
        }

        .total .amount {
            color: #e74c3c;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
        }

        .footer a {
            color: #2a9d8f;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Factura de Venta #{{ $venta->id_venta }}</h1>
            <h3>Fecha: {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d M, Y - H:i A') }}</h3>
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Descuento</th>
                    <th>IGV</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>S/. {{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td>S/. {{ number_format($detalle->descuento, 2) }}</td>
                        <td>S/. {{ number_format($detalle->igv, 2) }}</td>
                        <td>S/. {{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p><strong>Total a Pagar:</strong> <span class="amount">S/. {{ number_format($venta->totalPagar, 2) }}</span></p>
        </div>

        <div class="footer">
            <p>Gracias por su compra.</p>
            <p><a href="#">Ver más detalles en nuestro sitio web</a></p>
        </div>
    </div>

</body>
</html>
