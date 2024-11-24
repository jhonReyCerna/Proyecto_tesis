<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Gerente',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Asesor',
                'email' => 'asesor@admin.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Almacen',
                'email' => 'almacen@admin.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Cajera',
                'email' => 'cajera@admin.com',
                'password' => Hash::make('password'),
            ],


        ];

        foreach ($users as $user) {
            $newUser = User::create($user);


            switch($user['name']) {
                case 'Gerente':
                    $newUser->assignRole('gerente');
                    break;
                case 'Asesor':
                    $newUser->assignRole('asesores de venta');
                    break;
                case 'Almacen':
                    $newUser->assignRole('jefe de almacen');
                    break;
                case 'Cajera':
                    $newUser->assignRole('cajera');
                    break;
            }
        }
    }
}
