@extends('adminlte::page')

@section('title', 'Registrar Venta')

@section('content_header')
    <h1>Registrar Nueva Venta</h1>
@stop

@section('content')
    <form action="{{ route('gestionarventas.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control" required>
                        <option value="">Seleccionar Cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="totalPagar">Total a Pagar</label>
                    <input type="number" name="totalPagar" id="totalPagar" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="pagado">Pagado</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar Venta</button>
                    <a href="{{ route('gestionarventas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
@stop
