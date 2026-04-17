<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pinjams', function (Blueprint $table) {
            $table->enum('kondisi_buku', ['baik', 'rusak', 'hilang'])->nullable()->after('denda');
        });
    }

    public function down()
    {
        Schema::table('pinjams', function (Blueprint $table) {
            $table->dropColumn('kondisi_buku');
        });
    }
};
