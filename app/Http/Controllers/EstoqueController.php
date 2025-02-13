<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\EstoqueService;

class EstoqueController extends Controller
{
    protected $estoqueService;

    public function __construct(EstoqueService $estoqueService)
    {
        $this->estoqueService = $estoqueService;
    }

    public function informacoesDoSistema(Request $request)
    {
        $search = $request->input('search');

        $produtos = $this->estoqueService->obterProdutosDoUsuario();
        $fornecedores = $this->estoqueService->obterFornecedoresDoUsuario();
        $contagemEstoque = $this->estoqueService->contarItensNoEstoque();
        $somaEstoque = $this->estoqueService->calcularSomaEstoque($search);
        $dataUltimaAtualizacao = $this->estoqueService->obterDataUltimaAtualizacao();

        return view('cadastroEstoque', compact('produtos', 'fornecedores', 'contagemEstoque', 'somaEstoque', 'dataUltimaAtualizacao'));
    }

    public function produtosNoEstoque(Request $request)
    {
        $filtros = $request->only([
            'search', 'quantidadeMaximaPecas', 'quantidadeMinimaPecas',
            'dataInicial', 'dataFinal', 'operacao'
        ]);

        $registrosEstoque = $this->estoqueService->obterRegistrosEstoque($filtros);
        $produtoEstoque = $this->estoqueService->obterProdutosNoEstoque();
        $operacao = $this->estoqueService->obterOperacoes();
        $contagemEstoque = $this->estoqueService->contarProdutosNoEstoque($filtros);
        $fornecedores = $this->estoqueService->obterFornecedores();

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
        $this->estoqueService->store($request);
        return redirect()->route('cadastroEstoque')->with('success', 'Operação de estoque registrada com sucesso!');
    }

    public function edit($id)
    {
        return $this->estoqueService->edit($id);
    }

    public function update(Request $request, $id)
    {
        $this->estoqueService->update($request, $id);
        return redirect()->route('entradaEstoque.index')->with('success', 'Estoque atualizado com sucesso!');
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $this->estoqueService->storeOrUpdate($request, $id);
        return redirect()->route('estoque')->with('success', 'Operação de estoque registrada/atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $this->estoqueService->destroy($id);
        return redirect()->route('estoque')->with('success', 'Estoque excluído com sucesso!');
    }
}
