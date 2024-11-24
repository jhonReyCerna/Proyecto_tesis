@extends('adminlte::page')

@section('title', 'Agregar Venta')

@section('content_header')
    <h1>Agregar Venta</h1>
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
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="id_cliente" class="form-label">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-control">
                            <option value="" disabled selected>Seleccionar Cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="dni_cliente" class="form-label">Buscar por DNI</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="dni_cliente" name="dni_cliente" placeholder="Ingrese DNI">
                            <button class="btn btn-primary" type="button" id="buscarDNI">Buscar</button>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                    <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
                </div>

                <div id="productos-container">
                    <div class="producto mb-4">
                        <label for="id_producto[]" class="form-label">Producto</label >
                        <select name="productos[0][id_producto]" class="form-control producto-select">
                            <option value="" disabled selected>Seleccionar Producto</option>
                            @foreach($productos->sortBy('nombre') as $producto)
                                <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>

                        <label for="cantidad[]" class="form-label">Cantidad</label>
                        <input type="number" name="productos[0][cantidad]" class="form-control cantidad-input" required>

                        <label for="precio_unitario[]" class="form-label">Precio Unitario</label>
                        <input type="number" name="productos[0][precio_unitario]" class="form-control precio-unitario-input" readonly>

                        <label for="descuento[]" class="form-label">Descuento</label>
                        <input type="number" name="productos[0][descuento]" class="form-control descuento-input" placeholder="0" value="0">

                        <button type="button" class="btn btn-danger eliminar-producto mt-2">Eliminar Producto</button>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="agregar-producto">Agregar Producto</button>
            </div>

            <div class="mb-4">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Pagado">Pagado</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="totalPagar" class="form-label">Total a Pagar</label>
                <input type="number" name="totalPagar" id="totalPagar" class="form-control" readonly>
            </div>

            <div class="mb-4">
                <label for="igv_total" class="form-label">IGV Total</label>
                <input type="number" name="igv_total" id="igv_total" class="form-control" readonly>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <button type="submit" class="btn btn-success" id="guardarBtn">Guardar Venta</button>
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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

        document.getElementById('agregar-producto').addEventListener('click', function () {
            var container = document.getElementById('productos-container');
            var count = container.getElementsByClassName('producto').length;
            var newProduct = document.createElement('div');
            newProduct.classList.add('producto', 'mb-4');
            newProduct.innerHTML = `
                <label for="id_producto[]" class="form-label">Producto</label>
                <select name="productos[${count}][id_producto]" class="form-control producto-select">
                    <option value="" disabled selected>Seleccionar Producto</option>
                    @foreach($productos->sortBy('nombre') as $producto)
                        <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>

                <label for="cantidad[]" class="form-label">Cantidad</label>
                <input type="number" name="productos[${count}][cantidad]" class="form-control cantidad-input" required>

                <label for="precio_unitario[]" class="form-label">Precio Unitario</label>
                <input type="number" name="productos[${count}][precio_unitario]" class="form-control precio-unitario-input" readonly>

                <label for="descuento[]" class="form-label">Descuento</label>
                <input type="number" name="productos[${count}][descuento]" class="form-control descuento-input" placeholder="0">

                <button type="button" class="btn btn-danger eliminar-producto mt-2">Eliminar Producto</button>
            `;
            container.appendChild(newProduct);
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('eliminar-producto')) {
                event.target.parentElement.remove();
                calcularTotal();
            }
        });

        document.addEventListener('change', function (event) {
            if (event.target.classList.contains('producto-select')) {
                var selectedOption = event.target.options[event.target.selectedIndex];
                var precio = selectedOption.getAttribute('data-precio');
                var productoContainer = event.target.closest('.producto');
                var precioUnitarioInput = productoContainer.querySelector('.precio-unitario-input');
                var cantidadInput = productoContainer.querySelector('.cantidad-input');

                precioUnitarioInput.value = precio;
                calcularTotal();
            }
        });

        document.addEventListener('input', function (event) {
            if (event.target.classList.contains('cantidad-input') || event.target.classList.contains('descuento-input')) {
                calcularTotal();
            }
        });

        function calcularTotal() {
            var productos = document.querySelectorAll('.producto');
            var total = 0;

            productos.forEach(function (producto) {
                var cantidad = producto.querySelector('.cantidad-input').value || 0;
                var precio = producto.querySelector('.precio-unitario-input').value || 0;
                var descuento = producto.querySelector('.descuento-input').value || 0;
                var subtotal = (cantidad * precio) - descuento;
                total += subtotal;
            });

            var igv = total * 0.18;
            var totalConIgv = total + igv;
            document.getElementById('totalPagar').value = totalConIgv.toFixed(2);
            document.getElementById('igv_total').value = igv.toFixed(2);
        }

        document.getElementById('buscarDNI').addEventListener('click', function () {
            var dni = document.getElementById('dni_cliente').value;
            if (dni) {
                fetch(`/venta/buscar-cliente/${dni}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            var cliente = data.cliente;
                            document.getElementById('id_cliente').value = cliente.id_cliente; // Asigna el ID del cliente

                            Swal.fire({
                                title: 'Cliente Encontrado!',
                                text: `El cliente ${cliente.nombre} ha sido encontrado.`,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000,
                                willClose: () => {
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Cliente No Encontrado',
                                text: 'No se ha encontrado un cliente con ese DNI.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000,
                                willClose: () => {
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error en la búsqueda del cliente:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un error al buscar el cliente.',
                            icon: 'error',
                            showConfirmButton: true
                        });
                    });
            } else {
                Swal.fire({
                    title: 'Por Favor',
                    text: 'Por favor ingresa un DNI.',
                    icon: 'warning',
                    showConfirmButton: true
                });
            }
        });
    </script>
@stop
