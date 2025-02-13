<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;

class GerarOrcamentoController extends Controller
{
    public function index()
    {
        $produtosCadastrados = Produto::all();

        return view('gerarOrcamento', compact('produtosCadastrados'));
    }
}
