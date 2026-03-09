<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'cpf' => 'required|string|size:14|unique:clientes,cpf',
            'email' => 'required|email|max:255|unique:clientes,email',
            'telefone' => 'required|string|min:14|max:15',
            'endereco' => 'nullable|string|max:255',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve estar no formato 000.000.000-00.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.unique' => 'Este email já está cadastrado.',

            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.min' => 'O telefone está incompleto.',
            'telefone.max' => 'O telefone está inválido.',

            'endereco.max' => 'O endereço pode ter no máximo 255 caracteres.',
        ]);

        Clientes::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'reserva' => 0,
        ]);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }
}