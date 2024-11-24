@extends('adminlte::page')

@section('title', 'Detalles de Ventas')

@section('content')
    <h2>Detalles de Venta Registrados</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por ID Venta, Producto o Cantidad">
        </div>
    </form>

    <a href="{{ route('ventadetalles.create') }}" class="btn btn-primary mb-3">Crear Detalle de Venta</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Venta</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="detalle-ventas-table">
                    @foreach($ventaDetalles as $ventaDetalle)
                        <tr>
                            <td>{{ $ventaDetalle->id_detalle }}</td>
                            <td>{{ $ventaDetalle->id_venta }}</td>
                            <td>{{ $ventaDetalle->producto->nombre }}</td>
                            <td>{{ $ventaDetalle->cantidad }}</td>
                            <td>{{ number_format($ventaDetalle->precio_unitario, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('ventadetalles.edit', $ventaDetalle->id_detalle) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('ventadetalles.destroy', $ventaDetalle->id_detalle) }}" method="POST" style="display:inline;" class="delete-form">
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
                {{ $ventaDetalles->links() }}
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
                    text: "¿Deseas eliminar este detalle de venta?",
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
            const rows = document.querySelectorAll('#detalle-ventas-table tr');

            rows.forEach(function(row) {
                const idVenta = row.cells[1].textContent.toLowerCase();
                const idProducto = row.cells[2].textContent.toLowerCase();
                const cantidad = row.cells[3].textContent.toLowerCase();

                if (idVenta.includes(searchValue) || idProducto.includes(searchValue) || cantidad.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
