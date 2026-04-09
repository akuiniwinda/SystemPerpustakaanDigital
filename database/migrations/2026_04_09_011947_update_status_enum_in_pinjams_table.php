<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
        {
            DB::statement("ALTER TABLE pinjams MODIFY status ENUM('pengajuan', 'meminjam', 'selesai', 'ditolak') NOT NULL DEFAULT 'pengajuan'");
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pinjams MODIFY status ENUM('pengajuan', 'meminjam', 'selesai') NOT NULL DEFAULT 'pengajuan'");
    }
};
