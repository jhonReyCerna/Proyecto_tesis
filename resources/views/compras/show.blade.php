@extends('adminlte::page')

@section('title', 'Detalles de Compra')

@section('content_header')
    <h1>Detalles de Compra</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>ID de Compra: {{ $compra->id_compra }}</h4>
            <h4>Producto: {{ $compra->producto->nombre }}</h4>
            <h4>Proveedor: {{ $compra->proveedor->nombre }}</h4>
            <h4>Cantidad: {{ $compra->cantidad }}</h4>
            <h4>Fecha: 
                @if ($compra->fecha)
                    {{ \Carbon\Carbon::parse($compra->fecha)->format('Y-m-d') }}
                @else
                    N/A
                @endif
            </h4>
            <h4>Almacén: {{ $compra->almacen->nombre }}</h4>
            <h4>Precio Unitario: {{ number_format($compra->precio_unitario, 2) }}</h4>
            <h4>Total: {{ number_format($compra->total, 2) }}</h4>
            <h4>Estado: 
                @if($compra->estado == 'pendiente')
                    Completada
                @else
                    {{ ucfirst($compra->estado) }}
                @endif
            </h4>
        </div>
    </div>
    <a href="{{ route('compras.index') }}" class="btn btn-primary">Regresar</a>
@stop
