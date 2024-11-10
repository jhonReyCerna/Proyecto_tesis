@extends('adminlte::page')

@section('title', 'Detalles de la Venta')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary">Detalles de la Venta #{{ $venta->id_venta }}</h1>
        <a href="{{ route('ventas.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Volver al Listado
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <!-- Información de la Venta -->
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-header bg-info text-white">
                <i class="fas fa-receipt"></i> Información de la Venta
            </div>
            <div class="card-body">
                <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
                <p><strong>Fecha de Venta:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }}</p>
                <p><strong>Total a Pagar:</strong> <span class="badge bg-success fs-5">S/. {{ number_format($venta->totalPagar, 2) }}</span></p>
                <p><strong>Estado:</strong>
                    <span class="badge {{ $venta->estado == 'Completado' ? 'bg-success' : 'bg-warning' }}">
                        {{ $venta->estado }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Resumen de Productos -->
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary text-white">
                <i class="fas fa-boxes"></i> Detalles de los Productos Vendidos
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio Unitario</th>
                            <th class="text-center">Descuento</th>
                            <th class="text-center">IGV</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Cambio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($venta->detalles as $detalle)
                            <tr>
                                <td><i class="fas fa-tag text-info"></i> {{ $detalle->producto->nombre }}</td>
                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                <td class="text-center">S/. {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="text-center">S/. {{ number_format($detalle->descuento, 2) }}</td>
                                <td class="text-center">S/. {{ number_format($detalle->igv, 2) }}</td>
                                <td class="text-center">S/. {{ number_format($detalle->subtotal, 2) }}</td>
                                <td class="text-center">S/. {{ number_format($detalle->cambio, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total:</strong></td>
                            <td colspan="2" class="text-center fs-5 text-success">
                                <strong>S/. {{ number_format($venta->totalPagar, 2) }}</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Sección de botones adicionales -->
<div class="mt-5 text-center">
    <a href="{{ route('ventas.index') }}" class="btn btn-lg btn-primary">
        <i class="fas fa-list"></i> Ver Todas las Ventas
    </a>
    <a href="#" class="btn btn-lg btn-danger">
        <i class="fas fa-file-pdf"></i> Descargar PDF
    </a>
</div>
@endsection
