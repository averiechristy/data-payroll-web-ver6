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
        Schema::create('data_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_data_leads')->unique();
            $table->date('tanggal_follow_up')->nullable();
            $table->string('jenis_data')->nullable();
            $table->enum('status', ['Tidak Terhubung', 'Diskusi Internal', 'Berminat', 'Tidak Berminat', 'No. Telp Tidak Valid', 'Call Again', 'Closing'])->nullable();
            $table->string('kcu')->nullable();
            $table->string('nama_pic_kbb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_logs');
    }
};
