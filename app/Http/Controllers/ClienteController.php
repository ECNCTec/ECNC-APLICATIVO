<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::where('user_id', Auth::id())->get();

        return view('cadastroClientes', compact('clientes'));
    }

    public function create()
    {
        return view('cadastroClientes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpf_cnpj' => [
                'required',
                'regex:/^\d+$/',
                'unique:clientes,cpf_cnpj,NULL,id,user_id,' . Auth::id(),  
            ],
            'tipo_pessoa' => 'required',
            'inscricao_rg' => 'required',
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'cep' => [
                'required',
                'regex:/^\d{8}$/',
            ],
            'endereco' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'email' => 'required|email',
            'telefone' => [
                'required',
                'regex:/^\d+$/', 
            ],
        ], [
            'cpf_cnpj.unique' => 'Já existe um cliente com esse CPF/CNPJ cadastrado por você.',
            'cep.regex' => 'O campo CEP deve conter apenas números, com 8 dígitos.',
            'telefone.regex' => 'O campo telefone deve conter apenas números.',
        ]);
        
        Cliente::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('cadastroClientes')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $cliente = Cliente::where('user_id', Auth::id())->findOrFail($id);

        return view('cadastroClientes', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cpf_cnpj' => 'required|unique:clientes,cpf_cnpj,' . $id,
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
        ]);

        $cliente = Cliente::where('user_id', Auth::id())->findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('cadastroClientes')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::where('user_id', Auth::id())->findOrFail($id);
        $cliente->delete();

        return redirect()->route('cadastroClientes')->with('success', 'Cliente excluído com sucesso!');
    }

    public function show($id)
    {
        $cliente = Cliente::where('user_id', Auth::id())->findOrFail($id);

        return view('cadastroClientes', compact('cliente'));
    }
}
