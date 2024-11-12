@extends('adminlte::page')

@section('title', 'Gráficos')

@section('content_header')
    <h1>Gráficos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Proveedores</h3>
                </div>
                <div class="card-body">
                    <canvas id="proveedoresChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Categorías</h3>
                </div>
                <div class="card-body">
                    <canvas id="categoriasChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Clientes</h3>
                </div>
                <div class="card-body">
                    <canvas id="clientesChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Productos</h3>
                </div>
                <div class="card-body">
                    <canvas id="productosChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Compras Diarias y Mensuales</h3>
                </div>
                <div class="card-body">
                    <canvas id="comprasChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ventas Diarias y Mensuales</h3>
                </div>
                <div class="card-body">
                    <canvas id="ventasChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            // Proveedores
            var ctxProveedores = document.getElementById('proveedoresChart').getContext('2d');
            var proveedoresChart = new Chart(ctxProveedores, {
                type: 'bar',
                data: {
                    labels: ['Proveedores'],
                    datasets: [{
                        label: 'Cantidad',
                        data: [{{ $proveedoresCount }}],
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Categorías
            var ctxCategorias = document.getElementById('categoriasChart').getContext('2d');
            var categoriasChart = new Chart(ctxCategorias, {
                type: 'bar',
                data: {
                    labels: ['Categorías'],
                    datasets: [{
                        label: 'Cantidad',
                        data: [{{ $categoriasCount }}],
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Clientes
            var ctxClientes = document.getElementById('clientesChart').getContext('2d');
            var clientesChart = new Chart(ctxClientes, {
                type: 'bar',
                data: {
                    labels: ['Clientes'],
                    datasets: [{
                        label: 'Cantidad',
                        data: [{{ $clientesCount }}],
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Productos
            var ctxProductos = document.getElementById('productosChart').getContext('2d');
            var productosChart = new Chart(ctxProductos, {
                type: 'bar',
                data: {
                    labels: ['Productos'],
                    datasets: [{
                        label: 'Cantidad',
                        data: [{{ $productosCount }}],
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Compras Diarias y Mensuales
            var ctxCompras = document.getElementById('comprasChart').getContext('2d');
            var comprasChart = new Chart(ctxCompras, {
                type: 'bar',
                data: {
                    labels: ['Diarias', 'Mensuales'],
                    datasets: [{
                        label: 'Compras',
                        data: [{{ $comprasDiarias }}, {{ $comprasMensuales }}],
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Ventas Diarias y Mensuales
            var ctxVentas = document.getElementById('ventasChart').getContext('2d');
            var ventasChart = new Chart(ctxVentas, {
                type: 'bar',
                data: {
                    labels: ['Diarias', 'Mensuales'],
                    datasets: [{
                        label: 'Ventas',
                        data: [{{ $ventasDiarias }}, {{ $ventasMensuales }}],
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@stop
