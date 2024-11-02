@extends('adminlte::page')

@section('title', 'Detalles del Cliente')

@section('content_header')
    <h1>Detalles del Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $cliente->nombre }}</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $cliente->id_cliente }}</p>
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $cliente->fecha_nacimiento }}</p>
            <p><strong>Género:</strong> {{ $cliente->genero }}</p>
            <p><strong>Tipo de Cliente:</strong> {{ $cliente->tipo_cliente }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('clientes.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@stop
