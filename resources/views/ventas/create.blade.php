@extends('adminlte::page')
@section('title', 'Registrar Venta')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-primary font-weight-bold">Registrar Venta</h2>

        <form action="{{ route('ventas.store') }}" method="POST" class="bg-light shadow-lg rounded p-5">
            @csrf
            <div class="card">
                <div class="card-header bg-gradient-primary text-white text-center py-3">
                    <h5><i class="fas fa-cash-register"></i> Detalles de la Venta</h5>
                </div>
                <div class="card-body">
                    <!-- Cliente -->
                    <div class="form-group mb-4">
                        <label for="id_cliente" class="form-label">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-control select2" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Productos -->
                    <div class="productos-container">
                        <div class="detalle-producto mb-4 producto-item">
                            <div class="form-group">
                                <label for="producto" class="form-label">Producto</label>
                                <select name="detalles[0][id_producto]" class="form-control producto" required>
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="detalles[0][cantidad]" class="form-control cantidad" required>
                            </div>

                            <div class="form-group">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="text" name="detalles[0][precio_unitario]" class="form-control precio_unitario" readonly>
                            </div>

                            <div class="form-group">
                                <label for="totalProducto" class="form-label">Total Producto</label>
                                <input type="number" name="detalles[0][total]" class="form-control total_producto" readonly>
                            </div>

                            <button type="button" class="btn btn-danger btn-sm remove-producto">Eliminar Producto</button>
                        </div>
                    </div>

                    <!-- Botón para agregar más productos -->
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-sm" id="add-producto">Agregar Producto</button>
                    </div>

                    <!-- Total a Pagar -->
                    <div class="form-group mb-4">
                        <label for="totalPagar" class="form-label">Total a Pagar</label>
                        <input type="number" name="totalPagar" id="totalPagar" class="form-control" placeholder="Total antes del descuento" required readonly>
                    </div>

                    <!-- Descuento -->
                    <div class="form-group mb-4">
                        <label for="descuento" class="form-label">Descuento (%)</label>
                        <input type="number" name="descuento" id="descuento" class="form-control" step="0.01" min="0" max="100" placeholder="Descuento en porcentaje" oninput="calcularTotal()" required>
                    </div>

                    <!-- Total con Descuento -->
                    <div class="form-group mb-4">
                        <label for="totalConDescuento" class="form-label">Total con Descuento</label>
                        <input type="number" name="totalConDescuento" id="totalConDescuento" class="form-control" readonly>
                    </div>

                    <!-- Fecha de Venta -->
                    <div class="form-group mb-4">
                        <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                        <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
                    </div>

                    <!-- Estado -->
                    <div class="form-group mb-4">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Completada">Completada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>

                    <!-- Botón de acción -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg mt-3 px-5 py-2">Registrar Venta</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Calcular total con descuento
        function calcularTotal() {
            let totalPagar = 0;
            document.querySelectorAll('.detalle-producto').forEach(function(item) {
                let cantidad = parseFloat(item.querySelector('.cantidad').value);
                let precio_unitario = parseFloat(item.querySelector('.precio_unitario').value);
                let totalProducto = cantidad * precio_unitario;
                item.querySelector('.total_producto').value = totalProducto.toFixed(2); // Mostrar total del producto

                if (!isNaN(totalProducto)) {
                    totalPagar += totalProducto;
                }
            });

            let descuento = parseFloat(document.getElementById('descuento').value);
            if (!isNaN(descuento)) {
                let totalConDescuento = totalPagar - (totalPagar * descuento / 100);
                document.getElementById('totalConDescuento').value = totalConDescuento.toFixed(2);
            }
            document.getElementById('totalPagar').value = totalPagar.toFixed(2);
        }

        // Cambiar precio unitario y recalcular al seleccionar producto
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('producto')) {
                let selectedOption = e.target.options[e.target.selectedIndex];
                let precioUnitario = parseFloat(selectedOption.getAttribute('data-precio'));
                let productoItem = e.target.closest('.producto-item');
                productoItem.querySelector('.precio_unitario').value = precioUnitario.toFixed(2);
                calcularTotal(); // Recalcular el total
            }
        });

        // Agregar más productos
        document.getElementById('add-producto').addEventListener('click', function() {
            let newProduct = document.querySelector('.producto-item').cloneNode(true);
            let productoCount = document.querySelectorAll('.producto-item').length;
            newProduct.querySelector('select').name = `detalles[${productoCount}][id_producto]`;
            newProduct.querySelector('input[name="detalles[0][cantidad]"]').name = `detalles[${productoCount}][cantidad]`;
            newProduct.querySelector('input[name="detalles[0][precio_unitario]"]').name = `detalles[${productoCount}][precio_unitario]`;
            newProduct.querySelector('input[name="detalles[0][total]"]').name = `detalles[${productoCount}][total]`;
            document.querySelector('.productos-container').appendChild(newProduct);
            calcularTotal();
        });

        // Eliminar un producto
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-producto')) {
                e.target.closest('.producto-item').remove();
                calcularTotal();
            }
        });

        // Inicializar select2
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: 'Seleccione una opción',
                allowClear: true
            });
        });
    </script>
@endsection
