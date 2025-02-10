<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoqueTable extends Migration
{
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos');
            $table->foreignId('fornecedor_id')->constrained('fornecedores');
            $table->unsignedInteger('quantidade_pecas');
            $table->decimal('custo', 10, 2);
            $table->string('operacao'); // "entrada" ou "saida"
            $table->unsignedInteger('quant_atual')->default(0); // Quantidade Atual
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estoques');
    }
}
