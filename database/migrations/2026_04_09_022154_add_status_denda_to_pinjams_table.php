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
        Schema::table('pinjams', function (Blueprint $table) {
            $table->enum('status_denda', ['belum', 'diajukan', 'lunas'])->default('belum')->after('denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pinjams', function (Blueprint $table) {
            $table->dropColumn('status_denda');
        });
    }
};
