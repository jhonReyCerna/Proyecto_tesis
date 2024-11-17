<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        if ($user->hasRole('gerente')) {
            return view('gerente.dashboard', [
                'user' => $user,
                'titulo' => 'Panel del Gerente',
                'secciones' => [
                    'ventas' => true,
                    'inventario' => true,
                    'categorias' => true,
                    'proveedores' => true,
                    'clientes' => true,
                    'usuarios' => true
                ]
            ]);
        }

        if ($user->hasRole('asesores de venta')) {
            return view('ventas.dashboard', [
                'user' => $user,
                'titulo' => 'Panel de Asesor de Ventas',
                'secciones' => [
                    'ventas' => true,
                    'clientes' => true
                ]
            ]);
        }

        if ($user->hasRole('jefe de almacen')) {
            return view('almacen.dashboard', [
                'user' => $user,
                'titulo' => 'Panel de Jefe de Almacén',
                'secciones' => [
                    'inventario' => true,
                    'proveedores' => true
                ]
            ]);
        }

        if ($user->hasRole('cajera')) {
            return view('cajera.dashboard', [
                'user' => $user,
                'titulo' => 'Panel de Cajera',
                'secciones' => [
                    'ventas' => true,
                    'clientes' => true,
                    'productos' => true
                ]
            ]);
        }

        return view('dashboard', [
            'user' => $user,
            'titulo' => 'Panel de Usuario'
        ]);
    }
}

