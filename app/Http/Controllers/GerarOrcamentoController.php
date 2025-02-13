<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class GerarOrcamentoController extends Controller
{
    public function index()
    {
        $produtosCadastrados = Produto::all();

        return view('gerarOrcamento', compact('produtosCadastrados'));
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $produtosCadastrados = Produto::all();

        return view('gestaoOrcamento', compact('dados', 'produtosCadastrados'));
    }
}
