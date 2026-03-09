<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produtos>
 */
class ProdutosFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->randomElement([
                'Camisa',
                'Lençol',
                'Cobertor',
                'Calça',
                'Vestido',
                'Toalha',
            ]),
            'descricao' => fake()->sentence(),
            'preco' => fake()->randomFloat(2, 20, 300),
            'categoria' => fake()->randomElement([
                'Roupa',
                'Cama',
                'Banho',
            ]),
        ];
    }
}