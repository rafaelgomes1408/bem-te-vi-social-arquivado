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
    Schema::table('denuncias', function (Blueprint $table) {
        $table->text('descricao')->nullable()->after('categoria'); // Campo opcional
    });
}

public function down(): void
{
    Schema::table('denuncias', function (Blueprint $table) {
        $table->dropColumn('descricao');
    });
}

};
