@extends('adminlte::page')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Realizar Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST" onsubmit="return validarFormulario()">
        @csrf

        <div class="row">
            <!-- Selección de Cliente -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_cliente" class="font-weight-bold">Seleccionar Cliente</label>
                    <select id="id_cliente" name="id_cliente" class="form-control" required>
                        <option value="" disabled selected>Selecciona un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Fecha de Venta -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fecha_venta" class="font-weight-bold">Fecha de Venta</label>
                    <input type="date" id="fecha_venta" name="fecha_venta" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Sección de Productos -->
        <div class="form-group">
            <label for="productos" class="font-weight-bold">Productos</label>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="productos">
                    <thead class="thead-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filas dinámicas de productos -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-primary" onclick="agregarProducto()">
                <i class="fas fa-plus-circle"></i> Agregar Producto
            </button>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check-circle"></i> Realizar Venta
            </button>
        </div>
    </form>
</div>

<!-- Script para manejar la selección de productos y cálculo del subtotal -->
<script>
    // Productos ejemplo, esta información puede provenir de la base de datos
    const productos = @json($productos);

    // Función para agregar productos dinámicamente
    function agregarProducto() {
    const productosTable = document.getElementById('productos').getElementsByTagName('tbody')[0];

    // Crear una nueva fila de producto
    const row = productosTable.insertRow();

    // Crear celdas para el nombre, cantidad, precio unitario, subtotal y acciones
    const celdaProducto = row.insertCell(0);
    const celdaCantidad = row.insertCell(1);
    const celdaPrecio = row.insertCell(2);
    const celdaSubtotal = row.insertCell(3);
    const celdaAcciones = row.insertCell(4);

    // Crear un select de productos
    const selectProducto = document.createElement('select');
    selectProducto.classList.add('form-control');
    selectProducto.name = 'productos[][id_producto]';
    selectProducto.addEventListener('change', actualizarPrecioYSubtotal); // Actualizar precio y subtotal cuando el producto cambie

    // Agregar una opción por defecto para "Seleccionar producto"
    const opcionSeleccionar = document.createElement('option');
    opcionSeleccionar.value = '';
    opcionSeleccionar.textContent = 'Seleccionar producto';
    selectProducto.appendChild(opcionSeleccionar);

    productos.forEach(producto => {
        const option = document.createElement('option');
        option.value = producto.id_producto;
        option.textContent = producto.nombre;
        selectProducto.appendChild(option);
    });

    celdaProducto.appendChild(selectProducto);

    // Crear un input para la cantidad
    const inputCantidad = document.createElement('input');
    inputCantidad.type = 'number';
    inputCantidad.name = 'productos[][cantidad]';
    inputCantidad.classList.add('form-control');
    inputCantidad.value = 0;
    inputCantidad.min = 0;
    inputCantidad.addEventListener('input', actualizarSubtotal); // Actualizar subtotal cuando la cantidad cambie
    celdaCantidad.appendChild(inputCantidad);

    // Inicializar el precio unitario como 0
    const precio = 0; // El precio inicial es 0 hasta que se seleccione un producto
    celdaPrecio.textContent = precio.toFixed(2);

    // Subtotal, se actualizará cada vez que la cantidad cambie
    celdaSubtotal.textContent = (precio * 1).toFixed(2);

    // Crear un botón para eliminar la fila
    const btnEliminar = document.createElement('button');
    btnEliminar.classList.add('btn', 'btn-danger', 'btn-sm');
    btnEliminar.textContent = 'Eliminar';
    btnEliminar.type = 'button';
    btnEliminar.onclick = () => eliminarFila(row); // Llamar a la función de eliminar fila
    celdaAcciones.appendChild(btnEliminar);
}

    // Función para actualizar el precio unitario y el subtotal basado en el producto seleccionado
    function actualizarPrecioYSubtotal(event) {
        const fila = event.target.closest('tr');
        const selectProducto = fila.querySelector('select');
        const productoId = selectProducto.value;

        // Buscar el precio del producto seleccionado
        const producto = productos.find(p => p.id_producto == productoId);

        // Actualizar el precio unitario
        const celdaPrecio = fila.querySelector('td:nth-child(3)');
        if (producto) {
            celdaPrecio.textContent = producto.precio.toFixed(2);
        } else {
            celdaPrecio.textContent = '0.00';
        }

        // Actualizar el subtotal
        actualizarSubtotal(event); // Actualiza el subtotal después de cambiar el producto
    }

    // Función para actualizar el subtotal basado en la cantidad
    function actualizarSubtotal(event) {
        const fila = event.target.closest('tr');
        const cantidad = fila.querySelector('input[type="number"]').value;
        const selectProducto = fila.querySelector('select');
        const productoId = selectProducto.value;

        // Buscar el precio del producto seleccionado
        const producto = productos.find(p => p.id_producto == productoId);

        // Actualizar el subtotal
        const subtotal = fila.querySelector('td:nth-child(4)');
        if (producto) {
            subtotal.textContent = (producto.precio * cantidad).toFixed(2);
        } else {
            subtotal.textContent = '0.00';
        }
    }

    // Función para eliminar una fila
    function eliminarFila(fila) {
        fila.remove();
    }

    // Función para validar que se haya seleccionado al menos un producto
    function validarFormulario() {
        const productosSeleccionados = document.querySelectorAll('select[name="productos[][id_producto]"]');
        let esValido = true;

        productosSeleccionados.forEach(select => {
            if (!select.value) {
                esValido = false;
                alert('Por favor seleccione un producto para la venta.');
            }
        });

        return esValido;
    }

    // Inicializar con una fila de producto
    agregarProducto();
</script>

@endsection
