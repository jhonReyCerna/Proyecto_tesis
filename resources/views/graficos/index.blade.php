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
                    <h3 class="card-title">Compras Mensuales</h3>
                </div>
                <div class="card-body">
                    <canvas id="comprasChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ventas Mensuales</h3>
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
            var proveedores = @json($proveedores);
            var nombresProveedores = proveedores.map(function(proveedor) {
                return proveedor.nombre;
            });
            var cantidadesProveedores = proveedores.map(function(proveedor) {
                return 1; // Asume 1 si no hay cantidad
            });

            var ctxProveedores = document.getElementById('proveedoresChart').getContext('2d');
            var proveedoresChart = new Chart(ctxProveedores, {
                type: 'pie',
                data: {
                    labels: nombresProveedores,
                    datasets: [{
                        label: 'Cantidad',
                        data: cantidadesProveedores,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Categorías
            var categorias = @json($categorias);
            var nombresCategorias = categorias.map(function(categoria) {
                return categoria.nombre;
            });
            var cantidadesCategorias = categorias.map(function(categoria) {
                return 1; // Asume 1 si no hay cantidad
            });

            var ctxCategorias = document.getElementById('categoriasChart').getContext('2d');
            var categoriasChart = new Chart(ctxCategorias, {
                type: 'pie',
                data: {
                    labels: nombresCategorias,
                    datasets: [{
                        label: 'Cantidad',
                        data: cantidadesCategorias,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Clientes
            var clientes = @json($clientes);
            var nombresClientes = clientes.map(function(cliente) {
                return cliente.nombre;
            });
            var cantidadesClientes = clientes.map(function(cliente) {
                return 1; // Asume 1 si no hay cantidad
            });

            var ctxClientes = document.getElementById('clientesChart').getContext('2d');
            var clientesChart = new Chart(ctxClientes, {
                type: 'pie',
                data: {
                    labels: nombresClientes,
                    datasets: [{
                        label: 'Cantidad',
                        data: cantidadesClientes,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Productos
            var productos = @json($productos);
            var nombresProductos = productos.map(function(producto) {
                return producto.nombre;
            });
            var cantidadesProductos = productos.map(function(producto) {
                return 1; // Asume 1 si no hay cantidad
            });

            var ctxProductos = document.getElementById('productosChart').getContext('2d');
            var productosChart = new Chart(ctxProductos, {
                type: 'pie',
                data: {
                    labels: nombresProductos,
                    datasets: [{
                        label: 'Cantidad',
                        data: cantidadesProductos,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Compras Mensuales
            var comprasMensuales = @json($comprasMensuales);
            var mesesCompras = comprasMensuales.map(function(compra) {
                return compra.mes;
            });
            var cantidadesCompras = comprasMensuales.map(function(compra) {
                return compra.cantidad;
            });

            var ctxCompras = document.getElementById('comprasChart').getContext('2d');
            var comprasChart = new Chart(ctxCompras, {
                type: 'bar',
                data: {
                    labels: mesesCompras,
                    datasets: [{
                        label: 'Compras',
                        data: cantidadesCompras,
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

            // Ventas Mensuales
            var ventasMensuales = @json($ventasMensuales);
            var mesesVentas = ventasMensuales.map(function(venta) {
                return venta.mes;
            });
            var cantidadesVentas = ventasMensuales.map(function(venta) {
                return venta.cantidad;
            });

            var ctxVentas = document.getElementById('ventasChart').getContext('2d');
            var ventasChart = new Chart(ctxVentas, {
                type: 'bar',
                data: {
                    labels: mesesVentas,
                    datasets: [{
                        label: 'Ventas',
                        data: cantidadesVentas,
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
