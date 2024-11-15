@extends('adminlte::page')

@section('title', 'Lista de Almacenes')

@section('content_header')
    <h1>Lista de Almacenes</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por nombre, ubicación o capacidad">
        </div>
    </form>

    <a href="{{ route('almacenes.create') }}" class="btn btn-primary mb-3">Agregar Almacén</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Capacidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="almacenes-table">
                    @foreach($almacenes as $almacen)
                        <tr>
                            <td>{{ $almacen->id_almacen }}</td>
                            <td>{{ $almacen->nombre }}</td>
                            <td>{{ $almacen->ubicacion }}</td>
                            <td>{{ $almacen->capacidad }}</td>
                            <td>
                                <a href="{{ route('almacenes.show', $almacen) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('almacenes.edit', $almacen) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('almacenes.destroy', $almacen) }}" method="POST" style="display:inline;" class="delete-form">
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
                {{ $almacenes->links() }}
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
                    text: "¿Deseas eliminar este almacén?",
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
            const rows = document.querySelectorAll('#almacenes-table tr');

            rows.forEach(function(row) {
                const nombre = row.cells[1].textContent.toLowerCase();
                const ubicacion = row.cells[2].textContent.toLowerCase();
                const capacidad = row.cells[3].textContent.toLowerCase();

                if (nombre.includes(searchValue) || ubicacion.includes(searchValue) || capacidad.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
