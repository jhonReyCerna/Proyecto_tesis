@extends('adminlte::page')

@section('title', 'Agregar Almacén')

@section('content_header')
    <h1>Agregar Almacén</h1>
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

    <form id="almacenForm" action="{{ route('almacenes.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>
                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}" required>
                </div>
                <div class="mb-3">
                    <label for="capacidad" class="form-label">Capacidad</label>
                    <input type="number" name="capacidad" class="form-control" value="{{ old('capacidad') }}" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
                <a href="{{ route('almacenes.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas guardar este almacén?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('almacenForm').submit();
                }
            });
        });
    </script>
@stop
