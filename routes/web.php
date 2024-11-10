<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaDetalleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

Route::get('/', function () {
    return redirect('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('proveedor/index', [ProveedorController::class, 'index'])->name('proveedores.index');

Route::get('proveedor/create', [ProveedorController::class, 'create'])->name('proveedores.create');

Route::post('proveedor/store', [ProveedorController::class, 'store'])->name('proveedores.store');

Route::get('proveedor/show/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');

Route::get('proveedor/edit/{proveedor}', [ProveedorController::class, 'edit'])->name('proveedores.edit');

Route::put('proveedor/update/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');

Route::delete('proveedor/destroy/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

//--------------------------------------------------------------------------------------------------------------------------

Route::get('categoria/index', [CategoriaController::class, 'index'])->name('categorias.index');

Route::get('categoria/create', [CategoriaController::class, 'create'])->name('categorias.create');

Route::post('categoria/store', [CategoriaController::class, 'store'])->name('categorias.store');

Route::get('categoria/show/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('categoria/edit/{categoria}', [CategoriaController::class, 'edit'])->name('categorias.edit');

Route::put('categoria/update/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

Route::delete('categoria/destroy/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

//--------------------------------------------------------------------------------------------------------------------------

Route::get('cliente/index', [ClienteController::class, 'index'])->name('clientes.index');

Route::get('cliente/create', [ClienteController::class, 'create'])->name('clientes.create');

Route::post('cliente/store', [ClienteController::class, 'store'])->name('clientes.store');

Route::get('cliente/show/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');

Route::get('cliente/edit/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');

Route::put('cliente/update/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');

Route::delete('cliente/destroy/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('cliente/buscar/{dni}', [ClienteController::class, 'buscarPorDni'])->name('clientes.buscarPorDni');


//--------------------------------------------------------------------------------------------------------------------------

Route::get('almacen/index', [AlmacenController::class, 'index'])->name('almacenes.index');

Route::get('almacen/create', [AlmacenController::class, 'create'])->name('almacenes.create');

Route::post('almacen/store', [AlmacenController::class, 'store'])->name('almacenes.store');

Route::get('almacen/show/{almacen}', [AlmacenController::class, 'show'])->name('almacenes.show');

Route::get('almacen/edit/{almacen}', [AlmacenController::class, 'edit'])->name('almacenes.edit');

Route::put('almacen/update/{almacen}', [AlmacenController::class, 'update'])->name('almacenes.update');

Route::delete('almacen/destroy/{almacen}', [AlmacenController::class, 'destroy'])->name('almacenes.destroy');

//--------------------------------------------------------------------------------------------------------------------------

Route::get('producto/index', [ProductoController::class, 'index'])->name('productos.index');

Route::get('producto/create', [ProductoController::class, 'create'])->name('productos.create');

Route::post('producto/store', [ProductoController::class, 'store'])->name('productos.store');

Route::get('producto/show/{producto}', [ProductoController::class, 'show'])->name('productos.show');

Route::get('producto/edit/{producto}', [ProductoController::class, 'edit'])->name('productos.edit');

Route::put('producto/update/{producto}', [ProductoController::class, 'update'])->name('productos.update');

Route::delete('producto/destroy/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

//--------------------------------------------------------------------------------------------------------------------------

Route::get('compra/index', [CompraController::class, 'index'])->name('compras.index');

Route::get('compra/create', [CompraController::class, 'create'])->name('compras.create');

Route::post('compra/store', [CompraController::class, 'store'])->name('compras.store');

Route::get('compra/show/{compra}', [CompraController::class, 'show'])->name('compras.show');

Route::get('compra/edit/{compra}', [CompraController::class, 'edit'])->name('compras.edit');

Route::put('compra/update/{compra}', [CompraController::class, 'update'])->name('compras.update');

Route::delete('compra/destroy/{compra}', [CompraController::class, 'destroy'])->name('compras.destroy');

Route::get('compras/reporte', [CompraController::class, 'generarReportePDF'])->name('compras.reporte');

//--------------------------------------------------------------------------------------------------------------------------
Route::get('venta/index', [VentaController::class, 'index'])->name('ventas.index');

Route::get('venta/create', [VentaController::class, 'create'])->name('ventas.create');

Route::post('venta/store', [VentaController::class, 'store'])->name('ventas.store');

Route::get('venta/show/{venta}', [VentaController::class, 'show'])->name('ventas.show');

Route::get('venta/edit/{venta}', [VentaController::class, 'edit'])->name('ventas.edit');

Route::put('venta/update/{venta}', [VentaController::class, 'update'])->name('ventas.update');

Route::delete('venta/destroy/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');

Route::get('ventas/reporte', [VentaController::class, 'generarReportePDF'])->name('ventas.reporte');

Route::get('venta/buscar-cliente/{dni}', [VentaController::class, 'buscarClientePorDni'])->name('ventas.buscarClientePorDni');

Route::get('venta/{id}/factura', [VentaController::class, 'facturaPDF'])->name('ventas.factura');



//----------------------------------------------------------------------------------------------------------

Route::get('venta_detalles/index', [VentaDetalleController::class, 'index'])->name('ventadetalles.index');

Route::get('venta_detalles/create', [VentaDetalleController::class, 'create'])->name('ventadetalles.create');

Route::post('venta_detalles/store', [VentaDetalleController::class, 'store'])->name('ventadetalles.store');

Route::get('venta_detalles/show/{ventadetalle}', [VentaDetalleController::class, 'show'])->name('ventadetalles.show');

Route::get('venta_detalles/edit/{ventadetalle}', [VentaDetalleController::class, 'edit'])->name('ventadetalles.edit');

Route::put('venta_detalles/update/{ventadetalle}', [VentaDetalleController::class, 'update'])->name('ventadetalles.update');

Route::delete('venta_detalles/destroy/{ventadetalle}', [VentaDetalleController::class, 'destroy'])->name('ventadetalles.destroy');


