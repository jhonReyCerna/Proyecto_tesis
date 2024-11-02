@extends('adminlte::page')

@section('title', 'Crear Cliente')

@section('content_header')
    <h1>Crear Cliente</h1>
@stop

@section('content')
    <form action="{{ route('clientes.store') }}" method="POST" id="clienteForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>

                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-control" id="genero" name="genero" required>
                        <option value="">Seleccione</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
                    <select class="form-control" id="tipo_cliente" name="tipo_cliente">
                        <option value="regular">Regular</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="guardarBtn">Crear</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas crear este cliente?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, crear',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('clienteForm').submit();
                }
            });
        });
    </script>
@stop
