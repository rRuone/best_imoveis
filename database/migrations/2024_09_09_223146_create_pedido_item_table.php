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

            $table->decimal('preco',3,2);
            $table->integer(('quantidade'))->nullable();
            $table->primary(['pedido_id', 'item_cardapio_id']);
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
        Schema::dropIfExists('pedido_item');
    }
};
