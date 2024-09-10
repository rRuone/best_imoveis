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
        Schema::create('adicionais_item_pedido', function (Blueprint $table) {
            $table->foreignId('adicional_id')
                ->constrained('adicionais')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('item_cardapio_id')
                ->constrained('item_cardapio')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->decimal('preco',3,2);
            $table->integer(('quantidade'))->nullable();

            $table->primary(['adicional_id', 'item_cardapio_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adicionais_item_pedido');
    }
};
