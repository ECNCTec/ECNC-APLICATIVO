<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\GerarOrcamentoController;

Route::get('/login', [AuthController::class, 'index'])->name('login.form');

Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboardAnaliseDados', function () {
        return view('dashboardAnaliseDados');
    })->name('dashboardAnaliseDados');

    Route::get('/gerarOrcamento', [GerarOrcamentoController::class, 'index'])->name('gerarOrcamento');

    Route::resource('orcamento', GerarOrcamentoController::class);

    Route::get('/cadastroClientes', function () {
        return view('cadastroClientes');
    })->name('cadastroClientes');

    Route::resource('clientes', ClienteController::class);

    Route::get('/cadastroProdutos', function () {
        return view('cadastroProdutos');
    })->name('cadastroProdutos');

    Route::resource('entradaEstoque', EstoqueController::class);

    Route::get('/cadastroEstoque', [EstoqueController::class, 'informacoesDoSistema'])->name('cadastroEstoque');

    Route::delete('/estoque/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');

    Route::match(['get', 'post'], '/cadastroEstoque/{id?}', [EstoqueController::class, 'storeOrUpdate'])->name('cadastroEstoque');
    
    Route::put('/cadastroEstoque/{id}', [EstoqueController::class, 'update'])->name('cadastroEstoque.update');

    Route::get('/estoque', [EstoqueController::class, 'produtosNoEstoque'])->name('estoque');

    Route::get('/cadastroFornecedor', function () {
        return view('cadastroFornecedor');
    })->name('cadastroFornecedor');

    Route::resource('cadastroFornecedores', FornecedorController::class);

    Route::get('/cadastroProdutos', [ProdutosController::class, 'index'])->name('cadastroProdutos');
    Route::resource('produtos', ProdutosController::class)->except(['index']);
});

Route::get('/', function () {
    return view('telaPrincipal');
})->name('telaPrincipal');
