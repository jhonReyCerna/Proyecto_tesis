@extends('adminlte::page')

@section('title', 'Agregar Compra')

@section('content_header')
    <h1>Agregar Compra</h1>
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

    <form id="compraForm" action="{{ route('compras.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="producto_id">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <option value="">Seleccionar Producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="proveedor_id">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                <option value="">Seleccionar Proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" id="cantidad" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="almacen_id">Almacén</label>
            <select name="almacen_id" id="almacen_id" class="form-control" required>
                <option value="">Seleccionar Almacén</option>
                @foreach ($almacenes as $almacen)
                    <option value="{{ $almacen->id_almacen }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" class="form-control" id="precio_unitario" required>
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" step="0.01" name="total" class="form-control" id="total" disabled>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-primary" id="registrarBtn">Registrar Compra</button>
            <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function calcularTotal() {
            const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
            const precioUnitario = parseFloat(document.getElementById('precio_unitario').value) || 0;
            const total = cantidad * precioUnitario;
            document.getElementById('total').value = total.toFixed(2); 
        }

        document.getElementById('cantidad').addEventListener('input', calcularTotal);
        document.getElementById('precio_unitario').addEventListener('input', calcularTotal);

        document.getElementById('registrarBtn').addEventListener('click', function(event) {
            event.preventDefault();

          
            document.getElementById('total').disabled = false;

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas registrar esta compra?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, registrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('compraForm').submit();
                }
            });
        });
    </script>
@stop
