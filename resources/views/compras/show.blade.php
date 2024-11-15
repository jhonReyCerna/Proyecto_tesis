@extends('adminlte::page')

@section('title', 'Detalle de Compra')

@section('content_header')
    <h1>Detalle de Compra #{{ $compra->id_compra }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información de la Compra</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID Compra:</th>
                                    <td>{{ $compra->id_compra }}</td>
                                </tr>
                                <tr>
                                    <th>Producto:</th>
                                    <td>{{ $compra->producto->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Proveedor:</th>
                                    <td>{{ $compra->proveedor->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Almacén:</th>
                                    <td>{{ $compra->almacen->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha:</th>
                                    <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Detalles de la Transacción</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Cantidad:</th>
                                    <td>{{ $compra->cantidad }}</td>
                                </tr>
                                <tr>
                                    <th>Precio Unitario:</th>
                                    <td>S/. {{ number_format($compra->precio_unitario, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>S/. {{ number_format($compra->total, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($compra->estado == 'pendiente')
                                            <span class="badge badge-success">Completada</span>
                                        @else
                                            <span class="badge badge-warning">{{ ucfirst($compra->estado) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('compras.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('compras.edit', $compra->id_compra) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
