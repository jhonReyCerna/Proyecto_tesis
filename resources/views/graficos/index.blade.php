@extends('adminlte::page')

@section('title', 'Gráficos')

@section('content_header')
    <h1>Gráficos Estadísticos</h1>
@stop

@section('content')

<div class="mb-4">
    <a href="{{ route('graficos.pdf') }}" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Descargar PDF
    </a>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Proveedores</h3>
            </div>
            <div class="card-body" style="height: 400px; display: flex; justify-content: center; align-items: center;">
                <div style="width: 80%;">
                    <canvas id="proveedoresChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categorías</h3>
            </div>
            <div class="card-body" style="height: 400px; display: flex; justify-content: center; align-items: center;">
                <div style="width: 80%;">
                    <canvas id="categoriasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Clientes</h3>
            </div>
            <div class="card-body" style="height: 400px; display: flex; justify-content: center; align-items: center;">
                <div style="width: 60%;">
                    <canvas id="clientesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Productos</h3>
            </div>
            <div class="card-body" style="height: 400px; display: flex; justify-content: center; align-items: center;">
                <div style="width: 80%;">
                    <canvas id="productosChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Productos por Stock</h3>
            </div>
            <div class="card-body" style="height: 400px; display: flex; justify-content: center; align-items: center;">
                <div style="width: 50%;">
                    <canvas id="productosStockChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ventas por Mes</h3>
            </div>
            <div class="card-body" style="height: 400px; display: flex; justify-content: center; align-items: center;">
                <div style="width: 80%;">
                    <canvas id="ventasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const data = @json($data);


    const commonOptions = {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 1.5,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true
            }
        }
    };

    const ctxProveedores = document.getElementById('proveedoresChart').getContext('2d');
    new Chart(ctxProveedores, {
        type: 'bar',
        data: {
            labels: ['Proveedores'],
            datasets: [{
                label: 'Frecuencia',
                data: [data.proveedores],
                backgroundColor: ['rgba(255, 99, 132, 0.8)'],
                borderColor: ['rgb(255, 99, 132)'],
                borderWidth: 1,
                barPercentage: 1.0,
                categoryPercentage: 1.0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: `Distribución de Proveedores: ${data.proveedores}`
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Frecuencia'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: ''
                    }
                }
            }
        }
    });


    const ctxCategorias = document.getElementById('categoriasChart').getContext('2d');
    new Chart(ctxCategorias, {
        type: 'line',
        data: {
            labels: ['Categorías'],
            datasets: [{
                label: 'Cantidad de Categorías',
                data: [data.categorias],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointBorderColor: '#fff',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: `Total Categorías: ${data.categorias}`
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    const ctxClientes = document.getElementById('clientesChart').getContext('2d');
    new Chart(ctxClientes, {
        type: 'pie',
        data: {
            labels: ['Clientes'],
            datasets: [{
                data: [data.clientes],
                backgroundColor: ['rgba(255, 206, 86, 0.8)'],
                borderColor: ['rgb(255, 206, 86)'],
                borderWidth: 1
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    ...commonOptions.plugins.title,
                    text: `Total Clientes: ${data.clientes}`
                }
            }
        }
    });

    const ctxProductos = document.getElementById('productosChart').getContext('2d');
    new Chart(ctxProductos, {
        type: 'bar',
        data: {
            labels: ['Productos'],
            datasets: [{
                label: 'Cantidad de Productos',
                data: [data.productos],
                backgroundColor: ['rgba(75, 192, 192, 0.8)'],
                borderColor: ['rgb(75, 192, 192)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: `Total Productos: ${data.productos}`
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

     const ctxProductosStock = document.getElementById('productosStockChart').getContext('2d');
    new Chart(ctxProductosStock, {
        type: 'doughnut',
        data: {
            labels: ['Stock Bajo', 'Stock Normal', 'Stock Alto'],
            datasets: [{
                data: [data.stockBajo, data.stockNormal, data.stockAlto],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(54, 162, 235, 0.8)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Distribución de Stock de Productos'
                }
            }
        }
    });

     const ctxVentas = document.getElementById('ventasChart').getContext('2d');
    new Chart(ctxVentas, {
        type: 'line',
        data: {
            labels: data.meses,
            datasets: [{
                label: 'Ventas Mensuales',
                data: data.ventasPorMes,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Tendencia de Ventas Mensuales'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Número de Ventas'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mes'
                    }
                }
            }
        }
    });
});
</script>
@stop
