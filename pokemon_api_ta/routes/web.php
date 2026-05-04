<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', fn() => redirect()->route('pokedex'));

Route::get('/pokedex', [PokemonController::class, 'index'])->name('pokedex');
Route::post('/pokemon/salvar', [PokemonController::class, 'salvar'])->name('pokemon.salvar');
Route::post('/pokemon/remover-favorito', [PokemonController::class, 'removerFavorito'])->name('pokemon.removerFavorito');

Route::get('/cadastro', [PokemonController::class, 'cadastroForm'])->name('pokemon.cadastroForm');
Route::post('/cadastro', [PokemonController::class, 'cadastrar'])->name('pokemon.cadastrar');
