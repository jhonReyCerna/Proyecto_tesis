@extends('adminlte::page')

@section('title', 'Crear Detalle de Venta')

@section('content_header')
    <h1>Crear Detalle de Venta</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ventadetalles.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="id_venta" class="form-label">ID Venta</label>
                        <input type="text" name="id_venta" class="form-control" value="{{ $id_venta }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="id_producto" class="form-label">ID Producto</label>
                        <input type="text" name="id_producto" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="id_cliente" class="form-label">ID Cliente</label>
                        <input type="text" name="id_cliente" class="form-control" value="{{ $cliente->nombre }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="number" step="0.01" name="precio_unitario" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="descuento" class="form-label">Descuento</label>
                        <input type="number" step="0.01" name="descuento" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="igv" class="form-label">IGV</label>
                        <input type="number" step="0.01" name="igv" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="subtotal" class="form-label">Subtotal</label>
                        <input type="number" step="0.01" name="subtotal" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="cambio" class="form-label">Cambio</label>
                        <input type="number" step="0.01" name="cambio" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </form>
@stop
