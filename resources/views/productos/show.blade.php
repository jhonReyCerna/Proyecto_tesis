@extends('adminlte::page')

@section('title', 'Detalles del Producto')

@section('content_header')
    <h1>Detalles del Producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $producto->nombre }}</h3>
        </div>
        <div class="card-body">
            <h5><strong>ID:</strong> {{ $producto->id_producto }}</h5>
            <h5><strong>Nombre:</strong> {{ $producto->nombre }}</h5>
            <h5><strong>Descripción:</strong> {{ $producto->descripcion }}</h5>
            <h5><strong>Precio:</strong> {{ number_format($producto->precio, 2) }} {{ $producto->moneda }}</h5>
            <h5><strong>Cantidad Disponible:</strong> {{ $producto->cantidad_disponible }}</h5>
            <h5><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</h5> 
            <h5><strong>Proveedor:</strong> {{ $producto->proveedor->nombre }}</h5> 
            
        </div>
        <div class="card-footer">
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@stop
