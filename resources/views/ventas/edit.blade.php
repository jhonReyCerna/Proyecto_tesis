
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Venta</h1>

        <form action="{{ route('ventas.update', $venta->id_venta) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_cliente">Cliente</label>
                <select class="form-control" name="id_cliente" id="id_cliente" required>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}" {{ $cliente->id_cliente == $venta->id_cliente ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="totalPagar">Total a Pagar</label>
                <input type="number" step="0.01" class="form-control" name="totalPagar" value="{{ $venta->totalPagar }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_venta">Fecha de Venta</label>
                <input type="date" class="form-control" name="fecha_venta" value="{{ $venta->fecha_venta }}" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" name="estado" value="{{ $venta->estado }}" required>
            </div>

            <h3>Detalles de la Venta</h3>

            <div id="detalles">
                @foreach ($venta->detalles as $detalle)
                    <div class="detalle-item">
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <select class="form-control producto" name="productos[]" required>
                                <option value="">Seleccione un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id_producto }}" {{ $producto->id_producto == $detalle->id_producto ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control cantidad" name="cantidad[]" value="{{ $detalle->cantidad }}" required>
                        </div>

                        <div class="form-group">
                            <label for="precio_unitario">Precio Unitario</label>
                            <input type="number" step="0.01" class="form-control precio_unitario" name="precio_unitario[]" value="{{ $detalle->precio_unitario }}" required>
                        </div>

                        <div class="form-group">
                            <label for="descuento">Descuento</label>
                            <input type="number" step="0.01" class="form-control descuento" name="descuento[]" value="{{ $detalle->descuento }}">
                        </div>

                        <div class="form-group">
                            <label for="igv">IGV</label>
                            <input type="number" step="0.01" class="form-control igv" name="igv[]" value="{{ $detalle->igv }}">
                        </div>

                        <div class="form-group">
                            <label for="subtotal">Subtotal</label>
                            <input type="number" step="0.01" class="form-control subtotal" name="subtotal[]" value="{{ $detalle->subtotal }}" required>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar Venta</button>
        </form>
    </div>
@endsection
