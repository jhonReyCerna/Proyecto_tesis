

@extends('adminlte::page')

@section('title', 'Agregar Proveedor')

@section('content_header')
    <h1>Agregar Proveedor</h1>
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

    <form id="proveedorForm" action="{{ route('proveedores.store') }}" method="POST">
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
                    <label for="ruc" class="form-label">RUC</label>
                    <input type="text" class="form-control" id="ruc" name="ruc" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
                <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function(event) {
            event.preventDefault(); 

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas guardar este proveedor?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('proveedorForm').submit(); 
                }
            });
        });
    </script>
@stop
