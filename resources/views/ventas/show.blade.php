@extends('adminlte::page')

@section('title', 'Ver Venta')

@section('content_header')
    <h1>Detalles de la Venta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>ID de Venta:</strong> {{ $venta->id_venta }}</p>
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
            <p><strong>Total a Pagar:</strong> {{ $venta->totalPagar }}</p>
            <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
            <p><strong>Estado:</strong> {{ $venta->estado }}</p>
        </div>
    </div>

    <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-warning mt-3">Editar Venta</a>
    <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Eliminar Venta</button>
    </form>
@stop
