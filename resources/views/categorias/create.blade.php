@extends('adminlte::page')

@section('title', 'Agregar Categoría')

@section('content_header')
    <h1>Agregar Categoría</h1>
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

    <form id="categoriaForm" action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas guardar esta categoría?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('categoriaForm').submit();
                }
            });
        });
    </script>
@stop
