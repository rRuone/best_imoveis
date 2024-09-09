<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCardapioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_cardapio', function (Blueprint $table) {
            $table->id(); 
            $table->string('nome', 20); 
            $table->decimal('preco', 3, 2); 
            $table->string('categoria'); 
            $table->binary('foto')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_cardapio'); // Remove a tabela caso necessário
    }
}