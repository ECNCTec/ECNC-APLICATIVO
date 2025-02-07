<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained(); 
            $table->id();
            $table->string('descricao');
            $table->integer('comprimento');
            $table->integer('largura');
            $table->enum('tipo_medida', ['unidade', 'peso']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
