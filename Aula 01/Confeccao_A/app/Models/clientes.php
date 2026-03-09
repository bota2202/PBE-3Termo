<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'reserva',
        'email'
    ];

    public $timestamps = false; // coloque isso se sua tabela não tiver created_at e updated_at
}