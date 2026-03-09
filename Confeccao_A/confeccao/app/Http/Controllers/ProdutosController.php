<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::orderByDesc('id')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:2|max:255',
            'descricao' => 'nullable|string|max:500',
            'preco' => 'required|numeric|min:0|max:999999.99',
            'categoria' => 'required|string|max:255',
        ], [
            'nome.required' => 'O nome do produto é obrigatório.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser numérico.',
            'categoria.required' => 'A categoria é obrigatória.',
        ]);

        Produtos::create($request->all());

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }
}