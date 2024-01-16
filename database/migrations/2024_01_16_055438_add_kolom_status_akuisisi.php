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
        Schema::table('data_logs', function (Blueprint $table) {
            $table->enum('status_akuisisi', ['Reaktivasi', 'Migrasi Limit', 'Akuisisi', 'Not Ok','Waiting confirmation from BCA' ])->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_logs', function (Blueprint $table) {
            //
        });
    }
};
