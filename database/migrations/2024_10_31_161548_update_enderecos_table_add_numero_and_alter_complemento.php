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
        Schema::table('enderecos', function (Blueprint $table) {
            $table->string('numero')->nullable(); // Adiciona o campo 'numero' que pode ser nulo
            $table->string('complemento')->nullable()->change(); // Altera o campo 'complemento' para opcional
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropColumn('numero');
            $table->string('complemento')->nullable(false)->change(); // Reverte o campo 'complemento' para obrigatório
        });
    }
};
