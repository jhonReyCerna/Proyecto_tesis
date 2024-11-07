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
            <input type="text" id="search" class="form-control" placeholder="Buscar por cliente o producto">
        </div>
    </form>

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Registrar Venta</a>

    <a href="{{ route('ventas.reporte') }}" class="btn btn-success mb-3"> <i class="fas fa-file-pdf"></i>  Generar Reporte PDF</a>


    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="ventas-table">
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id_venta }}</td>
                            <td>{{ $venta->cliente->nombre }}</td>
                            <td>{{ $venta->producto->nombre }}</td>
                            <td>{{ $venta->cantidad }}</td>
                            <td>{{ number_format($venta->total, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('ventas.show', $venta) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ventas-table tr');

            rows.forEach(function(row) {
                const cliente = row.cells[1].textContent.toLowerCase();
                const producto = row.cells[2].textContent.toLowerCase();

                if (cliente.includes(searchValue) || producto.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
