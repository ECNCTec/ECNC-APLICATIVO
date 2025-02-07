<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all(); 
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

        Fornecedor::create($request->all());

        return redirect()->route('cadastroFornecedor')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::findOrFail($id); 
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

        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($request->all());

        return redirect()->route('cadastroFornecedor')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('cadastroFornecedor')->with('success', 'Fornecedor excluído com sucesso!');
    }

    public function show($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('cadastroFornecedor', compact('fornecedor'));
    }
}
