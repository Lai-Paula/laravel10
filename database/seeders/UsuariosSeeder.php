<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
   
    public function run(): void
    {
        User::create(
            [
                'name' => 'Layla',
                'email' => 't@gmail.com',
                'password' => Hash::make('senha123'), //hash por cima
            ]
        );
    }
}
