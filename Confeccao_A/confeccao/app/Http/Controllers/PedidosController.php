<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\PedidoItem;
use App\Models\Estoque;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedidos::with(['cliente', 'itens.estoque'])
            ->orderByDesc('id')
            ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Clientes::orderBy('nome')->get();
        $produtos = Estoque::orderBy('nome')->get();

        return view('pedidos.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'estoque_id' => ['required', 'exists:estoque,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ], [
            'cliente_id.required' => 'Selecione um cliente.',
            'cliente_id.exists' => 'Cliente inválido.',
            'estoque_id.required' => 'Selecione um item do estoque.',
            'estoque_id.exists' => 'Item do estoque inválido.',
            'quantidade.required' => 'Informe a quantidade.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade mínima é 1.',
        ]);

        DB::transaction(function () use ($data) {
            $produto = Estoque::lockForUpdate()->findOrFail($data['estoque_id']);

            $disponivel = $produto->quantidade - $produto->reservado;
            $qtd = (int) $data['quantidade'];

            $reservar = max(0, min($disponivel, $qtd));
            $falta = max(0, $qtd - $reservar);

            $pedido = Pedidos::create([
                'cliente_id' => $data['cliente_id'],
                'status' => $falta > 0 ? 'pendente' : 'reservado',
                'data_pedido' => now()->toDateString(),
            ]);

            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'estoque_id' => $produto->id,
                'quantidade' => $qtd,
                'quantidade_reservada' => $reservar,
                'quantidade_em_falta' => $falta,
                'preco_unitario' => $produto->preco,
            ]);

            $produto->reservado = $produto->reservado + $reservar;
            $produto->save();
        });

        return redirect()
            ->route('pedidos.index')
            ->with('success', 'Pedido cadastrado com sucesso!');
    }
}