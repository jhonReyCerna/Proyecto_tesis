@extends('adminlte::page')
@section('title', 'Registrar Venta')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center text-info mb-4">Registrar Venta</h2>

        <form action="{{ route('ventas.store') }}" method="POST" class="card p-4 rounded-lg shadow-lg">
            @csrf
            <div class="form-row">
                <!-- Campo Cliente -->
                <div class="form-group col-md-6">
                    <label for="id_cliente" class="font-weight-bold text-muted">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control form-control-lg" required>
                        <option value="" disabled selected>Seleccionar Cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo DNI para búsqueda con botón Buscar -->
                <div class="form-group col-md-6 ">
                    <label for="dni" class="font-weight-bold text-muted mr-4">Buscar por DNI</label>
                    <div class="input-group">
                        <input type="text" name="dni" id="dni" class="form-control form-control-lg" placeholder="Ingrese DNI" oninput="buscarPorDni()" />
                        <div class="input-group-append">
                            <button type="button" class="btn btn-info px-4" onclick="buscarPorDni()">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="productos-container">
                <div class="detalle-producto mb-4 p-4 border rounded-lg shadow-sm">
                    <div class="form-group">
                        <label for="producto" class="font-weight-bold text-muted">Producto</label>
                        <select name="detalles[0][id_producto]" class="form-control producto form-control-lg" required>
                            <option value="" disabled selected>Seleccionar Producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cantidad" class="font-weight-bold text-muted">Cantidad</label>
                        <input type="number" name="detalles[0][cantidad]" class="form-control form-control-lg cantidad" required min="1" oninput="actualizarTotalProducto(this)">
                    </div>

                    <div class="form-group">
                        <label for="precio_unitario" class="font-weight-bold text-muted">Precio Unitario</label>
                        <input type="text" name="detalles[0][precio_unitario]" class="form-control form-control-lg precio_unitario" readonly>
                    </div>

                    <div class="form-group">
                        <label for="totalProducto" class="font-weight-bold text-muted">Total Producto</label>
                        <input type="number" name="detalles[0][total]" class="form-control form-control-lg total_producto" readonly>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm remove-producto">Eliminar Producto</button>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary" id="add-producto">Agregar Producto</button>

            <div class="form-group mt-4">
                <label for="totalPagar" class="font-weight-bold text-muted">Total a Pagar</label>
                <input type="number" name="totalPagar" id="totalPagar" class="form-control form-control-lg" required readonly>
            </div>

            <div class="form-group">
                <label for="descuento" class="font-weight-bold text-muted">Descuento (%)</label>
                <input type="number" name="descuento" id="descuento" class="form-control form-control-lg" step="0.01" min="0" max="100" oninput="calcularTotal()">
            </div>

            <div class="form-group">
                <label for="totalConDescuento" class="font-weight-bold text-muted">Total con Descuento</label>
                <input type="number" name="totalConDescuento" id="totalConDescuento" class="form-control form-control-lg" readonly>
            </div>

            <div class="form-group">
                <label for="fecha_venta" class="font-weight-bold text-muted">Fecha de Venta</label>
                <input type="date" name="fecha_venta" id="fecha_venta" class="form-control form-control-lg" required>
            </div>

            <div class="form-group">
                <label for="estado" class="font-weight-bold text-muted">Estado</label>
                <select name="estado" id="estado" class="form-control form-control-lg" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Completada">Completada</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-info px-5">Registrar Venta</button>
            </div>
        </form>
    </div>

    <script>
        // Función para buscar cliente por DNI
        function buscarPorDni() {
            let dni = document.getElementById('dni').value;
            // Lógica para buscar el cliente según el DNI ingresado (puedes hacer una solicitud AJAX si es necesario)
            console.log('Buscando cliente por DNI:', dni);
        }

        // Calcular total con descuento
        function calcularTotal() {
            let totalPagar = 0;
            document.querySelectorAll('.detalle-producto').forEach(function(item) {
                let cantidad = parseFloat(item.querySelector('.cantidad').value);
                let precio_unitario = parseFloat(item.querySelector('.precio_unitario').value);
                let totalProducto = cantidad * precio_unitario;
                item.querySelector('.total_producto').value = totalProducto.toFixed(2);

                if (!isNaN(totalProducto)) {
                    totalPagar += totalProducto;
                }
            });

            let descuento = parseFloat(document.getElementById('descuento').value);
            if (!isNaN(descuento)) {
                let totalConDescuento = totalPagar - (totalPagar * descuento / 100);
                document.getElementById('totalConDescuento').value = totalConDescuento.toFixed(2);
                totalPagar = totalConDescuento;  // Actualizamos totalPagar con el valor con descuento
            }

            document.getElementById('totalPagar').value = totalPagar.toFixed(2);  // Mostrar total con descuento en "Total a Pagar"
        }

        // Función para actualizar el total del producto cuando se cambia la cantidad
        function actualizarTotalProducto(cantidadInput) {
            let productoItem = cantidadInput.closest('.detalle-producto');
            let cantidad = parseFloat(cantidadInput.value);
            let precioUnitario = parseFloat(productoItem.querySelector('.precio_unitario').value);
            let totalProducto = cantidad * precioUnitario;

            productoItem.querySelector('.total_producto').value = totalProducto.toFixed(2);
            calcularTotal();
        }

        // Cambiar precio unitario y recalcular al seleccionar producto
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('producto')) {
                let selectedOption = e.target.options[e.target.selectedIndex];
                let precioUnitario = parseFloat(selectedOption.getAttribute('data-precio'));
                let precioInput = e.target.closest('.detalle-producto').querySelector('.precio_unitario');
                precioInput.value = precioUnitario.toFixed(2);
                actualizarTotalProducto(e.target.closest('.detalle-producto').querySelector('.cantidad'));
            }
        });

        // Agregar nuevo producto al formulario
        document.getElementById('add-producto').addEventListener('click', function() {
            let lastProductoItem = document.querySelector('.detalle-producto:last-child');
            let newProductoItem = lastProductoItem.cloneNode(true);

            // Limpiar los campos del nuevo producto
            let inputs = newProductoItem.querySelectorAll('input');
            inputs.forEach(input => input.value = '');

            // Insertar el nuevo producto al final
            document.querySelector('.productos-container').appendChild(newProductoItem);
        });

        // Eliminar producto
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-producto')) {
                e.target.closest('.detalle-producto').remove();
                calcularTotal();
            }
        });
    </script>
@stop
