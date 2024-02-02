<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_data_leads',
        'tanggal_usage_claim',
        'tanggal_usage_not_claim',
        'kcu',
        'nama_perusahaan'

    ];

    public function dataleads()
    {

        return $this->belongsTo(DataLeads::class);
    }
}
