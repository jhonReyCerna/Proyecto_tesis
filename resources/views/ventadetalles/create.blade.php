<!-- resources/views/ventadetalles/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Crear Detalle de Venta</h1>

    <form action="{{ route('ventadetalles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_venta">ID Venta</label>
            <input type="text" name="id_venta" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_producto">ID Producto</label>
            <input type="text" name="id_producto" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_cliente">ID Cliente</label>
            <input type="text" name="id_cliente" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descuento">Descuento</label>
            <input type="number" step="0.01" name="descuento" class="form-control">
        </div>
        <div class="form-group">
            <label for="igv">IGV</label>
            <input type="number" step="0.01" name="igv" class="form-control">
        </div>
        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" step="0.01" name="subtotal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cambio">Cambio</label>
            <input type="number" step="0.01" name="cambio" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@endsection
