<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{
    public function informacoesDoSistema()
    {
        $produtos = Produto::where('user_id', Auth::id())->get();
        $fornecedores = Fornecedor::where('user_id', Auth::id())->get();
        
        return view('cadastroEstoque', compact('produtos', 'fornecedores'));
    }
}
