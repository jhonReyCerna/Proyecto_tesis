<!-- resources/views/ventadetalles/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Detalles de Ventas</h1>

    <!-- Mostrar mensaje de éxito si existe -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ventadetalles.create') }}" class="btn btn-primary">Crear Detalle de Venta</a>

    <table class="table">
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
                        <a href="{{ route('ventadetalles.edit', $ventaDetalle->id_detalle) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('ventadetalles.destroy', $ventaDetalle->id_detalle) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
