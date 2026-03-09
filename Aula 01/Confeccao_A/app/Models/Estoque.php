<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    /** @use HasFactory<\Database\Factories\EstoqueFactory> */
    use HasFactory;

    protected $table='Estoque';

    protected $fillabe=[
        'produto',
        'quantidade',
        'preco'
    ];

    public $timestamps=false;
}
