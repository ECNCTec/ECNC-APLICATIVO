<?php

namespace App\Services;

use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Estoque;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EstoqueService
{
    public function obterProdutosDoUsuario()
    {
        return Produto::where('user_id', Auth::id())->get();
    }

    public function obterFornecedoresDoUsuario()
    {
        return Fornecedor::where('user_id', Auth::id())->get();
    }

    public function contarItensNoEstoque()
    {
        return Estoque::where('user_id', Auth::id())
            ->distinct('produto_id')
            ->count('produto_id');
    }

    public function obterDataUltimaAtualizacao()
    {
        return DB::table('estoques')
            ->select('produto_id', DB::raw('MAX(updated_at) AS ultima_atualizacao'))
            ->where('user_id', Auth::id())
            ->groupBy('produto_id')
            ->get();
    }

    public function aplicarFiltroPesquisa($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('produto', function ($q) use ($search) {
                    $q->where('descricao', 'like', '%' . $search . '%');
                })
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('produto_id', 'like', '%' . $search . '%');
            });
        });
    }

    public function calcularSomaEstoque($search)
    {
        $userId = Auth::id();
        $dataUltimaAtualizacao = $this->obterDataUltimaAtualizacao();

        $estoques = Estoque::with(['produto:id,descricao'])
            ->selectRaw("
                produto_id, 
                SUM(CASE WHEN operacao = 'Entrada' THEN quantidade_pecas ELSE -quantidade_pecas END) AS total_quantidade, 
                SUM(CASE WHEN operacao = 'Entrada' THEN quantidade_pecas * custo ELSE -quantidade_pecas * custo END) AS total_custo
            ")
            ->where('user_id', $userId)
            ->groupBy('produto_id');

        $estoques = $this->aplicarFiltroPesquisa($estoques, $search)->get();

        return $estoques->map(function ($estoque) use ($dataUltimaAtualizacao) {
            $data = $dataUltimaAtualizacao->firstWhere('produto_id', $estoque->produto_id);
            $estoque->dataUltimaAtualizacao = $data ? Carbon::parse($data->ultima_atualizacao) : null;
            return $estoque;
        });
    }

    public function obterOperacoes()
    {
        return Estoque::select('operacao')->distinct()->get();
    }

    public function obterProdutosNoEstoque()
    {
        return Produto::selectRaw('MIN(id) as id, descricao')
            ->groupBy('descricao')
            ->orderBy('id', 'asc')
            ->get();
    }

    public function obterFornecedores()
    {
        return Estoque::with([
            'produto:id,descricao',
            'fornecedor:id,razao_social'
        ]);
    }

    public function contarProdutosNoEstoque($filtros)
    {
        $userId = Auth::id();

        return Estoque::where('user_id', $userId)
            ->when($filtros['search'] ?? null, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('produto', function ($q) use ($search) {
                        $q->where('descricao', 'like', '%' . $search . '%');
                    })->orWhere('id', '=', $search);
                });
            })
            ->when($filtros['quantidadeMaximaPecas'] ?? null, function ($query, $quantidadeMaximaPecas) {
                return $query->where('quantidade_pecas', '<=', $quantidadeMaximaPecas);
            })
            ->when($filtros['quantidadeMinimaPecas'] ?? null, function ($query, $quantidadeMinimaPecas) {
                return $query->where('quantidade_pecas', '>=', $quantidadeMinimaPecas);
            })
            ->when($filtros['dataInicial'] ?? null, function ($query, $dataInicial) {
                return $query->where('created_at', '>=', $dataInicial);
            })
            ->when($filtros['dataFinal'] ?? null, function ($query, $dataFinal) {
                return $query->where('created_at', '<=', $dataFinal);
            })
            ->when($filtros['operacao'] ?? null, function ($query, $operacao) {
                return $query->where('operacao', '=', $operacao);
            })
            ->count('produto_id');
    }

    public function obterRegistrosEstoque($filtros)
    {
        $userId = Auth::id();

        return Estoque::where('user_id', $userId)
            ->when($filtros['search'] ?? null, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('produto', function ($q) use ($search) {
                        $q->where('descricao', 'like', '%' . $search . '%');
                    })->orWhere('id', '=', $search);
                });
            })
            ->when($filtros['quantidadeMaximaPecas'] ?? null, function ($query, $quantidadeMaximaPecas) {
                return $query->where('quantidade_pecas', '<=', $quantidadeMaximaPecas);
            })
            ->when($filtros['quantidadeMinimaPecas'] ?? null, function ($query, $quantidadeMinimaPecas) {
                return $query->where('quantidade_pecas', '>=', $quantidadeMinimaPecas);
            })
            ->when($filtros['dataInicial'] ?? null, function ($query, $dataInicial) {
                return $query->where('created_at', '>=', $dataInicial);
            })
            ->when($filtros['dataFinal'] ?? null, function ($query, $dataFinal) {
                return $query->where('created_at', '<=', $dataFinal);
            })
            ->when($filtros['operacao'] ?? null, function ($query, $operacao) {
                return $query->where('operacao', '=', $operacao);
            })
            ->get();
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

        $custo = (float) str_replace(['.', ','], ['', '.'], $request->custo);

        Estoque::create([
            'produto_id' => $request->produto_id,
            'fornecedor_id' => $request->fornecedor_id,
            'quantidade_pecas' => $request->quantidade_pecas,
            'custo' => $custo,
            'user_id' => Auth::id(),
            'operacao' => $request->operacao,
        ]);
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
        $custo = (float) str_replace(['.', ','], ['', '.'], $request->custo);

        $estoque->update([
            'quantidade_pecas' => $request->quantidade_pecas,
            'custo' => $custo,
        ]);
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $custo = (float) str_replace(['.', ','], ['', '.'], $request->input('custo'));

        if (!is_numeric($custo)) {
            return redirect()->back()->with('error', 'Custo inválido.');
        }

        Estoque::updateOrCreate(
            ['id' => $request->estoque_id ?? $id],
            [
                'produto_id' => $request->produto_id,
                'fornecedor_id' => $request->fornecedor_id,
                'quantidade_pecas' => $request->quantidade_pecas,
                'custo' => $custo,
                'operacao' => $request->operacao,
                'user_id' => Auth::id(),
            ]
        );
    }

    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();
    }
}
