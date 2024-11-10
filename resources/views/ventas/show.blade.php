@extends('adminlte::page')

@section('title', 'Detalles de la Venta')

@section('content')
    <h2>Detalles de la Venta</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($venta)
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Venta #{{ $venta->id_venta }} - Cliente: {{ $venta->cliente->nombre ?? 'Cliente no encontrado' }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Fecha de Venta:</strong>
                    @if($venta->fecha_venta)
                        {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}
                    @else
                        <span class="text-muted">Fecha no disponible</span>
                    @endif
                </p>
                <p><strong>Total a Pagar:</strong> S/ {{ number_format($venta->totalPagar, 2) }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($venta->estado) }}</p>

                <h4>Detalles de los Productos</h4>
                @if($venta->detalles && $venta->detalles->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($venta->detalles as $index => $detalle)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detalle->producto->codigo ?? 'N/A' }}</td>
                                        <td>
                                            {{ $detalle->producto->nombre ?? 'Producto no encontrado' }}
                                            @if($detalle->producto->descripcion)
                                                <br>
                                                <small class="text-muted">{{ $detalle->producto->descripcion }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                        <td>S/ {{ number_format($detalle->descuento ?? 0, 2) }}</td>
                                        <td>S/ {{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><strong>Subtotal:</strong></td>
                                    <td>S/ {{ number_format($venta->detalles->sum('subtotal'), 2) }}</td>
                                </tr>
                                @if($venta->descuento > 0)
                                <tr>
                                    <td colspan="5"></td>
                                    <td><strong>Descuento:</strong></td>
                                    <td>S/ {{ number_format($venta->descuento, 2) }}</td>
                                </tr>
                                @endif

                                <tr class="table-info">
                                    <td colspan="5"></td>
                                    <td><strong>Total:</strong></td>
                                    <td><strong>S/ {{ number_format($venta->totalPagar, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No hay detalles de productos para esta venta.
                    </div>
                @endif

                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </div>
    @else
        <div class="alert alert-warning">No se encontraron datos para esta venta.</div>
    @endif
@endsection
