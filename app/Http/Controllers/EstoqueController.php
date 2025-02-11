<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstoqueController extends Controller
{
    public function informacoesDoSistema()
    {
        $produtos = Produto::where('user_id', Auth::id())->get();
        $fornecedores = Fornecedor::where('user_id', Auth::id())->get();

        $informacoesEstoque = Estoque::all();

        $contagemEstoque = Estoque::where('user_id', Auth::id())
            ->distinct('produto_id')
            ->count('produto_id');

        $dataUltimaAtualizacao = DB::table('estoques')
            ->select('produto_id', DB::raw('MAX(updated_at) AS ultima_atualizacao'))
            ->where('user_id', Auth::id())
            ->groupBy('produto_id')
            ->get();

        $somaEstoque = Estoque::with([
            'produto:id,descricao',
            'fornecedor:id,razao_social'
        ])
            ->selectRaw('produto_id, sum(quantidade_pecas) as total_quantidade, sum(quantidade_pecas * custo) as total_custo')
            ->groupBy('produto_id')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($estoque) use ($dataUltimaAtualizacao) {
                $data = $dataUltimaAtualizacao->firstWhere('produto_id', $estoque->produto_id);
                $estoque->dataUltimaAtualizacao = $data ? Carbon::parse($data->ultima_atualizacao) : null;
                return $estoque;
            });

        return view('cadastroEstoque', compact('produtos', 'fornecedores', 'contagemEstoque', 'informacoesEstoque', 'somaEstoque', 'dataUltimaAtualizacao'));
    }

    public function produtosNoEstoque()
    {
        $contagemEstoque = Estoque::where('user_id', Auth::id())
            ->distinct('produto_id')
            ->count('produto_id');

        return view('estoque', compact('contagemEstoque'));
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

        $estoque = Estoque::where('produto_id', $request->produto_id)
            ->where('fornecedor_id', $request->fornecedor_id)
            ->first();

        Estoque::create([
            'produto_id' => $request->produto_id,
            'fornecedor_id' => $request->fornecedor_id,
            'quantidade_pecas' => $request->quantidade_pecas,
            'custo' => $request->custo,
            'user_id' => Auth::id(),
            'operacao' => $request->operacao,
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
        $estoque = Estoque::findOrFail($id);
        $estoque->update($request->all());

        return redirect()->route('entradaEstoque.index')->with('success', 'Estoque atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();

        return redirect()->route('cadastroEstoque')->with('success', 'Estoque excluído com sucesso!');
    }
}
