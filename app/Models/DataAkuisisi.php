<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAkuisisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_data_leads',
        'tanggal_status',
        'status_akuisisi_baru',
        'kcu',
        'tanggal_usage_claim',
        'jenis_data',
        'nama_perusahaan'

    ];

    public function dataleads()
    {

        return $this->belongsTo(DataLeads::class, 'id_data_leads', 'id_data_leads');
    
    }

    public function datalead()
    {

        return $this->belongsTo(DataLeads::class);
    }
}
