<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_data_leads',
        'jenis_data',
        'status',
        'tanggal_follow_up',
        'nama_pic_kbb',
        'kcu',
        // Add other fields as needed
    ];
}
