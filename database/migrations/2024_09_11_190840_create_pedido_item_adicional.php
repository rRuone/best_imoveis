<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_item_adicional', function (Blueprint $table) {
            // Cria as chaves estrangeiras
            $table->foreignId('pedido_item_id')
                ->constrained('pedido_item')
                ->onDelete('cascade');
                
            $table->foreignId('adicional_id')
                ->constrained('adicionais')
                ->onDelete('cascade');

            // Quantidade de adicionais
            $table->integer('quantidade')->default(1);

            // Preço do adicional
            $table->decimal('preco', 8, 2);

            // Define a chave primária composta
            $table->primary(['pedido_item_id', 'adicional_id']);

            $table->timestamps(); // Campos created_at e updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_item_adicional');
    }
};
