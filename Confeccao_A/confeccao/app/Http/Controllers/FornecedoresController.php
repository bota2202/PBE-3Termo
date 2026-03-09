<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedores;

class FornecedoresController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedores::all();
        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('fornecedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:2|max:255',
            'cnpj' => 'required|string|size:18|unique:fornecedores,cnpj',
            'telefone' => 'nullable|string|min:14|max:15',
            'email' => 'nullable|email|max:255',
            'cidade' => 'nullable|string|max:255',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.size' => 'O CNPJ deve estar no formato 00.000.000/0000-00.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'email.email' => 'Informe um email válido.',
        ]);

        Fornecedores::create($request->all());

        return redirect()
            ->route('fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }
}