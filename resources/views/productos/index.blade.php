@extends('adminlte::page')

@section('title', 'Lista de Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

     <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por nombre, categoría o proveedor">
        </div>
    </form>

    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Almacén</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="productos-table">
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->id_producto }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->precio }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>{{ $producto->categoria->nombre }}</td>
                            <td>{{ $producto->proveedor->nombre }}</td>
                            <td>{{ $producto->almacen->nombre }}</td>
                            <td>
                                <a href="{{ route('productos.show', $producto) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $productos->links() }}
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas eliminar este producto?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });


        document.getElementById('search').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#productos-table tr');

            rows.forEach(function(row) {
                const nombre = row.cells[1].textContent.toLowerCase();
                const categoria = row.cells[4].textContent.toLowerCase();
                const proveedor = row.cells[5].textContent.toLowerCase();

                if (nombre.includes(searchValue) || categoria.includes(searchValue) || proveedor.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
