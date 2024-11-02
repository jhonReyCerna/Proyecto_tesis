@extends('adminlte::page')

@section('title', 'Detalles de Categoría')

@section('content_header')
    <h1>Detalles de la Categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $categoria->id_categoria }}</p>
            <p><strong>Nombre:</strong> {{ $categoria->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $categoria->descripcion }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('categorias.index') }}" class="btn btn-primary">Regresar</a>
        </div>
    </div>
@stop
