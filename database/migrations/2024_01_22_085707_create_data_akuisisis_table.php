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
        Schema::create('data_akuisisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_data_leads')->unique();
            $table->enum('status_akuisisi_baru', ['Reaktivasi', 'Migrasi Limit', 'Akuisisi','Waiting confirmation from BCA' ])->nullable();
            $table->date('tanggal_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_akuisisis');
    }
};
