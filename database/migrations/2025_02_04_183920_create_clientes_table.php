<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cpf_cnpj', 20)->unique();
            $table->enum('tipo_pessoa', ['fisica', 'juridica']);
            $table->enum('sexo', ['masculino', 'feminino'])->nullable();
            $table->string('inscricao_rg', 30);
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cep', 10);
            $table->string('endereco');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('estado', 2);
            $table->string('cidade');
            $table->string('email')->unique();
            $table->string('telefone', 20);
            $table->string('inscricao_municipal')->nullable();
            $table->string('regime_tributario')->nullable();
            $table->string('contribuinte_icms')->nullable();
            $table->string('operacao_consumidor_final')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
