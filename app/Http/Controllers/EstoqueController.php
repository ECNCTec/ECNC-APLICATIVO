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
    public function informacoesDoSistema(Request $request)
    {
        $search = $request->input('search');
        $userId = Auth::id();

        $produtos = Produto::where('user_id', Auth::id())->get();
        $fornecedores = Fornecedor::where('user_id', Auth::id())->get();

        $contagemEstoque = Estoque::where('user_id', $userId)
            ->distinct('produto_id')
            ->count('produto_id');

        $dataUltimaAtualizacao = DB::table('estoques')
            ->select('produto_id', DB::raw('MAX(updated_at) AS ultima_atualizacao'))
            ->where('user_id', $userId)
            ->groupBy('produto_id')
            ->get();

        $somaEstoque = Estoque::with([
            'produto:id,descricao'
        ])
            ->selectRaw("
                    produto_id, 
                    SUM(CASE WHEN operacao = 'Entrada' THEN quantidade_pecas ELSE -quantidade_pecas END) AS total_quantidade, 
                    SUM(CASE WHEN operacao = 'Entrada' THEN quantidade_pecas * custo ELSE -quantidade_pecas * custo END) AS total_custo
                ")
            ->groupBy('produto_id')
            ->where('user_id', $userId)
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereHas('produto', function ($q) use ($search) {
                        $q->where('descricao', 'like', '%' . $search . '%');
                    })
                        ->orWhere('id', 'like', '%' . $search . '%')
                        ->orWhere('produto_id', 'like', '%' . $search . '%');
                });
            })
            ->get()
            ->map(function ($estoque) use ($dataUltimaAtualizacao) {
                $data = $dataUltimaAtualizacao->firstWhere('produto_id', $estoque->produto_id);
                $estoque->dataUltimaAtualizacao = $data ? Carbon::parse($data->ultima_atualizacao) : null;
                return $estoque;
            });

        return view('cadastroEstoque', compact('produtos', 'fornecedores', 'contagemEstoque', 'somaEstoque', 'dataUltimaAtualizacao'));
    }

    public function produtosNoEstoque(Request $request)
    {
        $search = $request->input('search');
        $quantidadeMaximaPecas = $request->input('quantidadeMaximaPecas');
        $quantidadeMinimaPecas = $request->input('quantidadeMinimaPecas');
        $dataInicial = $request->input('dataInicial');
        $dataFinal = $request->input('dataFinal');
        $operacao = $request->input('operacao');

        $userId = auth()->id();

        $registrosEstoque = Estoque::where('user_id', $userId)
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('produto', function ($q) use ($search) {
                        $q->where('descricao', 'like', '%' . $search . '%');
                    })
                        ->orWhere('id', '=', $search);
                });
            })
            ->when($quantidadeMaximaPecas, function ($query, $quantidadeMaximaPecas) {
                return $query->where('quantidade_pecas', '<=', $quantidadeMaximaPecas);
            })
            ->when($quantidadeMinimaPecas, function ($query, $quantidadeMinimaPecas) {
                return $query->where('quantidade_pecas', '>=', $quantidadeMinimaPecas);
            })
            ->when($dataInicial, function ($query, $dataInicial) {
                return $query->where('created_at', '>=', $dataInicial);
            })
            ->when($dataFinal, function ($query, $dataFinal) {
                return $query->where('created_at', '<=', $dataFinal);
            })
            ->when($operacao, function ($query, $operacao) {
                return $query->where('operacao', '=', $operacao);
            })
            ->get();

        $produtoEstoque = Produto::selectRaw('MIN(id) as id, descricao')
            ->groupBy('descricao')
            ->orderBy('id', 'asc')
            ->get();

        $operacao = Estoque::select('operacao')->distinct()->get();

        $contagemEstoque = Estoque::where('user_id', Auth::id())
            ->count('produto_id');

        $fornecedores = Estoque::with([
            'produto:id,descricao',
            'fornecedor:id,razao_social'
        ]);

        return view('estoque', compact('produtoEstoque', 'registrosEstoque', 'operacao', 'contagemEstoque', 'fornecedores'));
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

        $custo = str_replace(['.', ','], ['', '.'], $request->custo);

        $custo = (float) $custo;

        Estoque::create([
            'produto_id' => $request->produto_id,
            'fornecedor_id' => $request->fornecedor_id,
            'quantidade_pecas' => $request->quantidade_pecas,
            'custo' => $custo,
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
        $request->validate([
            'quantidade_pecas' => 'required|integer|min:1',
            'custo' => 'required|numeric|min:0.01',
        ]);

        $estoque = Estoque::findOrFail($id);

        $custo = str_replace(['.', ','], ['', '.'], $request->custo);
        $custo = (float) $custo;

        $estoque->update([
            'quantidade_pecas' => $request->quantidade_pecas,
            'custo' => $custo,
        ]);

        return redirect()->route('entradaEstoque.index')->with('success', 'Estoque atualizado com sucesso!');
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $custo = str_replace(',', '.', str_replace('.', '', $request->input('custo')));

        if (!is_numeric($custo)) {
            return redirect()->back()->with('error', 'Custo inválido.');
        }

        $custoFloat = (float) $custo;

        $estoque = Estoque::updateOrCreate(
            ['id' => $request->estoque_id ?? $id],
            [
                'produto_id' => $request->produto_id,
                'fornecedor_id' => $request->fornecedor_id,
                'quantidade_pecas' => $request->quantidade_pecas,
                'custo' => $custoFloat,
                'operacao' => $request->operacao,
                'user_id' => Auth::id(),
            ]
        );

        return redirect()->route('estoque')->with('success', 'Operação de estoque registrada/atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();

        return redirect()->route('estoque')->with('success', 'Estoque excluído com sucesso!');
    }
}
