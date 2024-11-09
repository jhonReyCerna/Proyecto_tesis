@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Venta Confirmada</h1>
    <p><strong>Venta ID:</strong> {{ $venta->id_venta }}</p>
    <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
    <p><strong>Total a Pagar:</strong> ${{ number_format($venta->totalPagar, 2) }}</p>
    <p><strong>Estado:</strong> {{ $venta->estado }}</p>

    <h3>Detalles de la Venta</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>{{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
