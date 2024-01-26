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
        Schema::create('data_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_data_leads')->unique();
            $table->date('tanggal_usage_claim')->nullable();
            $table->date('tanggal_usage_not_claim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_usages');
    }
};
