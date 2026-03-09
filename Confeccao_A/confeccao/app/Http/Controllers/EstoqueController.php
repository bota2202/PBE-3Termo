<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use Carbon\Carbon;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoque = Estoque::all();
        return view('estoque.index', compact('estoque'));
    }

    public function create()
    {
        return view('estoque.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:2|max:255',
            'quantidade' => 'required|integer|min:0|max:999999',
            'reservado' => 'required|integer|min:0|max:999999',
            'preco' => 'nullable|numeric|min:0|max:999999.99',
            'data_entrada' => 'nullable|date|before_or_equal:today',
        ], [
            'nome.required' => 'O nome do item é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo 2 caracteres.',

            'quantidade.required' => 'A quantidade é obrigatória.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade não pode ser negativa.',

            'reservado.required' => 'O campo reservado é obrigatório.',
            'reservado.integer' => 'O campo reservado deve ser um número inteiro.',
            'reservado.min' => 'O valor reservado não pode ser negativo.',

            'preco.numeric' => 'O preço deve ser numérico.',
            'preco.min' => 'O preço não pode ser negativo.',

            'data_entrada.date' => 'Informe uma data válida.',
            'data_entrada.before_or_equal' => 'A data de entrada não pode ser maior que hoje.',
        ]);

        if ((int) $request->reservado > (int) $request->quantidade) {
            return back()
                ->withErrors(['reservado' => 'O valor reservado não pode ser maior que a quantidade total.'])
                ->withInput();
        }

        if ($request->filled('data_entrada') && Carbon::parse($request->data_entrada)->isFuture()) {
            return back()
                ->withErrors(['data_entrada' => 'A data de entrada não pode ser futura.'])
                ->withInput();
        }

        Estoque::create([
            'nome' => $request->nome,
            'quantidade' => $request->quantidade,
            'reservado' => $request->reservado,
            'preco' => $request->preco,
            'data_entrada' => $request->data_entrada,
        ]);

        return redirect()
            ->route('estoque.index')
            ->with('success', 'Item cadastrado no estoque com sucesso!');
    }
}