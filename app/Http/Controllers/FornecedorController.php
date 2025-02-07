<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::where('user_id', Auth::id())->get();
        
        return view('cadastroFornecedor', compact('fornecedores'));
    }

    public function create()
    {
        return view('cadastroFornecedor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpf_cnpj' => 'required|unique:fornecedores',
            'tipo_pessoa' => 'required',
            'inscricao_rg' => 'required',
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'cep' => 'required',
            'endereco' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'status' => 'required',
        ]);

        Fornecedor::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('cadastroFornecedor')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::where('user_id', Auth::id())->findOrFail($id);
        
        return view('cadastroFornecedor', compact('fornecedor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cpf_cnpj' => 'required|unique:fornecedores,cpf_cnpj,' . $id,
            'tipo_pessoa' => 'required',
            'inscricao_rg' => 'required',
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'cep' => 'required',
            'endereco' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'status' => 'required',
        ]);

        $fornecedor = Fornecedor::where('user_id', Auth::id())->findOrFail($id);
        $fornecedor->update($request->all());

        return redirect()->route('cadastroFornecedor')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::where('user_id', Auth::id())->findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('cadastroFornecedor')->with('success', 'Fornecedor excluído com sucesso!');
    }

    public function show($id)
    {
        $fornecedor = Fornecedor::where('user_id', Auth::id())->findOrFail($id);
        
        return view('cadastroFornecedor', compact('fornecedor'));
    }
}
