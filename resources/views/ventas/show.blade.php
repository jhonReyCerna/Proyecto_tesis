@extends('adminlte::page')

@section('title', 'Detalles de la Venta')

@section('content_header')
    <h1 class="text-info fw-bold">Detalles de la Venta #{{ $venta->id_venta }}</h1>
@endsection

@section('content')
<div class="row gy-4">

    <div class="col-md-4">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #6dd5ed, #2193b0); color: white;">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-user-circle me-2"></i> Información del Cliente
                </h5>
                <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
                <p><strong>Fecha de Venta:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d M, Y - H:i A') }}</p>
                <p><strong>Total a Pagar:</strong>
                    @php
                        $totalSubtotal = $venta->detalles->sum('subtotal');
                        $igv = $totalSubtotal * 0.18;
                        $totalConIgv = $totalSubtotal + $igv;
                    @endphp
                    <span class="badge bg-light text-dark fs-5">S/. {{ number_format($totalConIgv, 2) }}</span>
                </p>
                <p><strong>Estado:</strong>
                    <span class="badge {{ $venta->estado == 'Completado' ? 'bg-success' : 'bg-warning' }}">
                        {{ $venta->estado }}
                    </span>
                </p>
            </div>
        </div>
    </div>


    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header text-white" style="background: #2a9d8f;">
                <i class="fas fa-box-open me-2"></i> Detalles de los Productos Vendidos
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-hover align-middle">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio Unitario</th>
                            <th class="text-center">Descuento</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($venta->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                <td class="text-center">S/. {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="text-center text-danger">S/. {{ number_format($detalle->descuento, 2) }}</td>
                                <td class="text-center fw-bold">S/. {{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-info">
                            <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                            <td class="text-center fs-5 text-primary">
                                <strong>S/. {{ number_format($totalSubtotal, 2) }}</strong>
                            </td>
                        </tr>
                        <tr class="table-info">
                            <td colspan="4" class="text-end"><strong>IGV (18%):</strong></td>
                            <td class="text-center fs-5 text-primary">
                                <strong>S/. {{ number_format($igv, 2) }}</strong>
                            </td>
                        </tr>
                        <tr class="table-info">
                            <td colspan="4" class="text-end"><strong>Total General:</strong></td>
                            <td class="text-center fs-5 text-primary">
                                <strong>S/. {{ number_format($totalConIgv, 2) }}</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-5">
    <a href="{{ route('ventas.index') }}" class="btn btn-lg btn-outline-secondary me-3">
        <i class="fas fa-undo-alt"></i> Volver al Listado
    </a>
    <a href="#" class="btn btn-lg btn-success me-3">
        <i class="fas fa-print"></i> Imprimir Recibo
    </a>
    <a href="{{ route('ventas.factura', $venta->id_venta) }}" class="btn btn-lg btn-danger">
        <i class="fas fa-file-pdf"></i> Factura PDF
    </a>
</div>
@endsection
