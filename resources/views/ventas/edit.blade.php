@extends('adminlte::page')

@section('title', 'Editar Venta')

@section('content_header')
    <h1>Editar Venta</h1>
@stop

@section('content')
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: '¡Actualización Exitosa!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <form id="ventaForm" action="{{ route('ventas.update', $venta->id_venta) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="producto_id">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control" onchange="calcularSubtotal()">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}" {{ $venta->producto_id == $producto->id_producto ? 'selected' : '' }} data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control">
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" {{ $venta->cliente_id == $cliente->id_cliente ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $venta->cantidad }}" required oninput="calcularSubtotal()">
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ $venta->fecha }}" required>
        </div>

        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" value="{{ $venta->subtotal }}" required readonly>
        </div>

        <div class="form-group">
            <label for="impuesto">Impuesto</label>
            <input type="number" step="0.01" name="impuesto" id="impuesto" class="form-control" value="{{ $venta->impuesto }}" required readonly>
        </div>

        <div class="form-group">
            <label for="descuento">Descuento</label>
            <input type="number" step="0.01" name="descuento" class="form-control" value="{{ $venta->descuento }}" oninput="calcularTotal()">
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" value="{{ $venta->total }}" required readonly>
        </div>

        <div class="form-group">
            <label for="metodo_pago">Método de Pago</label>
            <select name="metodo_pago" id="metodo_pago" class="form-control">
                <option value="efectivo" {{ $venta->metodo_pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="tarjeta" {{ $venta->metodo_pago == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                <option value="transferencia" {{ $venta->metodo_pago == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                <option value="otros" {{ $venta->metodo_pago == 'otros' ? 'selected' : '' }}>Otros</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" id="actualizarBtn">Actualizar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('actualizarBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas actualizar esta venta?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('ventaForm').submit();
                }
            });
        });

        function calcularSubtotal() {
            const productoSelect = document.getElementById('producto_id');
            const cantidadInput = document.getElementsByName('cantidad')[0];
            const subtotalInput = document.getElementById('subtotal');
            const impuestoInput = document.getElementById('impuesto');
            const totalInput = document.getElementById('total');

            const selectedOption = productoSelect.options[productoSelect.selectedIndex];
            const precio = parseFloat(selectedOption.getAttribute('data-precio'));
            const cantidad = parseInt(cantidadInput.value) || 0;

            const subtotal = precio * cantidad;
            subtotalInput.value = subtotal.toFixed(2);

            // Calcular el impuesto (18%)
            const impuesto = subtotal * 0.18;
            impuestoInput.value = impuesto.toFixed(2);

            calcularTotal(); // Llama a calcular total después de calcular subtotal e impuesto
        }

        function calcularTotal() {
            const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
            const impuesto = parseFloat(document.getElementById('impuesto').value) || 0;
            const descuento = parseFloat(document.getElementsByName('descuento')[0].value) || 0;

            const total = subtotal + impuesto - descuento;

            // Asegurarte de que el total no sea negativo
            document.getElementById('total').value = total < 0 ? '0.00' : total.toFixed(2);
        }

        // Llamar a calcularSubtotal al cargar la página para establecer los valores iniciales
        window.onload = calcularSubtotal;
    </script>
@stop
