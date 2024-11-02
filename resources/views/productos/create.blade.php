@extends('adminlte::page')

@section('title', 'Agregar Producto')

@section('content_header')
    <h1>Agregar Producto</h1>
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

    <form id="productoForm" action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="{{ old('precio') }}" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
        </div>
        <div class="form-group">
            <label for="id_categoria">Categoría</label>
            <select name="id_categoria" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_proveedor">Proveedor</label>
            <select name="id_proveedor" class="form-control" required>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_almacen">Almacén</label>
            <select name="id_almacen" class="form-control" required>
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id_almacen }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" class="btn btn-primary" id="guardarBtn">Guardar Producto</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas guardar este producto?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('productoForm').submit();
                }
            });
        });
    </script>
@stop
