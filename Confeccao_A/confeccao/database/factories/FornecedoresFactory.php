<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedoresFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->company(),
            'cnpj' => fake()->unique()->numerify('##.###.###/####-##'),
            'telefone' => fake('pt_BR')->cellphoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'cidade' => fake()->city(),
        ];
    }
}