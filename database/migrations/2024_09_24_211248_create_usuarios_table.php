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
        // Atualização da tabela 'usuarios' para incluir a coluna 'is_admin'
        Schema::create('usuarios', function (Blueprint $table) {
            $table->uuid('idUsuario')->primary(); // Usando UUID como chave primária
            $table->string('nomeUsuario');
            $table->string('email')->unique();
            $table->string('senha');
            $table->uuid('idPerfil')->nullable()->constrained('perfils'); // Chave estrangeira para a tabela 'perfils'
            $table->boolean('is_admin')->default(false); // Define se o usuário é administrador
            $table->rememberToken();
            $table->timestamps();
        });

        // Criação da tabela 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->uuid('idUsuario')->nullable()->index();  // Mantendo 'idUsuario' para referenciar o usuário
            $table->uuid('user_id')->nullable()->index();    // Adicionando 'user_id' para compatibilidade
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Criação da tabela para armazenamento dos tokens de redefinição de password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
    }
};
