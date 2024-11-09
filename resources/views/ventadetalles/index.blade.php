@extends('adminlte::page')

@section('title', 'Detalles de Ventas')

@section('content_header')
    <h1>Detalles de Ventas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ventadetalles.create') }}" class="btn btn-primary mb-3">Crear Detalle de Venta</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Venta</th>
                        <th>ID Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventaDetalles as $ventaDetalle)
                        <tr>
                            <td>{{ $ventaDetalle->id_detalle }}</td>
                            <td>{{ $ventaDetalle->id_venta }}</td>
                            <td>{{ $ventaDetalle->id_producto }}</td>
                            <td>{{ $ventaDetalle->cantidad }}</td>
                            <td>{{ $ventaDetalle->precio_unitario }}</td>
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
        // Funcionalidad de SweetAlert2 para eliminar detalle de venta
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
    </script>
@stop
