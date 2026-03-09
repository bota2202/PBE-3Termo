<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estoque extends Model
{
     use HasFactory;

    protected $table = 'estoque';

    protected $fillable = [
        'nome',
        'quantidade',
        'reservado',
        'preco',
        'data_entrada'
    ];

    // quantidade disponível automaticamente
    public function getDisponivelAttribute()
    {
        return $this->quantidade - $this->reservado;
    }
}