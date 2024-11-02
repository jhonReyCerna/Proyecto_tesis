@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
    <form action="{{ route('clientes.update', $cliente) }}" method="POST" id="clienteForm">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $cliente->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ $cliente->dni }}" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $cliente->fecha_nacimiento }}" required>
                </div>

                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-control" id="genero" name="genero" required>
                        <option value="">Seleccione</option>
                        <option value="masculino" {{ $cliente->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ $cliente->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="otro" {{ $cliente->genero == 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
                    <select class="form-control" id="tipo_cliente" name="tipo_cliente">
                        <option value="regular" {{ $cliente->tipo_cliente == 'regular' ? 'selected' : '' }}>Regular</option>
                        <option value="vip" {{ $cliente->tipo_cliente == 'vip' ? 'selected' : '' }}>VIP</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="guardarBtn">Actualizar</button>
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
                text: "¿Deseas actualizar este cliente?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('clienteForm').submit();
                }
            });
        });
    </script>
@stop
