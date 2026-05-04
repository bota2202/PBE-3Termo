<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomPokemon;

class CustomPokemonSeeder extends Seeder
{
    public function run(): void
    {
        $pokemons = [
            [
                'custom_id'   => 1026,
                'name'        => 'folbara',
                'description' => 'Dizem que rios pequenos costumam surgir próximos aos lugares onde Folbara dorme por muitos dias. Pequenas sementes presas em sua pelagem criam raízes enquanto ele descansa ao sol.',
                'image'       => 'https://preview.redd.it/water-starter-capybara-made-for-the-which-pokedex-do-you-v0-3yp138x7kmod1.png?width=640&crop=smart&auto=webp&s=b5dfe247cb449892893ee695c9c9fa3fa49bdda6',
                'types'       => 'grass,ground',
                'height'      => 22,
                'weight'      => 600,
                'hp'          => 120,
                'attack'      => 80,
                'defense'     => 105,
                'speed'       => 50,
                'abilities'   => 'solo fertil, raiz de barro',
            ],
            [
                'custom_id'   => 1027,
                'name'        => 'aqushade',
                'description' => 'Habita as profundezas dos oceanos. Emite uma luz hipnótica para atrair suas presas nas trevas.',
                'image'       => 'https://static.wikia.nocookie.net/capx/images/b/b3/Aguanaut_Sugi_B4c.png/revision/latest/scale-to-width-down/1200?cb=20150524024100',
                'types'       => 'water,dark',
                'height'      => 14,
                'weight'      => 580,
                'hp'          => 110,
                'attack'      => 75,
                'defense'     => 90,
                'speed'       => 85,
                'abilities'   => 'water-absorb,illuminate',
            ],
            [
                'custom_id'   => 1028,
                'name'        => 'thorvine',
                'description' => 'Uma entidade vegetal milenar. Suas raízes se estendem por quilômetros e absorvem energia da terra.',
                'image'       => 'https://img.pokemondb.net/artwork/large/venusaur.jpg',
                'types'       => 'grass,ground',
                'height'      => 18,
                'weight'      => 980,
                'hp'          => 120,
                'attack'      => 90,
                'defense'     => 115,
                'speed'       => 55,
                'abilities'   => 'overgrow,drought',
            ],
        ];

        foreach ($pokemons as $data) {
            CustomPokemon::firstOrCreate(
                ['custom_id' => $data['custom_id']],
                $data
            );
        }
    }
}