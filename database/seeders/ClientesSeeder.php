<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create(
            [
                'nome' => 'Maria',
                'email' => 'v@gmail.com',
                'endereco' => 'rua x',
                'logradouro' => 'rua x',
                'cep' => '217900',
                'bairro' => 'jardim x',
            ]
        );
        Cliente::create(
            [
                'nome' => 'Lucas',
                'email' => 'v@gmail.com',
                'endereco' => 'rua x',
                'logradouro' => 'rua x',
                'cep' => '217900',
                'bairro' => 'jardim x',
            ]
        );
    }
}
