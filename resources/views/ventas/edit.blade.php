@extends('adminlte::page')

@section('title', 'Editar Venta')

@section('content_header')
    <h1>Editar Venta</h1>
@stop

@section('content')
    <form action="{{ route('ventas.update', $venta->id_venta) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" {{ $cliente->id_cliente == $venta->cliente_id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="totalPagar">Total a Pagar</label>
            <input type="number" name="totalPagar" id="totalPagar" class="form-control" value="{{ $venta->totalPagar }}" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $venta->fecha }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Pendiente" {{ $venta->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Pagado" {{ $venta->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar Venta</button>
    </form>
@stop
