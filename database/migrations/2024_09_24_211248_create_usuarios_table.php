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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->uuid('idUsuario')->primary(); // Usando UUID como chave primária
            $table->string('nomeUsuario');
            $table->string('email')->unique();
            $table->string('senha');
            $table->uuid('idPerfil')->nullable()->constrained('perfils'); // Chave estrangeira para a tabela 'perfils'
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
