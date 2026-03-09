<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clientesController extends Controller
{
    public function index(){
        $clientes=\App\Models\clientes::all();
        return view('clientes.index', compact('clientes'));
    }
}
