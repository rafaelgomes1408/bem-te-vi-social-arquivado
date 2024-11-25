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
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->uuid('idPostagem'); // Relacionamento com postagens
            $table->uuid('idUsuario'); // Relacionamento com usuários
            $table->string('categoria'); // Categoria da denúncia
            $table->timestamps();

            // Definindo chaves estrangeiras
            $table->foreign('idPostagem')->references('idPostagem')->on('postagens')->onDelete('cascade');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
