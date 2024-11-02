@extends('adminlte::page')

@section('title', 'Detalles de la Venta')

@section('content_header')
    <h1>Detalles de la Venta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Venta #{{ $venta->id_venta }}</h3>
        </div>

        <div class="card-body">
            <p><strong>Producto: </strong>{{ $venta->producto->nombre }}</p>
            <p><strong>Cliente: </strong>{{ $venta->cliente->nombre }}</p>
            <p><strong>Cantidad: </strong>{{ $venta->cantidad }}</p>
            <p><strong>Subtotal: </strong>{{ $venta->subtotal }}</p>
            <p><strong>Impuesto: </strong>{{ $venta->impuesto }}</p>
            <p><strong>Descuento: </strong>{{ $venta->descuento }}</p>
            <p><strong>Total: </strong>{{ $venta->total }}</p>
            <p><strong>Método de Pago: </strong>{{ ucfirst($venta->metodo_pago) }}</p>
            <p><strong>Fecha: </strong>{{ $venta->fecha }}</p>
        </div>

        <div class="card-footer">
            <a href="{{ route('ventas.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@stop
