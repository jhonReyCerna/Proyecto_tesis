@extends('adminlte::page')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Realizar Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST" id="ventaForm" onsubmit="return validarFormulario()">
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
                    <label for="fecha" class="font-weight-bold">Fecha de Venta</label>
                    <input type="date" id="fecha" name="fecha_venta" class="form-control" required>
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
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Total:</td>
                            <td id="total-venta" class="font-weight-bold">0.00</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-primary" onclick="agregarProducto()">
                <i class="fas fa-plus-circle"></i> Agregar Producto
            </button>
            <button type="submit" class="btn btn-success" id="btnRealizarVenta">
                <i class="fas fa-check-circle"></i> Realizar Venta
            </button>
        </div>
    </form>
</div>

@push('js')
<script>
// Productos ejemplo, esta información debe provenir de la base de datos
const productos = @json($productos);

// Función para validar productos existentes antes de agregar uno nuevo
function validarProductosExistentes() {
    const filas = document.querySelectorAll('#productos tbody tr');
    let todosSeleccionados = true;

    filas.forEach(fila => {
        const select = fila.querySelector('select[name="productos[][id_producto]"]');
        if (!select.value) {
            todosSeleccionados = false;
        }
    });

    if (!todosSeleccionados) {
        Swal.fire({
            icon: 'warning',
            title: 'Producto no seleccionado',
            text: 'Por favor, seleccione un producto en la fila actual antes de agregar una nueva.',
            confirmButtonText: 'Entendido'
        });
        return false;
    }

    return true;
}

// Función para agregar productos dinámicamente
function agregarProducto() {
    // Validar antes de agregar
    if (!validarProductosExistentes()) {
        return;
    }

    const productosTable = document.getElementById('productos').getElementsByTagName('tbody')[0];
    const row = productosTable.insertRow();

    // Crear las celdas
    const celdas = {
        producto: row.insertCell(0),
        cantidad: row.insertCell(1),
        precio: row.insertCell(2),
        subtotal: row.insertCell(3),
        acciones: row.insertCell(4)
    };

    // Crear select de productos
    const selectProducto = document.createElement('select');
    selectProducto.classList.add('form-control');
    selectProducto.name = 'productos[][id_producto]';
    selectProducto.required = true;

    // Opción por defecto
    selectProducto.innerHTML = `
        <option value="">Seleccionar producto</option>
        ${productos.map(p => `
            <option value="${p.id_producto}"
                    data-precio="${p.precio}">${p.nombre}</option>
        `).join('')}
    `;

    // Input para cantidad
    const inputCantidad = document.createElement('input');
    inputCantidad.type = 'number';
    inputCantidad.name = 'productos[][cantidad]';
    inputCantidad.classList.add('form-control');
    inputCantidad.min = 1;
    inputCantidad.value = 1;
    inputCantidad.disabled = true;

    // Span para precio
    const spanPrecio = document.createElement('span');
    spanPrecio.classList.add('precio-unitario');
    spanPrecio.textContent = '0.00';

    // Span para subtotal
    const spanSubtotal = document.createElement('span');
    spanSubtotal.classList.add('subtotal');
    spanSubtotal.textContent = '0.00';

    // Botón eliminar
    const btnEliminar = document.createElement('button');
    btnEliminar.type = 'button';
    btnEliminar.classList.add('btn', 'btn-danger', 'btn-sm');
    btnEliminar.innerHTML = '<i class="fas fa-trash"></i> Eliminar';

    // Agregar elementos a las celdas
    celdas.producto.appendChild(selectProducto);
    celdas.cantidad.appendChild(inputCantidad);
    celdas.precio.appendChild(spanPrecio);
    celdas.subtotal.appendChild(spanSubtotal);
    celdas.acciones.appendChild(btnEliminar);

    // Event Listeners
    selectProducto.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const precio = selectedOption.dataset.precio || 0;

        spanPrecio.textContent = Number(precio).toFixed(2);
        inputCantidad.disabled = !this.value;
        inputCantidad.value = 1;

        actualizarSubtotal(row);
    });

    inputCantidad.addEventListener('input', () => actualizarSubtotal(row));
    btnEliminar.addEventListener('click', () => {
        row.remove();
        actualizarTotal();
    });
}

// Función para actualizar subtotal de una fila
function actualizarSubtotal(row) {
    const cantidad = Number(row.querySelector('input[type="number"]').value);
    const precio = Number(row.querySelector('.precio-unitario').textContent);
    const spanSubtotal = row.querySelector('.subtotal');

    spanSubtotal.textContent = (cantidad * precio).toFixed(2);
    actualizarTotal();
}

// Función para actualizar el total general
function actualizarTotal() {
    const subtotales = Array.from(document.querySelectorAll('.subtotal'))
        .map(span => Number(span.textContent));

    const total = subtotales.reduce((sum, subtotal) => sum + subtotal, 0);
    document.getElementById('total-venta').textContent = total.toFixed(2);
}

// Función para validar el formulario completo
function validarFormulario() {
    const filas = document.querySelectorAll('#productos tbody tr');

    if (filas.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error de validación',
            text: 'Debe agregar al menos un producto a la venta.'
        });
        return false;
    }

    for (const fila of filas) {
        const producto = fila.querySelector('select').value;
        const cantidad = fila.querySelector('input[type="number"]').value;

        if (!producto) {
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: 'Por favor seleccione todos los productos.'
            });
            return false;
        }

        if (cantidad < 1) {
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: 'La cantidad debe ser mayor a 0 para todos los productos.'
            });
            return false;
        }
    }

    // Deshabilitar el botón para evitar envíos duplicados
    document.getElementById('btnRealizarVenta').disabled = true;

    // Mostrar indicador de carga
    Swal.fire({
        title: 'Procesando venta...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    return true;
}

// Inicializar con una fila
document.addEventListener('DOMContentLoaded', () => {
    agregarProducto();

    // Establecer la fecha actual por defecto
    const fechaActual = new Date().toISOString().split('T')[0];
    document.getElementById('fecha').value = fechaActual;
});
</script>
@endpush
@stop
