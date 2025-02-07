<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Fornecedor;

class EstoqueController extends Controller
{
    public function informacoesDoSistema()
    {
        $produtos = Produto::all();
        $fornecedores = Fornecedor::all();
        return view('cadastroEstoque', compact('produtos', 'fornecedores'));
    }
}
