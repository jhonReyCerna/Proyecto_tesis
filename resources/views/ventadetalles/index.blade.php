@extends('adminlte::page')

@section('title', 'Lista de Ventas')

@section('content_header')
    <h1>Lista de Ventas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="" method="POST" id="clienteForm" onsubmit="return false;">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Campo Cliente -->
                    <div class="col-md-4">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option value="">Seleccionar Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" data-dni="{{ $cliente->dni }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="dni_search" class="form-label">Buscar por DNI</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="dni_search" placeholder="Buscar por DNI">
                            <button type="button" class="btn btn-success" id="buscarDniBtn">Buscar</button>
                        </div>
                    </div>

                    <!-- Campo Fecha -->
                    <div class="col-md-4">
                        <label for="fecha_search" class="form-label">Buscar por Fecha</label>
                        <input type="date" class="form-control" id="fecha_search" placeholder="Seleccionar Fecha">
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="producto_id" class="form-label">Producto</label>
                        <select name="producto_id" id="producto_id" class="form-control" required>
                            <option value="">Seleccionar Producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="cantidad_productos" class="form-label">Cantidad de productos</label>
                        <input type="number" class="form-control" id="cantidad_productos" name="cantidad_productos" min="1" oninput="this.value = Math.abs(this.value)" required placeholder="0">
                    </div>

                    <div class="col-md-4 d-flex">
                        <button type="button" class="btn btn-primary ms-2" id="registrarBtn">Añadir</button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="ventas-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Total a Pagar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Las filas de la tabla se añadirán aquí dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Campos adicionales para resumen de la venta -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- SubTotal -->
                <div class="col-md-3">
                    <label for="subtotal" class="form-label">Subtotal</label>
                    <input type="text" class="form-control" id="subtotal" readonly>
                </div>

                <!-- Descuento -->
                <div class="col-md-3">
                    <label for="descuento" class="form-label">Descuento (%)</label>
                    <input type="number" class="form-control" id="descuento" value="0" min="0" max="100">
                </div>
            </div>

            <div class="row mt-3">
                <!-- IGV -->
                <div class="col-md-3">
                    <label for="igv" class="form-label">IGV (18%)</label>
                    <input type="text" class="form-control" id="igv" readonly>
                </div>

                <!-- Total a Pagar -->


                <div class="col-md-3">
                    <label for="efectivo" class="form-label">Efectivo</label>
                    <input type="number" class="form-control" id="efectivo">
                </div>
            </div>

            <div class="row mt-3">
                <!-- Efectivo -->
                <div class="col-md-3">
                    <label for="cambio" class="form-label">Cambio</label>
                    <input type="text" class="form-control" id="cambio" readonly>
                </div>

                <!-- Cambio -->


                <div class="col-md-3">
                    <label for="total_pagar" class="form-label">Total a Pagar</label>
                    <input type="text" class="form-control" id="total_pagar" readonly>
                </div>
            </div>
        </div>
    </div>


    <script>
       // Variables globales
let totalPagar = 0;  // Total acumulado de la venta
let numero = 1;  // Número de productos en la lista

// Función para añadir productos a la tabla
document.getElementById('registrarBtn').addEventListener('click', function() {
    const productoSelect = document.getElementById('producto_id');
    const cantidadInput = document.getElementById('cantidad_productos');

    const productoId = productoSelect.value;
    const productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
    const cantidad = parseInt(cantidadInput.value);
    const precioUnitario = parseFloat(productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio'));

    if (!productoId || !cantidad || isNaN(precioUnitario)) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, selecciona un producto y asegúrate de ingresar una cantidad válida.',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

    const subtotal = cantidad * precioUnitario;

    // Agregar fila a la tabla sin afectar el precio total global
    const ventasTable = document.getElementById('ventas-table').getElementsByTagName('tbody')[0];
    const newRow = ventasTable.insertRow();
    newRow.innerHTML = `
        <td>${numero++}</td>
        <td>${productoNombre}</td>
        <td>${cantidad}</td>
        <td>${precioUnitario.toFixed(2)}</td>
        <td>${subtotal.toFixed(2)}</td>
        <td>${subtotal.toFixed(2)}</td> <!-- Total a pagar igual al subtotal -->
        <td>
            <button type="button" class="btn btn-danger btn-sm delete-row-btn">Eliminar</button>
        </td>
    `;

    // Limpiar campos de entrada
    productoSelect.value = '';
    cantidadInput.value = '';

    // Función para eliminar filas
    newRow.querySelector('.delete-row-btn').addEventListener('click', function() {
        this.closest('tr').remove();
        actualizarTotales();  // Recalcular los totales
    });

    // Actualizar los totales en la interfaz
    actualizarTotales();
});

// Función para actualizar los totales
function actualizarTotales() {
    const ventasTable = document.getElementById('ventas-table').getElementsByTagName('tbody')[0];
    const rows = ventasTable.getElementsByTagName('tr');

    let subtotal = 0;

    // Sumar todos los subtotales de la tabla
    for (let i = 0; i < rows.length; i++) {
        const subtotalCell = rows[i].cells[4].innerText; // Columna de subtotal
        subtotal += parseFloat(subtotalCell);
    }

    const descuento = parseFloat(document.getElementById('descuento').value || 0);
    const totalConDescuento = subtotal - descuento;  // Aplicar descuento

    const igv = totalConDescuento * 0.18;  // Calcular IGV (18%)
    const totalFinal = totalConDescuento + igv;  // Total final a pagar con IGV

    // Actualizar los campos de la interfaz
    document.getElementById('subtotal').value = subtotal.toFixed(2);
    document.getElementById('igv').value = igv.toFixed(2);
    document.getElementById('total_pagar').value = totalFinal.toFixed(2);
}

// Evento para recalcular totales cuando se cambie el descuento
document.getElementById('descuento').addEventListener('input', function() {
    const totalOriginal = 1000; // Este es el total original antes de aplicar el descuento (puedes cambiarlo según tu lógica)
    const descuento = parseFloat(document.getElementById('descuento').value || 0);

    // Calcular el total a pagar con el descuento
    const totalConDescuento = totalOriginal - (totalOriginal * (descuento / 100));

    // Actualizar el campo "Total a Pagar"
    document.getElementById('total_pagar').value = totalConDescuento.toFixed(2);
});

// Evento para calcular el cambio al ingresar efectivo
document.getElementById('efectivo').addEventListener('input', function() {
    const efectivo = parseFloat(this.value) || 0;
    const totalPagar = parseFloat(document.getElementById('total_pagar').value) || 0;
    const cambio = efectivo - totalPagar;  // Calcular el cambio
    document.getElementById('cambio').value = cambio.toFixed(2);  // Mostrar cambio
});
    </script>
@stop
