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
        Schema::create('pedido_item', function (Blueprint $table) {
            $table->foreignId('pedido_id')
                ->constrained('pedido')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreignId('item_cardapio_id')
                ->constrained('item_cardapio')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Defina adicional_id como nullable e não parte da chave primária
            $table->foreignId('adicional_id')
                ->nullable() 
                ->constrained('adicionais') 
                ->onDelete('set null') 
                ->onUpdate('cascade');
            
            $table->integer('quantidade');
            $table->decimal('preco', 8, 2);
            
            // Ajuste a chave primária para não incluir adicional_id
            $table->primary(['pedido_id', 'item_cardapio_id', 'quantidade', 'preco']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_item');
    }
};
