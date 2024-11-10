<form action="{{ route('ventas.store') }}" method="POST">
    @csrf

    <!-- Información de la venta -->
    <div>
        <label for="id_cliente">Cliente</label>
        <select name="id_cliente" id="id_cliente">
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="fecha_venta">Fecha de Venta</label>
        <input type="date" name="fecha_venta" id="fecha_venta" required>
    </div>

    <div>
        <label for="estado">Estado</label>
        <select name="estado" id="estado">
            <option value="Pendiente">Pendiente</option>
            <option value="Pagado">Pagado</option>
        </select>
    </div>

    <!-- Información de los productos (detalles) -->
    <div id="productos-container">
        <div class="producto">
            <label for="id_producto[]">Producto</label>
            <select name="productos[0][id_producto]" class="id_producto">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>

            <label for="cantidad[]">Cantidad</label>
            <input type="number" name="productos[0][cantidad]" class="cantidad" required>

            <label for="precio_unitario[]">Precio Unitario</label>
            <input type="number" name="productos[0][precio_unitario]" class="precio_unitario" required>

            <label for="descuento[]">Descuento</label>
            <input type="number" name="productos[0][descuento]" class="descuento">

            <label for="igv[]">IGV</label>
            <input type="number" name="productos[0][igv]" class="igv">

            <button type="button" class="eliminar-producto">Eliminar Producto</button>
        </div>
    </div>

    <button type="button" id="agregar-producto">Agregar Producto</button>
    <button type="submit">Guardar Venta</button>
</form>

<script>
    // Agregar un nuevo producto al formulario
    document.getElementById('agregar-producto').addEventListener('click', function () {
        var container = document.getElementById('productos-container');
        var count = container.getElementsByClassName('producto').length;
        var newProduct = document.createElement('div');
        newProduct.classList.add('producto');
        newProduct.innerHTML = `
            <label for="id_producto[]">Producto</label>
            <select name="productos[${count}][id_producto]" class="id_producto">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>

            <label for="cantidad[]">Cantidad</label>
            <input type="number" name="productos[${count}][cantidad]" class="cantidad" required>

            <label for="precio_unitario[]">Precio Unitario</label>
            <input type="number" name="productos[${count}][precio_unitario]" class="precio_unitario" required>

            <label for="descuento[]">Descuento</label>
            <input type="number" name="productos[${count}][descuento]" class="descuento">

            <label for="igv[]">IGV</label>
            <input type="number" name="productos[${count}][igv]" class="igv">

            <button type="button" class="eliminar-producto">Eliminar Producto</button>
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
