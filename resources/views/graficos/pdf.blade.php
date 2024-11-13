<!DOCTYPE html>
<html>
<head>
    <title>Estadísticas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .stats-box {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
        }
        .title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Estadísticas</h1>

        <div class="stats-box">
            <h3>Proveedores</h3>
            <p>Total: {{ $data['proveedores'] }}</p>
        </div>

        <div class="stats-box">
            <h3>Categorías</h3>
            <p>Total: {{ $data['categorias'] }}</p>
        </div>

        <div class="stats-box">
            <h3>Clientes</h3>
            <p>Total: {{ $data['clientes'] }}</p>
        </div>

        <div class="stats-box">
            <h3>Productos</h3>
            <p>Total: {{ $data['productos'] }}</p>
        </div>
    </div>
</body>
</html>
