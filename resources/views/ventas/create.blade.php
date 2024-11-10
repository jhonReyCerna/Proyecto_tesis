@extends('adminlte::page')
@section('title', 'Registrar Venta')

@section('content')
    <h2>Registrar Venta</h2>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Detalles de la Venta</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="id_cliente" class="form-label">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="totalPagar" class="form-label">Total a Pagar</label>
                    <input type="number" name="totalPagar" id="totalPagar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descuento" class="form-label">Descuento (%)</label>
                    <input type="number" name="descuento" id="descuento" class="form-control" step="0.01" min="0" max="100" placeholder="0" oninput="calcularTotal()" required>
                </div>

                <div class="mb-3">
                    <label for="totalConDescuento" class="form-label">Total con Descuento</label>
                    <input type="number" name="totalConDescuento" id="totalConDescuento" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                    <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Completada">Completada</option>
                        <option value="Cancelada">Cancelada</option>
                    </select>
                </div>

                <h4>Detalles de los Productos</h4>
                <div class="detalle-producto">
                    <div class="mb-3">
                        <label for="producto" class="form-label">Producto</label>
                        <select name="detalles[0][id_producto]" class="form-control">
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="detalles[0][cantidad]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="text" name="detalles[0][precio_unitario]" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Registrar Venta</button>
            </div>
        </div>
    </form>

    <script>
        function calcularTotal() {
            let totalPagar = parseFloat(document.getElementById('totalPagar').value);
            let descuento = parseFloat(document.getElementById('descuento').value);
            if (!isNaN(totalPagar) && !isNaN(descuento)) {
                let totalConDescuento = totalPagar - (totalPagar * descuento / 100);
                document.getElementById('totalConDescuento').value = totalConDescuento.toFixed(2);
            }
        }
    </script>
@endsection
