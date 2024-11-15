<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Venta #{{ $venta->id_venta }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header .company-logo {
            width: 150px;
            height: auto;
        }

        .header .company-info {
            font-size: 14px;
            text-align: right;
            margin-top: -5px;
        }

        .header .company-info h1 {
            margin: 0;
            font-size: 22px;
            color: #2c3e50;
        }

        .header .company-info p {
            margin: 5px 0;
        }

        .invoice-info {
            font-size: 14px;
            color: #34495e;
            margin-bottom: 20px;
        }

        .invoice-info strong {
            font-weight: 600;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #2980b9;
            color: white;
        }

        .table td {
            background-color: #ecf0f1;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            text-align: right;
            padding-top: 10px;
            border-top: 2px solid #2980b9;
        }

        .total .amount {
            color: #e74c3c;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #7f8c8d;
        }

        .footer a {
            color: #2980b9;
            text-decoration: none;
        }


        .header img.logo {
            width: 200px;
            height: auto;
            max-width: 100%;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="header">

            <div class="company-info">
                <h1>La Curacao</h1>
                <p>Dirección: Jirón Trujillo, Chepén</p>
                <p>Teléfono: (01) 234-5678</p>
                <p>Email: lacuracao@tutienda.com</p>
            </div>
        </div>

        <div class="invoice-info">
            <p><strong>Factura de Venta #{{ $venta->id_venta }}</strong></p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d M, Y - H:i A') }}</p>
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
            <p><strong>Dirección:</strong> {{ $venta->cliente->direccion }}</p>
            <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Descuento</th>
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
                        <td>S/. {{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $totalSubtotal = $venta->detalles->sum('subtotal');
            $igv = $totalSubtotal * 0.18;
            $totalConIgv = $totalSubtotal + $igv;
        @endphp

        <div class="total">
            <p><strong>Subtotal:</strong> <span class="amount">S/. {{ number_format($totalSubtotal, 2) }}</span></p>
            <p><strong>IGV (18%):</strong> <span class="amount">S/. {{ number_format($igv, 2) }}</span></p>
            <p><strong>Total a Pagar:</strong> <span class="amount">S/. {{ number_format($totalConIgv, 2) }}</span></p>
        </div>

        <div class="footer">
            <p>Gracias por su compra en <strong>La Curacao</strong>.</p>
            <p><a href="https://www.tutienda.com">Visítanos en nuestro sitio web</a></p>
        </div>
    </div>

</body>
</html>
