@extends('layouts.app')

@section('content')
    <h1>Ventas</h1>

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Nueva Venta</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Cliente</th>
                <th>Total Pagar</th>
                <th>Fecha de Venta</th>
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
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>{{ $venta->estado }}</td>
                    <td>
                        <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-warning">Editar</a>

                        <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta venta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
