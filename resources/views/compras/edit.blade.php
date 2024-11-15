@extends('adminlte::page')

@section('title', 'Editar Compra')

@section('content_header')
    <h1>Editar Compra</h1>
@stop

@section('content')
    <form id="compraForm" action="{{ route('compras.update', $compra) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="producto_id">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <option value="">Seleccionar Producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_producto }}" {{ $producto->id_producto == $compra->producto_id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="proveedor_id">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                <option value="">Seleccionar Proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}" {{ $proveedor->id_proveedor == $compra->proveedor_id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $compra->cantidad }}" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ \Carbon\Carbon::parse($compra->fecha)->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="almacen_id">Almacén</label>
            <select name="almacen_id" id="almacen_id" class="form-control" required>
                <option value="">Seleccionar Almacén</option>
                @foreach ($almacenes as $almacen)
                    <option value="{{ $almacen->id_almacen }}" {{ $almacen->id_almacen == $compra->almacen_id ? 'selected' : '' }}>{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" class="form-control" value="{{ $compra->precio_unitario }}" id="precio_unitario" required>
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" step="0.01" name="total" class="form-control" id="total" value="{{ $compra->total }}" readonly>

        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ $compra->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-primary" id="actualizarBtn">Actualizar Compra</button>
            <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function calcularTotal() {
            const cantidad = parseFloat(document.querySelector('input[name="cantidad"]').value) || 0;
            const precioUnitario = parseFloat(document.querySelector('input[name="precio_unitario"]').value) || 0;
            const total = cantidad * precioUnitario;
            document.getElementById('total').value = total.toFixed(2);
        }

        document.querySelector('input[name="cantidad"]').addEventListener('input', calcularTotal);
        document.getElementById('precio_unitario').addEventListener('input', calcularTotal);

        document.getElementById('actualizarBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas actualizar esta compra?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('compraForm').submit();
                }
            });
        });
    </script>
@stop
