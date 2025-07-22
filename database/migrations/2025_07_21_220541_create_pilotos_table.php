<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pilotos', function (Blueprint $table) {
            $table->id();  // Cria a coluna id
            $table->string('nome');  // Nome do piloto
            $table->string('nacionalidade');  // Nacionalidade
            $table->date('data_nascimento');  // Data de nascimento
            $table->string('foto')->nullable();  // Foto do piloto (opcional)
            $table->timestamps();  // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilotos');
    }
};
