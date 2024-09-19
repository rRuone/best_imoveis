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
        Schema::table('pedidos', function (Blueprint $table) {
            // Altera o enum para incluir 'finalizado'
            $table->enum('status', ['pendente', 'em_processo', 'concluido', 'cancelado', 'finalizado'])->default('pendente')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Reverte para o enum original sem 'finalizado'
            $table->enum('status', ['pendente', 'em_processo', 'concluido', 'cancelado'])->default('pendente')->change();
        });
    }
};
