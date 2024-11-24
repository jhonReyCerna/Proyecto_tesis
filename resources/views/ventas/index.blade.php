@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Ventas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por cliente, total o fecha de venta">
        </div>
    </form>

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Nueva Venta</a>
    <a href="{{ route('ventas.reporte') }}" class="btn btn-success mb-3"> <i class="fas fa-file-pdf"></i> Generar Reporte PDF</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NRO</th>
                        <th>Cliente</th>
                        <th>Total Pagar</th>
                        <th>Fecha de Venta</th>
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
                            <td>{{ $venta->fecha_venta }}</td>
                            <td>{{ $venta->estado }}</td>
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

        document.getElementById('search').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ventas-table tr');

            rows.forEach(function(row) {
                const cliente = row.cells[1].textContent.toLowerCase();
                const totalPagar = row.cells[2].textContent.toLowerCase();
                const fechaVenta = row.cells[3].textContent.toLowerCase();

                if (cliente.includes(searchValue) || totalPagar.includes(searchValue) || fechaVenta.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
