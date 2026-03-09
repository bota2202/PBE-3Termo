<?php

namespace Database\Factories;

use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Clientes::inRandomOrder()->value('id') 
                ?? Clientes::factory(),

            'status' => fake()->randomElement([
                'aberto',
                'reservado',
                'pendente',
                'finalizado'
            ]),

            'data_pedido' => fake()->date(),
        ];
    }
}