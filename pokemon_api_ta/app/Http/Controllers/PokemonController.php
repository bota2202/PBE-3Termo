<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pokemon;
use App\Models\CustomPokemon;

class PokemonController extends Controller
{
    /**
     * Tela principal: exibe um pokémon aleatório (ou buscado/favorito),
     * junto com a lista de favoritos.
     */
    public function index(Request $request)
    {
        $favoritos   = Pokemon::latest()->get();
        $customTotal = CustomPokemon::count();
        $maxId       = 1025 + $customTotal;

        $busca      = $request->input('pokemon');
        $favoritoId = $request->input('favorito_id');

        if ($favoritoId) {
            $fav = Pokemon::find($favoritoId);
            if ($fav) {
                $busca = $fav->pokemon_api_id;
            }
        }

        if (!$busca) {
            $busca = rand(1, $maxId);
        }

        $busca = is_numeric($busca) ? (int) $busca : strtolower($busca);

        if (is_int($busca) && $busca >= 1026) {
            $custom = CustomPokemon::where('custom_id', $busca)->first();
            if (!$custom) {
                $busca = rand(1, 1025);
            } else {
                $pokemon = $custom->toPokeApiFormat();
                return view('pokemon', compact('pokemon', 'favoritos'));
            }
        }

        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$busca}");

        if ($response->successful()) {
            $pokemon = $response->json();
            $pokemon['is_custom'] = false;

            try {
                $species = Http::get("https://pokeapi.co/api/v2/pokemon-species/{$pokemon['id']}")->json();
                $flavor  = collect($species['flavor_text_entries'] ?? [])->firstWhere('language.name', 'en');
                $pokemon['description'] = $flavor ? preg_replace('/\s+/', ' ', $flavor['flavor_text']) : null;
            } catch (\Throwable $e) {
                $pokemon['description'] = null;
            }

            return view('pokemon', compact('pokemon', 'favoritos'));
        }

        return redirect()->route('pokedex')->with('erro', 'Pokémon não encontrado!');
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'pokemon_id' => 'required|integer',
            'name'       => 'required|string',
            'image'      => 'nullable|string',
        ]);

        Pokemon::firstOrCreate(
            ['pokemon_api_id' => $request->pokemon_id],
            ['name' => $request->name, 'image' => $request->image]
        );

        return back()->with('sucesso', "Pokémon '{$request->name}' favoritado!");
    }

    public function removerFavorito(Request $request)
    {
        Pokemon::find($request->id)?->delete();
        return back()->with('sucesso', 'Pokémon removido dos favoritos.');
    }

    public function cadastroForm()
    {
        $proximoId = CustomPokemon::nextCustomId();
        return view('cadastro', compact('proximoId'));
    }

    public function cadastrar(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|min:2|max:100',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|url',
            'types'       => 'required|string',
            'height'      => 'required|integer|min:1',
            'weight'      => 'required|integer|min:1',
            'hp'          => 'required|integer|min:1|max:255',
            'attack'      => 'required|integer|min:1|max:255',
            'defense'     => 'required|integer|min:1|max:255',
            'speed'       => 'required|integer|min:1|max:255',
            'abilities'   => 'nullable|string',
        ]);

        $custom = CustomPokemon::create([
            'custom_id'   => CustomPokemon::nextCustomId(),
            'name'        => strtolower(trim($request->name)),
            'description' => $request->description,
            'image'       => $request->image,
            'types'       => $request->types,
            'height'      => $request->height,
            'weight'      => $request->weight,
            'hp'          => $request->hp,
            'attack'      => $request->attack,
            'defense'     => $request->defense,
            'speed'       => $request->speed,
            'abilities'   => $request->abilities,
        ]);

        return redirect()->route('pokedex', ['pokemon' => $custom->custom_id])
            ->with('sucesso', "Pokémon '{$custom->name}' cadastrado! ID: #{$custom->custom_id}");
    }
}
