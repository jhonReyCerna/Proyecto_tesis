<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Almacen;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    
    public function index()
    {
       
        $productos = Producto::with('categoria', 'proveedor', 'almacen')->get();
        $productos = Producto::paginate(10);
 
        return view('productos.index', compact('productos'));
    }

  
    public function create()
    {
         
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        $almacenes = Almacen::all();
 
        return view('productos.create', compact('categorias', 'proveedores', 'almacenes'));
    }

   
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0', // Asegúrate de que sea un número positivo
        'stock' => 'required|integer|min:0',
        'id_categoria' => 'required|exists:categorias,id_categoria',
        'id_proveedor' => 'required|exists:proveedores,id_proveedor',
        'id_almacen' => 'required|exists:almacenes,id_almacen',
    ]);

    // Guardar el producto
    Producto::create($request->all());

    return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
}

  
    public function show($id)
    {
      
        $producto = Producto::with('categoria', 'proveedor', 'almacen')->findOrFail($id);
 
        return view('productos.show', compact('producto'));
    }
 
    public function edit($id)
    {
        
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        $almacenes = Almacen::all();
 
        return view('productos.edit', compact('producto', 'categorias', 'proveedores', 'almacenes'));
    }
 
    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
            'id_almacen' => 'required|exists:almacenes,id_almacen',
        ]);
 
        $producto = Producto::findOrFail($id);
        $producto->update($validated);
 
        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito');
    }

     
    public function destroy($id)
    {
         
        $producto = Producto::findOrFail($id);
        $producto->delete();
 
        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito');
    }
}
