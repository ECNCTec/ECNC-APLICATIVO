<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::paginate(10);
        return view('cadastroProdutos', compact('produtos'));
    }

    public function create()
    {
        return view('cadastroProdutos');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricaoProduto' => 'required|string|max:255',
            'comprimentoProduto' => 'required|numeric',
            'larguraProduto' => 'required|numeric',
            'tipoMedidaProduto' => 'required|in:unidade,peso',
        ]);

        Produto::create([
            'descricao' => $request->descricaoProduto,
            'comprimento' => $request->comprimentoProduto,
            'largura' => $request->larguraProduto,
            'tipo_medida' => $request->tipoMedidaProduto,
        ]);

        return redirect()->route('cadastroProdutos')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return view('cadastroProdutos', compact('produto'));
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('cadastroProdutos', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descricaoProduto' => 'required|string|max:255',
            'comprimentoProduto' => 'required|numeric',
            'larguraProduto' => 'required|numeric',
            'tipoMedidaProduto' => 'required|in:unidade,peso',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->update([
            'descricao' => $request->descricaoProduto,
            'comprimento' => $request->comprimentoProduto,
            'largura' => $request->larguraProduto,
            'tipo_medida' => $request->tipoMedidaProduto,
        ]);

        return redirect()->route('cadastroProdutos')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('cadastroProdutos')->with('success', 'Produto excluído com sucesso!');
    }
}
