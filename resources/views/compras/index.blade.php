@extends('adminlte::page')

@section('title', 'Lista de Compras')

@section('content_header')
    <h1>Lista de Compras</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <form class="mb-3">
        <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por producto, proveedor o almacén">
        </div>
    </form>

    <a href="{{ route('compras.create') }}" class="btn btn-primary mb-3">Agregar Compra</a>

    <a href="{{ route('compras.reporte') }}" class="btn btn-success mb-3"> <i class="fas fa-file-pdf"></i>  Generar Reporte PDF</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Proveedor</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Almacén</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="compras-table">
                    @foreach($compras as $compra)
                        <tr>
                            <td>{{ $compra->id_compra }}</td>
                            <td>{{ $compra->producto->nombre }}</td>
                            <td>{{ $compra->proveedor->nombre }}</td>
                            <td>{{ $compra->cantidad }}</td>
                            <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('Y-m-d') }}</td>
                            <td>{{ $compra->almacen->nombre }}</td>
                            <td>{{ number_format($compra->precio_unitario, 2) }}</td>
                            <td>{{ number_format($compra->total, 2) }}</td>
                            <td>
                                @if($compra->estado == 'pendiente')
                                    Completada
                                @else
                                    {{ ucfirst($compra->estado) }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('compras.show', ['compra' => $compra->id_compra]) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('compras.edit', ['compra' => $compra->id_compra]) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('compras.destroy', ['compra' => $compra->id_compra]) }}" method="POST" style="display:inline;" class="delete-form">
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
                {{ $compras->links() }}
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
                    text: "¿Deseas eliminar esta compra?",
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
            const rows = document.querySelectorAll('#compras-table tr');

            rows.forEach(function(row) {
                const producto = row.cells[1].textContent.toLowerCase();
                const proveedor = row.cells[2].textContent.toLowerCase();
                const almacen = row.cells[5].textContent.toLowerCase();

                if (producto.includes(searchValue) || proveedor.includes(searchValue) || almacen.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
