<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedorController;

Route::get('/login', [AuthController::class, 'index'])->name('login.form');

Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/gerarOrcamento', function () {
        return view('gerarOrcamento');
    })->name('gerarOrcamento');

    Route::get('/cadastroClientes', function () {
        return view('cadastroClientes');
    })->name('cadastroClientes');

    Route::resource('clientes', ClienteController::class);

    Route::get('/cadastroProdutos', function () {
        return view('cadastroProdutos');
    })->name('cadastroProdutos');

    Route::resource('entradaEstoque', EstoqueController::class);

    // Correção da rota para permitir o parâmetro 'id' opcional
    Route::match(['get', 'post'], '/cadastroEstoque/{id?}', [EstoqueController::class, 'storeOrUpdate'])->name('cadastroEstoque');

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
