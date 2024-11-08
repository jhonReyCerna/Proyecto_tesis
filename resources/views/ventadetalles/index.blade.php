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

    <form action="" method="POST" id="clienteForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Campo Cliente -->
                    <div class="col-md-4">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option value="">Seleccionar Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" data-dni="{{ $cliente->dni }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="dni_search" class="form-label">Buscar por DNI</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="dni_search" placeholder="Buscar por DNI">
                            <button type="button" class="btn btn-success" id="buscarDniBtn">Buscar</button>
                        </div>
                    </div>


                    <!-- Campo Fecha -->
                    <div class="col-md-4">
                        <label for="fecha_search" class="form-label">Buscar por Fecha</label>
                        <input type="date" class="form-control" id="fecha_search" placeholder="Seleccionar Fecha">
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="producto_id" class="form-label">Producto</label>
                        <select name="producto_id" id="producto_id" class="form-control" required>
                            <option value="">Seleccionar Producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="cantidad_productos" class="form-label">Cantidad de productos</label>
                        <input type="number" class="form-control" id="cantidad_productos" name="cantidad_productos" required>
                    </div>

                    <div class="col-md-4 d-flex">
                        <button type="button" class="btn btn-primary ms-2" id="registrarBtn">Agregar</button>
                    </div>
                </div>

    </form>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="ventas-table">
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
                <tbody>
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

            // Función de búsqueda para DNI
            document.getElementById('buscarDniBtn').addEventListener('click', function() {
    const dniInput = document.getElementById('dni_search').value.trim();
    const clienteSelect = document.getElementById('cliente_id');

    // Verificar si el campo de búsqueda está vacío
    if (dniInput === '') {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, ingresa un DNI para buscar.',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

    // Recorrer las opciones del select para encontrar el DNI
    let clienteEncontrado = false;
    for (let i = 0; i < clienteSelect.options.length; i++) {
        const option = clienteSelect.options[i];
        const dni = option.getAttribute('data-dni');

        if (dni === dniInput) {
            clienteSelect.value = option.value; // Seleccionar el cliente
            clienteEncontrado = true;

            // Mostrar alerta de cliente encontrado
            Swal.fire({
                title: 'Cliente Encontrado',
                text: `El cliente ${option.text} ha sido seleccionado.`,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            break;
        }
    }

    // Mostrar alerta si no se encontró el cliente
    if (!clienteEncontrado) {
        Swal.fire({
            title: 'Cliente No Encontrado',
            text: 'No se encontró un cliente con el DNI proporcionado.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
});
    </script>
@stop
