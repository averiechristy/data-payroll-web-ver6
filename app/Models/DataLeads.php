<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLeads extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'cust_name',
        'kcu',
        'kcp',
        'phone_no',
        'mobile_phone_no',
        'telp_specta',
        'email_kbb_1',
        'email_kbb_2',
        'pic_1',
        'role_pic_1',
        'pic_2',
        'role_pic_2',
        'no_telp_kbb',
        'nama_pic_kbb',
        'tanggal_awal',
        'tanggal_akhir',
        'status',
        'keterangan',
        'jenis_data',
        'tanggal_follow_up',
        'tanggal_terima_form_kbb',
        'tanggal_terima_form_kbb_payroll',
        ];
}
