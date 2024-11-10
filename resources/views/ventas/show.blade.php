@extends('adminlte::page')

@section('title', 'Detalles de la Venta')

@section('content')
    <h2>Detalles de la Venta</h2>

    <div class="card">
        <div class="card-header bg-info text-white">
            <h5>Venta #{{ $venta->id_venta }} - Cliente: {{ $venta->cliente->nombre }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta->format('d/m/Y') }}</p>
            <p><strong>Total a Pagar:</strong> S/ {{ number_format($venta->totalPagar, 2) }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($venta->estado) }}</p>

            <h4>Detalles de los Productos</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>S/ {{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
@endsection
