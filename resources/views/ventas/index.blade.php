@extends('adminlte::page')

@section('title', 'Lista de Ventas')

@section('content_header')
    <h1>Lista de Ventas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Búsqueda sin recarga -->
    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por cliente, producto o fecha">
        </div>
    </form>

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="ventas-table">
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id_venta }}</td>
                            <td>{{ $venta->cliente->nombre }}</td>
                            <td>{{ $venta->totalPagar }}</td>
                            <td>{{ $venta->fecha }}</td>
                            <td>{{ $venta->estado }}</td>
                            <td>
                                <!-- Enlace a los detalles de la venta -->
                                <a href="{{ route('ventas.show', ['venta' => $venta->id_venta]) }}" class="btn btn-info btn-sm">Ver</a>

                                <!-- Enlace para editar la venta -->
                                <a href="{{ route('ventas.edit', ['venta' => $venta->id_venta]) }}" class="btn btn-warning btn-sm">Editar</a>


                                <!-- Formulario para eliminar la venta con SweetAlert -->
                                <form action="{{ route('ventas.destroy', ['venta' => $venta->id_venta]) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                {{ $ventas->links() }}
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Funcionalidad de SweetAlert2 para eliminar ventas
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas eliminar esta venta?",
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

        // Funcionalidad de búsqueda sin recarga
        document.getElementById('search').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ventas-table tr');

            rows.forEach(function(row) {
                const cliente = row.cells[1].textContent.toLowerCase();
                const fecha = row.cells[3].textContent.toLowerCase();
                const estado = row.cells[4].textContent.toLowerCase();

                if (cliente.includes(searchValue) || fecha.includes(searchValue) || estado.includes(searchValue)) {
                    row.style.display = ''; // Mostrar fila
                } else {
                    row.style.display = 'none'; // Ocultar fila
                }
            });
        });
    </script>
@stop
