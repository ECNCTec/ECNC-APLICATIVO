<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->id();
            $table->string('cpf_cnpj');
            $table->enum('tipo_pessoa', ['fisica', 'juridica']);
            $table->enum('sexo', ['masculino', 'feminino'])->nullable();
            $table->string('inscricao_rg');
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cep');
            $table->string('endereco');
            $table->string('complemento');
            $table->string('bairro');
            $table->string('estado');
            $table->string('cidade');
            $table->string('email');
            $table->string('telefone');
            $table->enum('status', ['ativo', 'inativo']);
            $table->string('inscricao_municipal')->nullable();
            $table->string('regime_tributario')->nullable();
            $table->string('contribuinte_icms')->nullable();
            $table->string('operacao_consumidor_final')->nullable();
            $table->timestamps();

            $table->unique(['cpf_cnpj', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
};
