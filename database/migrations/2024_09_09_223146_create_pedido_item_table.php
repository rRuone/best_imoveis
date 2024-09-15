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
            $table->id();  // Cria um campo 'id' como chave primária

            // Relacionamento com a tabela 'pedido'
            $table->foreignId('pedido_id')
                ->constrained('pedido')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            // Relacionamento com a tabela 'item_cardapio'
            $table->foreignId('item_cardapio_id')
                ->constrained('item_cardapio')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Relacionamento opcional com a tabela 'adicionais'
            $table->foreignId('adicional_id')
                ->nullable() 
                ->constrained('adicionais') 
                ->onDelete('set null') 
                ->onUpdate('cascade');
            
            // Outros campos
            $table->integer('quantidade');
            $table->decimal('preco', 8, 2);
            
            // Criação dos timestamps
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
