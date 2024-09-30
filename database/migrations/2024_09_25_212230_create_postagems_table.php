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
        Schema::create('postagens', function (Blueprint $table) {
            $table->uuid('idPostagem')->primary(); // Usando UUID como chave primária
            $table->text('conteudo');
            $table->dateTime('dataHora');
            $table->boolean('isOfensiva')->default(false);
            $table->uuid('idUsuario')->nullable()->constrained('usuarios'); // Relacionamento com a tabela Usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postagems');
    }
};
