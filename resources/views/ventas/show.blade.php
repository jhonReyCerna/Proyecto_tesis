@extends('adminlte::page')

@section('title', 'Detalles de la Venta')

@section('content_header')
    <h1 class="text-center">Detalles de la Venta #{{ $venta->id_venta }}</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Información de la Venta</h3>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Cliente:</strong> {{ $venta->cliente->nombre }} <br>
                <strong>Fecha de Venta:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }} <br>
                <strong>Total a Pagar:</strong> <span class="badge bg-success">S/. {{ number_format($venta->totalPagar, 2) }}</span> <br>
                <strong>Estado:</strong>
                <span class="badge {{ $venta->estado == 'Completado' ? 'bg-success' : 'bg-warning' }}">
                    {{ $venta->estado }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-secondary text-white">
        <h3 class="card-title">Detalles de los Productos Vendidos</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover">
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
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td class="text-center">{{ $detalle->cantidad }}</td>
                        <td class="text-center">S/. {{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td class="text-center">S/. {{ number_format($detalle->descuento, 2) }}</td>
                        <td class="text-center">S/. {{ number_format($detalle->igv, 2) }}</td>
                        <td class="text-center">S/. {{ number_format($detalle->subtotal, 2) }}</td>
                        <td class="text-center">S/. {{ number_format($detalle->cambio, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <td colspan="5" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2" class="text-center"><strong>S/. {{ number_format($venta->totalPagar, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    <a href="{{ route('ventas.index') }}" class="btn btn-lg btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Listado
    </a>
</div>
@endsection
