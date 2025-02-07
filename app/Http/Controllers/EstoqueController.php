<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;

class EstoqueController extends Controller
{
    public function informacoesProduto()
    {
        $produtos = Produto::all();
        return view('cadastroEstoque', compact('produtos'));
    }
}
