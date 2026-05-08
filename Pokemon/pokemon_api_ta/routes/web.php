<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', fn() => redirect()->route('aleatorio'));

Route::get('/aleatorio', [PokemonController::class, 'aleatorio'])->name('aleatorio');
Route::get('/pokedex', [PokemonController::class, 'pokedex'])->name('pokedex');
Route::get('/favoritos', [PokemonController::class, 'favoritos'])->name('favoritos');

// Compatibilidade com links antigos para rota principal.
Route::get('/pokemon', [PokemonController::class, 'aleatorio'])->name('pokemon.index');

Route::post('/pokemon/salvar', [PokemonController::class, 'salvar'])->name('pokemon.salvar');
Route::post('/pokemon/remover-favorito', [PokemonController::class, 'removerFavorito'])->name('pokemon.removerFavorito');

Route::get('/cadastro', [PokemonController::class, 'cadastroForm'])->name('pokemon.cadastroForm');
Route::post('/cadastro', [PokemonController::class, 'cadastrar'])->name('pokemon.cadastrar');