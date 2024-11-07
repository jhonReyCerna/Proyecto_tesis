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
                        <button type="button" class="btn btn-secondary" id="buscarDniBtn">Buscar</button>
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
            <div class="form-group col-md-6">
                <label for="cantidad">Cantidad por producto</label>
                <input type="cantidad" name="cantidad" class="form-control" required>
                <button type="button" class="btn btn-primary mt-2" id="agregarBtn">Agregar</button>
            </div>
        </div>

        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" required readonly>
        </div>

        <div class="form-group">
            <label for="impuesto">Impuesto (18%)</label>
            <input type="number" step="0.01" name="impuesto" id="impuesto" class="form-control" required readonly>
        </div>

        <div class="form-group">
            <label for="descuento">Descuento</label>
            <input type="number" step="0.01" name="descuento" class="form-control" id="descuento" oninput="calcularTotal()" min="0">
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" required readonly>
        </div>

        <div class="form-group">
            <label for="metodo_pago">Método de Pago</label>
            <select name="metodo_pago" id="metodo_pago" class="form-control">
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="transferencia">Transferencia</option>
                <option value="otros">Otros</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Confirmación al enviar el formulario
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

        // Mostrar cantidad de productos seleccionados
        document.getElementById('producto_id').addEventListener('change', function() {
            let cantidadContainer = document.getElementById('cantidadContainer');
            cantidadContainer.innerHTML = '';  // Limpiar el contenedor de cantidades
            let productosSeleccionados = this.selectedOptions;

            Array.from(productosSeleccionados).forEach(function(producto) {
                let cantidadInput = document.createElement('input');
                cantidadInput.type = 'number';
                cantidadInput.name = 'cantidad[' + producto.value + ']'; // Asociar cada cantidad con el producto correspondiente
                cantidadInput.className = 'form-control';
                cantidadInput.placeholder = 'Cantidad de ' + producto.text;
                cantidadInput.min = 1;
                cantidadInput.required = true;
                cantidadInput.oninput = calcularSubtotal; // Llamar a la función para recalcular
                cantidadContainer.appendChild(cantidadInput);
                cantidadContainer.appendChild(document.createElement('br'));  // Salto de línea
            });
        });

        // Cálculos de subtotal, impuesto y total
        function calcularSubtotal() {
            const productoSelect = document.getElementById('producto_id');
            const cantidadInputs = document.querySelectorAll('#cantidadContainer input');
            const subtotalInput = document.getElementById('subtotal');
            const impuestoInput = document.getElementById('impuesto');
            const totalInput = document.getElementById('total');

            let subtotal = 0;

            // Recorre cada cantidad y calcula el subtotal
            Array.from(cantidadInputs).forEach(function(cantidadInput) {
                const cantidad = parseInt(cantidadInput.value) || 0;
                const productoId = cantidadInput.name.replace('cantidad[', '').replace(']', '');
                const producto = productoSelect.querySelector(`option[value="${productoId}"]`);
                const precio = parseFloat(producto.getAttribute('data-precio')) || 0;

                subtotal += precio * cantidad;
            });

            subtotalInput.value = subtotal.toFixed(2);

            const impuesto = subtotal * 0.18;
            impuestoInput.value = impuesto.toFixed(2);

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
