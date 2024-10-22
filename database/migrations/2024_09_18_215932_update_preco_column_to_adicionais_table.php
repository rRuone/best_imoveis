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
        Schema::table('adicionais', function (Blueprint $table) {
            // Definir a coluna 'preco' nula
            $table->decimal('preco', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adicionais', function (Blueprint $table) {
            // Reverter a coluna 'preco' 
            $table->decimal('preco', 8, 2)->nullable(false)->change();
        });
    }
};
