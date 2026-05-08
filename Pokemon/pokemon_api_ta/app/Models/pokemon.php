<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pokemon extends Model
{
    protected $fillable = [
        'pokemon_api_id',
        'name',
        'image',
    ];
}
