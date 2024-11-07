@extends('adminlte::page')

@section('title', 'Crear Venta')

@section('content_header')
    <h1>Crear Nueva Venta</h1>
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

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control">
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="dni_cliente">Buscar Cliente por DNI</label>
                <div class="input-group">
                    <input type="text" id="dni_cliente" class="form-control" placeholder="Ingrese DNI">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success" id="buscarDniBtn">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="producto_id">Productos</label>
                <select name="producto_id[]" id="producto_id" class="form-control" multiple>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required placeholder="0">
                <button type="button" class="btn btn-primary mt-2" id="agregarBtn" >Agregar</button>
            </div>
        </div>

        <!-- Tabla de productos seleccionados -->
        <div class="form-group">
            <h5>Detalles de la Venta</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="detalleVentaTable">
                    <!-- Las filas se generarán dinámicamente aquí -->
                </tbody>
            </table>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="subtotal">Subtotal</label>
                <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" required readonly>

                <label for="impuesto">Impuesto (18%)</label>
                <input type="number" step="0.01" name="impuesto" id="impuesto" class="form-control" required readonly>

                <label for="descuento">Descuento</label>
                <input type="number" step="0.01" name="descuento" class="form-control" id="descuento" oninput="calcularTotal()" min="0">

                <label for="total">Total</label>
                <input type="number" step="0.01" name="total" id="total" class="form-control" required readonly>

            </div>


        </div>

        <div class="form-row">
            <div class="form-group ">

            </div>

            <div class="form-group ">
                <label for="metodo_pago">Método de Pago</label>
                <select name="metodo_pago" id="metodo_pago" class="form-control">
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="otros">Otros</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('buscarDniBtn').addEventListener('click', function() {
            const dni = document.getElementById('dni_cliente').value;

            if (dni) {
                // Realizar la solicitud AJAX para buscar al cliente por DNI
                fetch(`/cliente/buscar/${dni}`)
    .then(response => response.json())
    .then(data => {
        console.log(data); // Verifica lo que está llegando del backend
        if (data.status === 'success') {
            document.getElementById('cliente_id').value = data.cliente.id_cliente;
            Swal.fire({
                icon: 'success',
                title: 'Cliente encontrado',
                text: `Cliente: ${data.cliente.nombre}`
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al buscar el cliente'
        });
    });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Advertencia',
                    text: 'Por favor ingrese un DNI para buscar'
                });
            }
        });

        document.getElementById('buscarDniBtn').addEventListener('click', function() {
    const dni = document.getElementById('dni_cliente').value.trim();

    if (dni) {
        // Realizar la solicitud AJAX para buscar al cliente por DNI
        fetch(`/cliente/buscar/${dni}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Si se encuentra el cliente, actualizar el campo 'cliente_id' con el nombre del cliente
                    document.getElementById('cliente_id').value = data.cliente.id_cliente;
                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente encontrado',
                        text: `Cliente: ${data.cliente.nombre}`
                    });
                } else {
                    // Si no se encuentra el cliente, mostrar un mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al buscar el cliente'
                });
            });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Por favor ingrese un DNI para buscar'
        });
    }
});

        function eliminarProducto(button) {
            const row = button.closest('tr');
            row.remove();
            calcularSubtotal();
        }

        function calcularSubtotal() {
            let subtotal = 0;
            const rows = document.querySelectorAll('#detalleVentaTable tr');
            rows.forEach(row => {
                const subtotalCell = row.cells[4];
                subtotal += parseFloat(subtotalCell.innerText) || 0;
            });

            // Actualizar el subtotal
            document.getElementById('subtotal').value = subtotal.toFixed(2);
            // Calcular impuesto y total
            const impuesto = subtotal * 0.18;
            document.getElementById('impuesto').value = impuesto.toFixed(2);
            calcularTotal();
        }

        function calcularTotal() {
            const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
            const impuesto = parseFloat(document.getElementById('impuesto').value) || 0;
            const descuento = parseFloat(document.getElementById('descuento').value) || 0;

            const total = subtotal + impuesto - descuento;
            document.getElementById('total').value = total < 0 ? '0.00' : total.toFixed(2);
        }
    </script>
@stop
