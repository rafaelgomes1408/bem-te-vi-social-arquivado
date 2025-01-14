<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIsAdminFromUsuariosTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('usuarios', 'is_admin')) {
            Schema::table('usuarios', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
        });
    }
}
