@extends('adminlte::page')

@section('title', 'Detalles del Almacén')

@section('content_header')
    <h1>Detalles del Almacén</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre: {{ $almacen->nombre }}</h5>
            <p class="card-text">Ubicación: {{ $almacen->ubicacion }}</p>
            <p class="card-text">Capacidad: {{ $almacen->capacidad }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('almacenes.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
@stop
