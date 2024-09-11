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
            $table->decimal('preco', 10, 2)->change(); // Ajuste a precisão e escala conforme necessário
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
            $table->decimal('preco', 8, 2)->change(); // Reverter a mudança para o estado anterior, se necessário
        });
    }
};
