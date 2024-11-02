@extends('adminlte::page')

@section('title', 'Lista de Proveedores')

@section('content_header')
    <h1>Lista de Proveedores</h1>
@stop

@section('css')
    
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por nombre o descripción">
        </div>
    </form>

    <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3">Agregar Proveedor</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>RUC</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="proveedores-table">
                    @foreach($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->id_proveedor }}</td>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->direccion }}</td>
                            <td>{{ $proveedor->telefono }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td>{{ $proveedor->ruc }}</td>
                            <td>
                                <a href="{{ route('proveedores.show', $proveedor) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" style="display:inline;" class="delete-form">
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
                {{ $proveedores->links() }}
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
                    text: "¿Deseas eliminar este proveedor?",
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
            const rows = document.querySelectorAll('#proveedores-table tr');

            rows.forEach(function(row) {
                const nombre = row.cells[1].textContent.toLowerCase();
                const direccion = row.cells[2].textContent.toLowerCase();
                const telefono = row.cells[3].textContent.toLowerCase();
                const email = row.cells[4].textContent.toLowerCase();
                const ruc = row.cells[5].textContent.toLowerCase();

               
                if (nombre.includes(searchValue) || direccion.includes(searchValue) || telefono.includes(searchValue) || email.includes(searchValue) || ruc.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
