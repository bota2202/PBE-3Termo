<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscoveredPokemon extends Model
{
    protected $table = 'discovered_pokemon';

    protected $fillable = [
        'pokemon_api_id',
        'name',
        'image',
    ];
}
