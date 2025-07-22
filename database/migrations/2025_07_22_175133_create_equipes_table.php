<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('equipes', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Nome da equipe
        $table->text('descricao')->nullable(); // Descrição da equipe
        $table->timestamps(); // Data de criação e atualização
         $table->string('foto')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};
