@extends('adminlte::page')

@section('title', 'Agregar Venta')

@section('content_header')
    <h1>Agregar Venta</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="ventaForm" action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body">
                <!-- Información de la venta -->
                <div class="mb-3">
                    <label for="id_cliente" class="form-label">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control">
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                    <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="Pendiente">Pendiente</option>
                        <option value="Pagado">Pagado</option>
                    </select>
                </div>

                <!-- Información de los productos (detalles) -->
                <div id="productos-container">
                    <div class="producto mb-3">
                        <label for="id_producto[]" class="form-label">Producto</label>
                        <select name="productos[0][id_producto]" class="form-control id_producto">
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>

                        <label for="cantidad[]" class="form-label">Cantidad</label>
                        <input type="number" name="productos[0][cantidad]" class="form-control cantidad" required>

                        <label for="precio_unitario[]" class="form-label">Precio Unitario</label>
                        <input type="number" name="productos[0][precio_unitario]" class="form-control precio_unitario" required>

                        <label for="descuento[]" class="form-label">Descuento</label>
                        <input type="number" name="productos[0][descuento]" class="form-control descuento">

                        <label for="igv[]" class="form-label">IGV</label>
                        <input type="number" name="productos[0][igv]" class="form-control igv">

                        <button type="button" class="btn btn-danger eliminar-producto">Eliminar Producto</button>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="agregar-producto">Agregar Producto</button>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar Venta</button>
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas guardar esta venta?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('ventaForm').submit();
                }
            });
        });

        // Agregar un nuevo producto al formulario
        document.getElementById('agregar-producto').addEventListener('click', function () {
            var container = document.getElementById('productos-container');
            var count = container.getElementsByClassName('producto').length;
            var newProduct = document.createElement('div');
            newProduct.classList.add('producto', 'mb-3');
            newProduct.innerHTML = `
                <label for="id_producto[]" class="form-label">Producto</label>
                <select name="productos[${count}][id_producto]" class="form-control id_producto">
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>

                <label for="cantidad[]" class="form-label">Cantidad</label>
                <input type="number" name="productos[${count}][cantidad]" class="form-control cantidad" required>

                <label for="precio_unitario[]" class="form-label">Precio Unitario</label>
                <input type="number" name="productos[${count}][precio_unitario]" class="form-control precio_unitario" required>

                <label for="descuento[]" class="form-label">Descuento</label>
                <input type="number" name="productos[${count}][descuento]" class="form-control descuento">

                <label for="igv[]" class="form-label">IGV</label>
                <input type="number" name="productos[${count}][igv]" class="form-control igv">

                <button type="button" class="btn btn-danger eliminar-producto">Eliminar Producto</button>
            `;
            container.appendChild(newProduct);
        });

        // Eliminar un producto
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('eliminar-producto')) {
                event.target.parentElement.remove();
            }
        });
    </script>
@stop
