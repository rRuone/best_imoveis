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
            $table->id(); // ID da tabela pivô

            // Cria a chave estrangeira para a tabela pedido_item
            $table->foreignId('pedido_item_id')
                ->constrained('pedido_item')
                ->onDelete('cascade');

            // Cria a chave estrangeira para a tabela adicional
            $table->foreignId('adicional_id')
                ->constrained('adicionais')
                ->onDelete('cascade');

            // Quantidade de adicionais adicionados
            $table->integer('quantidade')->default(1);

            // Preço do adicional
            $table->decimal('preco', 8, 2);

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
