<!-- resources/views/ventadetalles/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Editar Detalle de Venta</h1>

    <form action="{{ route('ventadetalles.update', $ventaDetalle->id_detalle) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_venta">ID Venta</label>
            <input type="text" name="id_venta" class="form-control" value="{{ $ventaDetalle->id_venta }}" required>
        </div>
        <div class="form-group">
            <label for="id_producto">ID Producto</label>
            <input type="text" name="id_producto" class="form-control" value="{{ $ventaDetalle->id_producto }}" required>
        </div>
        <div class="form-group">
            <label for="id_cliente">ID Cliente</label>
            <input type="text" name="id_cliente" class="form-control" value="{{ $ventaDetalle->id_cliente }}" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $ventaDetalle->cantidad }}" required>
        </div>
        <div class="form-group">
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" class="form-control" value="{{ $ventaDetalle->precio_unitario }}" required>
        </div>
        <div class="form-group">
            <label for="descuento">Descuento</label>
            <input type="number" step="0.01" name="descuento" class="form-control" value="{{ $ventaDetalle->descuento }}">
        </div>
        <div class="form-group">
            <label for="igv">IGV</label>
            <input type="number" step="0.01" name="igv" class="form-control" value="{{ $ventaDetalle->igv }}">
        </div>
        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" step="0.01" name="subtotal" class="form-control" value="{{ $ventaDetalle->subtotal }}" required>
        </div>
        <div class="form-group">
            <label for="cambio">Cambio</label>
            <input type="number" step="0.01" name="cambio" class="form-control" value="{{ $ventaDetalle->cambio }}">
        </div>

        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
@endsection
