<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clientes>
 */
class clientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome'=>fake()->name(),
            'cpf'=>fake()->unique()->numerify('###########'),
            'email'=>fake()->unique()->safeEmail(),
            'telefone'=>fake()->numerify('#########'),
            'reserva'=>fake()->boolean()
        ];
    }
}
