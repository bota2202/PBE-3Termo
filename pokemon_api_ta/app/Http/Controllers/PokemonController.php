<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index(Request $request) {
        $busca=$request->input('pokemon')??rand(1,1025);
        $nomeOuId=strtolower($busca);
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$nomeOuId}");

        if ($response->successful()) {
            $pokemon = $response->json();
            return view('pokemon', compact('pokemon'));
        }

        return 'Erro ao buscar dados da API.';
    }
}