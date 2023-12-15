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
        Schema::table('data_leads', function (Blueprint $table) {
            $table->enum('status', ['Tidak Terhubung', 'Diskusi Internal', 'Berminat', 'Tidak Berminat', 'No. Telp Tidak Valid', 'Call Again', 'Closing', 'Belum Ada'])->after('tanggal_akhir')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_leads', function (Blueprint $table) {
            //
        });
    }
};
