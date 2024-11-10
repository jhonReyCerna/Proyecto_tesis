@extends('adminlte::page')

@section('title', 'Detalles de Venta')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center text-info mb-4">Detalles de Venta</h2>

        <!-- Datos Generales de la Venta -->
        <div class="card p-4 rounded-lg shadow-lg mb-4">
            <h4 class="font-weight-bold">Información de la Venta</h4>
            <div class="form-row">
                <!-- Cliente -->
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-muted">Cliente</label>
                    <p>{{ $venta->cliente->nombre }}</p>
                </div>

                <!-- Total a Pagar -->
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-muted">Total a Pagar</label>
                    <p>{{ number_format($venta->totalPagar, 2, ',', '.') }}</p>
                </div>
            </div>

            <div class="form-row">
                <!-- Fecha de Venta -->
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-muted">Fecha de Venta</label>
                    <p>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</p>
                </div>

                <!-- Estado -->
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-muted">Estado</label>
                    <span class="badge
                        @if($venta->estado == 'Completada') bg-success
                        @elseif($venta->estado == 'Pendiente') bg-warning text-dark
                        @else bg-danger @endif">
                        {{ ucfirst($venta->estado) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Detalles de los Productos -->
        <div class="card p-4 rounded-lg shadow-lg">
            <h4 class="font-weight-bold">Productos Comprados</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total Producto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                            <td>{{ number_format($detalle->total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Detalles de Descuento -->
        <div class="card p-4 rounded-lg shadow-lg mt-4">
            <h4 class="font-weight-bold">Resumen de Descuento</h4>
            <div class="form-row">
                <!-- Descuento -->
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-muted">Descuento (%)</label>
                    <p>{{ number_format($venta->descuento, 2, ',', '.') }}%</p>
                </div>

                <!-- Total con Descuento -->
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-muted">Total con Descuento</label>
                    <p>{{ number_format($venta->totalConDescuento, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary px-5">Volver al Listado</a>
        </div>
    </div>
@endsection
