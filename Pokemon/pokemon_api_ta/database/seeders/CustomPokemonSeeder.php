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
                'name'        => 'cravolt',
                'description' => 'Cravolt permanece enterrado parcialmente no subsolo por semanas. Os cristais em suas costas absorvem ondas mentais e pequenas vibrações da terra, permitindo que ele perceba intrusos antes mesmo que se aproximem.',
                'image'       => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2rpyOxn2KEipWvHPPBliAht56qZRvEu8uKw&s',
                'types'       => 'rock,psychic',
                'height'      => 14,
                'weight'      => 200,
                'hp'          => 160,
                'attack'      => 140,
                'defense'     => 140,
                'speed'       => 80,
                'abilities'   => 'Núncleo prismático',
            ],
            [
                'custom_id'   => 1028,
                'name'        => 'spectravault',
                'description' => 'Dizem que Spectravault surge em campos de batalha abandonados, atraído pela energia de confrontos intensos. O olho brilhante em seu torso lê a intenção do adversário antes do golpe acontecer. Em vez de caminhar, ele flutua em silêncio, e seus punhos espectrais concentram energia espiritual até ficarem densos o bastante para quebrar pedra.',
                'image'       => 'Imagem/spectravault.png',
                'types'       => 'fighting,ghost',
                'height'      => 18,
                'weight'      => 980,
                'hp'          => 80,
                'attack'      => 150,
                'defense'     => 80,
                'speed'       => 100,
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