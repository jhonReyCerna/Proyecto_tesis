

@extends('adminlte::page')

@section('title', 'Editar Proveedor')

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="proveedorForm" action="{{ route('proveedores.update', $proveedor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $proveedor->direccion) }}" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $proveedor->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="ruc" class="form-label">RUC</label>
                    <input type="text" class="form-control" id="ruc" name="ruc" value="{{ old('ruc', $proveedor->ruc) }}" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="updateBtn">Actualizar</button>
                <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('updateBtn').addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas actualizar este proveedor?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('proveedorForm').submit(); 
                }
            });
        });
    </script>
@stop
