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

    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por cliente o estado">
        </div>
    </form>

    <a href="{{ route('gestionarventas.create') }}" class="btn btn-primary mb-3">Agregar Venta</a>

    <a href="{{ route('gestionarventas.reporte') }}" class="btn btn-success mb-3">
        <i class="fas fa-file-pdf"></i> Generar Reporte PDF
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Venta</th>
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
                            <td>{{ $venta->id_venta }}</td>
                            <td>{{ $venta->cliente->nombre }}</td>
                            <td>{{ number_format($venta->totalPagar, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('Y-m-d') }}</td>
                            <td>
                                @if($venta->estado == 'pendiente')
                                    <span class="badge bg-warning">Pendiente</span>
                                @elseif($venta->estado == 'pagado')
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    {{ ucfirst($venta->estado) }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('gestionarventas.show', ['venta' => $venta->id_venta]) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('gestionarventas.edit', ['venta' => $venta->id_venta]) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('gestionarventas.destroy', ['venta' => $venta->id_venta]) }}" method="POST" style="display:inline;" class="delete-form">
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
        // Confirmación para eliminar una venta
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

        // Búsqueda dinámica
        document.getElementById('search').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ventas-table tr');

            rows.forEach(function(row) {
                const cliente = row.cells[1].textContent.toLowerCase();
                const estado = row.cells[4].textContent.toLowerCase();

                if (cliente.includes(searchValue) || estado.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
