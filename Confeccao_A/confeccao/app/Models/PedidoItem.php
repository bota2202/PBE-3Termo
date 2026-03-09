<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedidos;
use App\Models\Estoque;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'pedido_itens';

    protected $fillable = [
        'pedido_id',
        'estoque_id',
        'quantidade',
        'quantidade_reservada',
        'quantidade_em_falta',
        'preco_unitario',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'pedido_id');
    }

    public function estoque()
    {
        return $this->belongsTo(Estoque::class, 'estoque_id');
    }
}