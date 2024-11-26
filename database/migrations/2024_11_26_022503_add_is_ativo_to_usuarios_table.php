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
    Schema::table('usuarios', function (Blueprint $table) {
        $table->boolean('is_ativo')->default(true)->after('imagemPerfil'); // Coluna para indicar se o perfil está ativo
    });
}

public function down()
{
    Schema::table('usuarios', function (Blueprint $table) {
        $table->dropColumn('is_ativo');
    });
}

};
