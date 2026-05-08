<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPokemon extends Model
{
    protected $table = 'custom_pokemon';

    protected $fillable = [
        'custom_id',
        'name',
        'image',
        'description',
        'types',
        'height',
        'weight',
        'hp',
        'attack',
        'defense',
        'speed',
        'abilities',
    ];

    /**
     * Retorna o próximo ID customizado disponível (começa em 1026).
     */
    public static function nextCustomId(): int
    {
        $last = static::max('custom_id');
        return $last ? $last + 1 : 1026;
    }

    /**
     * Converte o model para o formato de array similar ao da PokeAPI,
     * para ser exibido na mesma view do pokémon principal.
     */
    public function toPokeApiFormat(): array
    {
        $types = collect(explode(',', $this->types ?? ''))->filter()->map(fn($t) => [
            'type' => ['name' => trim($t)]
        ])->values()->toArray();

        $abilities = collect(explode(',', $this->abilities ?? ''))->filter()->map(fn($a) => [
            'ability' => ['name' => trim($a)]
        ])->values()->toArray();

        return [
            'id'     => $this->custom_id,
            'name'   => $this->name,
            'height' => $this->height,
            'weight' => $this->weight,
            'description' => $this->description,
            'is_custom' => true,
            'sprites' => [
                'other' => [
                    'official-artwork' => [
                        'front_default' => $this->image ?: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/0.png'
                    ]
                ]
            ],
            'types' => $types,
            'abilities' => $abilities,
            'stats' => [
                ['stat' => ['name' => 'hp'],      'base_stat' => $this->hp],
                ['stat' => ['name' => 'attack'],   'base_stat' => $this->attack],
                ['stat' => ['name' => 'defense'],  'base_stat' => $this->defense],
                ['stat' => ['name' => 'speed'],    'base_stat' => $this->speed],
            ],
            'moves' => [],
        ];
    }
}
