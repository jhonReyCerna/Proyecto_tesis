@extends('adminlte::page')


@section('title', 'Listado de Ventas')

@section('content')
    <h2>Ventas Registradas</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Búsqueda sin recarga -->
    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por cliente, total o estado">
        </div>
    </form>

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Agregar Venta</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Total a Pagar</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="ventas-table">
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->cliente->nombre }}</td>
                            <td>{{ number_format($venta->totalPagar, 2, ',', '.') }}</td> <!-- Formateo del total -->
                            <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</td>
                            <td>
                                @if($venta->estado == 'Completada')
                                    <span class="badge bg-success">{{ ucfirst($venta->estado) }}</span>
                                @elseif($venta->estado == 'Pendiente')
                                    <span class="badge bg-warning text-dark">{{ ucfirst($venta->estado) }}</span>
                                @else
                                    <span class="badge bg-danger">{{ ucfirst($venta->estado) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline;" class="delete-form">
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
                const cliente = row.cells[0].textContent.toLowerCase();
                const total = row.cells[1].textContent.toLowerCase();
                const estado = row.cells[3].textContent.toLowerCase();

                if (cliente.includes(searchValue) || total.includes(searchValue) || estado.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
