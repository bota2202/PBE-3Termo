<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estoque>
 */
class EstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->randomElement([
                'Camisa',
                'Lençol',
                'Cobertor',
                'Calça',
                'Vestido'
            ]),

            'quantidade' => fake()->numberBetween(0, 50),

            'reservado' => fake()->numberBetween(0, 10),

            'preco' => fake()->randomFloat(2, 20, 300),

            'data_entrada' => fake()->date()
        ];
    }
}
