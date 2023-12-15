<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKCU extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kcu'
    ];

    public function leadsData()
    {
        return $this->hasMany(DataLeads::class, 'id', 'kcu');
    }

}
