<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\clientes;
use App\Models\Estoque;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        clientes::factory(10)->create();

        clientes::factory()->create([
            'nome'=>'Otávio',
            'cpf'=>'49092908851',
            'telefone'=>'19999495895',
            'email'=>"otaviosaturnino22@gmail.com",
            'reserva'=>'true'
        ]);

        Estoque::factory(10)->create();



        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
