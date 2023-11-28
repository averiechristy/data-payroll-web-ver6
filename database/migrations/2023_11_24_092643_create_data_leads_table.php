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
        Schema::create('data_leads', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->string('cust_name')->nullable();
            $table->string('kcu_kcp')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('mobile_phone_no')->nullable();
            $table->string('telp_specta')->nullable();
            $table->string('email_kbb_1')->nullable();
            $table->string('email_kbb_2')->nullable();
            $table->string('pic_1')->nullable();
            $table->string('role_pic_1')->nullable();
            $table->string('pic_2')->nullable();
            $table->string('role_pic_2')->nullable();
            $table->string('no_telp_kbb')->nullable();
            $table->string('nama_pic_kbb')->nullable();
            $table->date('tanggal_awal')->nullable();
            $table->date('tanggal)akhir')->nullable();
            $table->enum('status', ['Tidak Terhubung', 'Diskusi Internal', 'Berminat', 'Tidak Berminat', 'No. Telp Tidak Valid', 'Call Again', 'Closing'])->nullable();
            $table->string('keterangan')->nullable();
            $table->string('jenis_data')->nullable();
            $table->date('tanggal_follow_up')->nullable();
            $table->date('tanggal_terima_form_kbb')->nullable();
            $table->date('tanggal_terima_form_kbb_payroll')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_leads');
    }
};
