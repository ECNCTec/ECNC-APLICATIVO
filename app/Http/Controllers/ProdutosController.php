<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $maiorComprimento = $request->input('maiorComprimento');
        $menorComprimento = $request->input('menorComprimento');
        $maiorLargura = $request->input('maiorLargura');
        $menorLargura = $request->input('menorLargura');
        $tipoMedida = $request->input('tipoMedida');

        $produtos = Produto::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('descricao', 'like', '%' . $search . '%')
                    ->orWhere('id', '=', $search);
            });
        })
            ->when($maiorComprimento, function ($query, $maiorComprimento) {
                return $query->where('comprimento', '<=', $maiorComprimento);
            })
            ->when($menorComprimento, function ($query, $menorComprimento) {
                return $query->where('comprimento', '>=', $menorComprimento);
            })
            ->when($maiorLargura, function ($query, $maiorLargura) {
                return $query->where('largura', '<=', $maiorLargura);
            })
            ->when($menorLargura, function ($query, $menorLargura) {
                return $query->where('largura', '>=', $menorLargura);
            })
            ->when($tipoMedida, function ($query, $tipoMedida) {
                return $query->where('tipo_medida', '=', $tipoMedida);
            })
            ->get();

        $quantidadeProdutos = $produtos->count();

        return view('cadastroProdutos', compact('produtos', 'quantidadeProdutos'));
    }

    public function create()
    {
        return view('cadastroProdutos');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricaoProduto' => [
                'required',
                'string',
                'max:255',
                'unique:produtos,descricao',
            ],
            'tipoMedidaProduto' => 'required|in:unidade,peso',
            'comprimentoProduto' => 'required_if:tipoMedidaProduto,unidade|nullable|numeric',
            'larguraProduto' => 'required_if:tipoMedidaProduto,unidade|nullable|numeric',
        ], [
            'descricaoProduto.unique' => 'Já existe um produto com essa descrição. Por favor, escolha outro nome.',
            'comprimentoProduto.required_if' => 'O comprimento do produto é obrigatório quando o tipo de medida for unidade.',
            'larguraProduto.required_if' => 'A largura do produto é obrigatória quando o tipo de medida for unidade.',
        ]);

        if ($validatedData['tipoMedidaProduto'] === 'peso') {
            $validatedData['comprimentoProduto'] = $validatedData['comprimentoProduto'] ?? 0;
            $validatedData['larguraProduto'] = $validatedData['larguraProduto'] ?? 0;
        }

        Produto::create([
            'descricao' => $validatedData['descricaoProduto'],
            'comprimento' => $validatedData['comprimentoProduto'],
            'largura' => $validatedData['larguraProduto'],
            'tipo_medida' => $validatedData['tipoMedidaProduto'],
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
