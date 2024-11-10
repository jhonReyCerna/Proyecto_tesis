@extends('adminlte::page')
@section('title', 'Registrar Venta')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-primary font-weight-bold">Registrar Venta</h2>

        <form action="{{ route('ventas.store') }}" method="POST" class="bg-light shadow-lg rounded p-5" id="form-venta">
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
                            <option value="" disabled selected>Seleccionar cliente</option> <!-- Opción por defecto -->
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
                                    <option value="" disabled selected>Seleccionar producto</option> <!-- Opción por defecto -->
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="detalles[0][cantidad]" class="form-control cantidad" required min="1" oninput="actualizarTotalProducto(this)">
                                <div class="error-cantidad text-danger"></div>
                            </div>

                            <div class="form-group">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="text" name="detalles[0][precio_unitario]" class="form-control precio_unitario" readonly>
                                <div class="error-precio text-danger"></div>
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
                        <input type="number" name="descuento" id="descuento" class="form-control" step="0.01" min="0" max="100" placeholder="Descuento en porcentaje (opcional)" oninput="calcularTotal()">
                        <div class="error-descuento text-danger"></div>
                        <small class="form-text text-muted">No es necesario proporcionar un descuento en todas las ventas.</small>
                    </div>


                    <!-- Total con Descuento -->
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
        totalPagar = totalConDescuento;  // Actualizamos totalPagar con el valor con descuento
    }

    document.getElementById('totalPagar').value = totalPagar.toFixed(2);  // Mostrar total con descuento en "Total a Pagar"
}

        // Función para actualizar el total del producto cuando se cambia la cantidad
        function actualizarTotalProducto(cantidadInput) {
            let productoItem = cantidadInput.closest('.producto-item');
            let cantidad = parseFloat(cantidadInput.value);
            let precioUnitario = parseFloat(productoItem.querySelector('.precio_unitario').value);
            let totalProducto = cantidad * precioUnitario;

            productoItem.querySelector('.total_producto').value = totalProducto.toFixed(2);
            calcularTotal();
        }

        // Validaciones en tiempo real
        document.addEventListener('input', function(e) {
            if (e.target && e.target.classList.contains('cantidad')) {
                let cantidad = parseFloat(e.target.value);
                let errorCantidad = e.target.closest('.detalle-producto').querySelector('.error-cantidad');
                if (isNaN(cantidad) || cantidad <= 0) {
                    errorCantidad.textContent = 'La cantidad debe ser un número positivo mayor que 0.';
                } else {
                    errorCantidad.textContent = '';
                }
            }

            if (e.target && e.target.classList.contains('precio_unitario')) {
                let precioUnitario = parseFloat(e.target.value);
                let errorPrecio = e.target.closest('.detalle-producto').querySelector('.error-precio');
                if (isNaN(precioUnitario) || precioUnitario <= 0) {
                    errorPrecio.textContent = 'El precio unitario debe ser un número positivo.';
                } else {
                    errorPrecio.textContent = '';
                }
            }

            if (e.target && e.target.id === 'descuento') {
                let descuento = parseFloat(e.target.value);
                let errorDescuento = document.querySelector('.error-descuento');
                if (descuento < 0 || descuento > 100 || isNaN(descuento)) {
                    errorDescuento.textContent = 'El descuento debe estar entre 0 y 100%.';
                } else {
                    errorDescuento.textContent = '';
                }
            }
        });

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
            newProduct.querySelectorAll('input').forEach(function(input) {
                input.value = '';
            });
            newProduct.querySelector('.remove-producto').addEventListener('click', function() {
                newProduct.remove();
                calcularTotal();
            });
            document.querySelector('.productos-container').appendChild(newProduct);
        });

        // Eliminar producto
        document.querySelectorAll('.remove-producto').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('.producto-item').remove();
                calcularTotal();
            });
        });

        // Inicializar Select2
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
