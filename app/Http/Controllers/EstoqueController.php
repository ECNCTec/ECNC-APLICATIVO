<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{
    public function informacoesDoSistema()
    {
        // Buscar os produtos e fornecedores do usuário autenticado
        $produtos = Produto::where('user_id', Auth::id())->get();
        $fornecedores = Fornecedor::where('user_id', Auth::id())->get();

        // Buscar os estoques com as relações de produto e fornecedor
        $estoques = Estoque::with([
            'produto:id,descricao',
            'fornecedor:id,razao_social'
        ])
            ->where('user_id', Auth::id())
            ->get();

        // // Calcular a quantidade atual para cada estoque
        // foreach ($estoques as $estoque) {
        //     // Calcular a quantidade total com base nas entradas e saídas
        //     $quantAtual = Estoque::where('produto_id', $estoque->produto_id)
        //         ->where('user_id', Auth::id())
        //         ->sum(DB::raw('CASE WHEN operacao = "Entrada" THEN quantidade_pecas ELSE -quantidade_pecas END'));

        //     // Atualiza a propriedade quant_atual
        //     $estoque->quant_atual = $quantAtual;
        // }

        // Retorna a view com os dados de produtos, fornecedores e estoques
        return view('cadastroEstoque', compact('produtos', 'fornecedores', 'estoques'));
    }

    public function create()
    {
        $produtos = Produto::where('user_id', Auth::id())->get();
        $fornecedores = Fornecedor::where('user_id', Auth::id())->get();
        return view('cadastroEstoque', compact('produtos', 'fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'quantidade_pecas' => 'required|integer|min:1',
            'custo' => 'required|numeric|min:0.01',
            'operacao' => 'required|in:Entrada,Saida',
        ]);

        // Buscar o estoque atual do produto
        $estoque = Estoque::where('produto_id', $request->produto_id)
            ->where('fornecedor_id', $request->fornecedor_id)
            ->first();

        // Verificar a operação e ajustar a quantidade
        if ($request->operacao === 'Entrada') {
            // Se for entrada, somar a quantidade ao estoque atual
            $quantidadeAtual = $estoque ? $estoque->quant_atual + $request->quantidade_pecas : $request->quantidade_pecas;
        } elseif ($request->operacao === 'Saida') {
            // Se for saída, subtrair a quantidade do estoque atual, mas verificar se há peças suficientes
            if (!$estoque || $estoque->quant_atual < $request->quantidade_pecas) {
                return redirect()->route('cadastroEstoque')->with('error', 'Quantidade insuficiente no estoque!');
            }
            $quantidadeAtual = $estoque->quant_atual - $request->quantidade_pecas;
        }

        // Atualizar ou criar o registro de estoque
        Estoque::create([
            'produto_id' => $request->produto_id,
            'fornecedor_id' => $request->fornecedor_id,
            'quantidade_pecas' => $request->quantidade_pecas,
            'custo' => $request->custo,
            'user_id' => Auth::id(),
            'operacao' => $request->operacao,
            'quant_atual' => $quantidadeAtual,
        ]);

        return redirect()->route('cadastroEstoque')->with('success', 'Operação de estoque registrada com sucesso!');
    }

    public function edit($id)
    {
        $estoque = Estoque::findOrFail($id);
        $produtos = Produto::where('user_id', Auth::id())->get();
        $fornecedores = Fornecedor::where('user_id', Auth::id())->get();

        return view('cadastroEstoque', compact('estoque', 'produtos', 'fornecedores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'quantidade_pecas' => 'required|integer|min:1',
            'custo' => 'required|numeric|min:0.01',
        ]);

        $estoque = Estoque::findOrFail($id);
        $estoque->update([
            'produto_id' => $request->produto_id,
            'fornecedor_id' => $request->fornecedor_id,
            'quantidade_pecas' => $request->quantidade_pecas,
            'custo' => $request->custo,
        ]);

        return redirect()->route('cadastroEstoque')->with('success', 'Estoque atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();

        return redirect()->route('cadastroEstoque')->with('success', 'Estoque excluído com sucesso!');
    }
}
