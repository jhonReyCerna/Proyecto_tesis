@extends('adminlte::page')
@section('title', 'Detalle de Venta')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-info mb-4">Detalle de la Venta #{{ $venta->id }}</h2>

    <div class="card p-4 rounded-lg shadow-lg">
        <!-- Información del Cliente -->
        <h4 class="text-primary">Información del Cliente</h4>
        <ul class="list-group list-group-flush mb-4">
            <li class="list-group-item"><strong>Nombre del Cliente:</strong> {{ $venta->cliente->nombre ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>DNI:</strong> {{ $venta->cliente->dni ?? 'N/A' }}</li>
        </ul>

        <!-- Detalles de Productos -->
        <h4 class="text-primary">Detalles de Productos</h4>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total Producto</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precio_unitario, 2) }} S/</td>
                    <td>{{ number_format($detalle->total, 2) }} S/</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No hay productos en esta venta</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Resumen de Venta -->
        <h4 class="text-primary mt-4">Resumen de Venta</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Total a Pagar:</strong> {{ number_format($venta->totalPagar ?? 0, 2) }} S/</li>
            <li class="list-group-item"><strong>Descuento Aplicado:</strong> {{ $venta->descuento ?? 0 }}%</li>
            <li class="list-group-item"><strong>Total con Descuento:</strong> {{ number_format($venta->totalConDescuento ?? 0, 2) }} S/</li>
            <li class="list-group-item">
                <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta->format('d/m/Y') }}</p>
            </li>
            <li class="list-group-item"><strong>Estado:</strong> {{ $venta->estado ?? 'Desconocido' }}</li>
        </ul>

        <!-- Botón de Regreso -->
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver a la Lista</a>
        </div>
    </div>
</div>
@endsection
