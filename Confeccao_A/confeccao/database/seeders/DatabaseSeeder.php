<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\clientes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // \App\Models\Clientes::factory(10)->create();
        Clientes::factory()->create([
            'nome' => 'Charlo',
            'cpf' => '123456789-12'
        ]);

        User::factory()->create([
            'name' => 'Charlo Confecções',
            'email' => 'test@example.com',
        ]);
    }
}
