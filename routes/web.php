<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

    Route::get('/cadastroProdutos', function () {
        return view('cadastroProdutos');
    })->name('cadastroProdutos');

    Route::get('/cadastroEstoque', function () {
        return view('cadastroEstoque');
    })->name('cadastroEstoque');
});

Route::get('/', function () {
    return view('telaPrincipal');
})->name('telaPrincipal');
