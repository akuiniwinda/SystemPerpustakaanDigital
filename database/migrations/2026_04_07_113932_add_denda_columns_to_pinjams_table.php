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
        Schema::table('pinjams', function (Blueprint $table) {
            if (!Schema::hasColumn('pinjams', 'denda_pengajuan')) {
                $table->integer('denda_pengajuan')->default(0)->after('status');
            }
            if (!Schema::hasColumn('pinjams', 'denda')) {
                $table->integer('denda')->default(0)->after('denda_pengajuan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjams', function (Blueprint $table) {
            $table->dropColumn(['denda_pengajuan', 'denda']);
        });
    }
};
