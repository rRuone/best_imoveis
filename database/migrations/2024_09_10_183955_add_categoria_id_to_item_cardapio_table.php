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
        Schema::table('item_cardapio', function (Blueprint $table) {

            $table->foreignId('categoria_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('categorias')
                    ->onDelete('set null');
            
            $table->dropColumn('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_cardapio', function (Blueprint $table) {
            // Remove a foreign key e o campo 'categoria_id'
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
            
            // Adiciona novamente o campo 'categoria'
            $table->string('categoria');
        });
    
    }
};
