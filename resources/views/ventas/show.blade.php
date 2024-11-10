@extends('layouts.app')

@section('content')
    <h1>Detalles de la Venta #{{ $venta->id_venta }}</h1>

    <div class="mb-3">
        <strong>Cliente:</strong> {{ $venta->cliente->nombre }} <br>
        <strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }} <br>
        <strong>Total a Pagar:</strong> S/. {{ number_format($venta->totalPagar, 2) }} <br>
        <strong>Estado:</strong> {{ $venta->estado }} <br>
    </div>

    <h3>Detalles de los Productos Vendidos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Descuento</th>
                <th>IGV</th>
                <th>Subtotal</th>
                <th>Cambio</th>
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
                    <td>S/. {{ number_format($detalle->cambio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver al Listado</a>
@endsection
