<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\DataLeads;

class DataLeadsImport implements ToModel, WithHeadingRow
{

    private $tanggal_awal;
    private $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function model(array $row)
    {

        
        
        $existingData = DataLeads::where('cust_name', $row['cust_name'])->first();

        
    // Jika cust_name sudah ada, tidak menyimpan data baru
    if ($existingData) {
        throw new \Exception(" Data dengan nama '{$row['cust_name']}' sudah ada."); 
    }

                // Mendapatkan nomor terakhir
                $lastNo = DataLeads::max('no');

                // Menambahkan 1 ke nomor terakhir
                $newNo = $lastNo + 1;
        
        
        return new DataLeads([
            'no' => $newNo,
            'cust_name' => $row['cust_name'],
            'kcu_kcp' => $row['kcukcp'],
            'phone_no' => $row['phone_no'],
            'mobile_phone_no' => $row['mobile_phone_no'],
            'telp_specta' => $row['telp_specta'],
            'email_kbb_1' => $row['email_kbb_1'],
            'email_kbb_2' => $row['email_kbb_2'],
            'pic_1' => $row['pic_1'],
            'role_pic_1' => $row['role_pic_1'],
            'pic_2' => $row['pic_2'],
            'role_pic_2' => $row['role_pic_2'],
            'no_telp_kbb' => $row['no_telp_kbb'],
            'nama_pic_kbb' => $row['pic_kbb'],
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
        ]);
    }
}
