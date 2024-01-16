<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\DataLeads;

class DataLeadsImport implements ToCollection, WithHeadingRow
{

    private $tanggal_awal;
    private $tanggal_akhir;

    private $kcu;

    private $importedData = [];
    
    public function __construct($tanggal_awal, $tanggal_akhir, $kcu)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->kcu = $kcu;
      
    }


    public function collection(Collection $rows)
    {
        set_time_limit(120);
        foreach ($rows as $row) {

            if (empty(array_filter($row->toArray()))) {
                // Baris kosong, skip pemrosesan
                continue;
            }
      
        // $existingData = DataLeads::where('cust_name', $row['cust_name'])->first();

        
        // // Jika cust_name sudah ada, tidak menyimpan data baru
        //  $existingDataByName = DataLeads::where('cust_name', $row['cust_name'])->first();
    
        // // Pengecekan berdasarkan nomor telepon
        // $existingDataByPhone = DataLeads::where('phone_no', $row['phone_no'])->first();
    
        // // Jika ada data dengan nama yang sama
        // if ($existingDataByName) {
        //     // Jika phone_no juga sama, throw exception
        //     if ($existingDataByName->phone_no == $row['phone_no']) {
        //         throw new \Exception(" Data dengan nama '{$row['cust_name']}' dan nomor telepon '{$row['phone_no']}' sudah ada.");
        //     }
        // }

        $existingData = DataLeads::where('cust_name', $row['cust_name'])
        ->where('kcu', $this->kcu)
        ->where('tanggal_awal', $this->tanggal_awal)
        ->where('tanggal_akhir', $this->tanggal_akhir)
        ->first();

        

        
        // Jika cust_name sudah ada, tidak menyimpan data baru
        if ($existingData) {
            if ($existingData->phone_no == $row['phone_no']) {
                        throw new \Exception(" Data dengan nama '{$row['cust_name']}' dan nomor telepon '{$row['phone_no']}' sudah ada.");
                    }
        }

                // Mendapatkan nomor terakhir
                $lastNo = DataLeads::max('no');

                // Menambahkan 1 ke nomor terakhir
                $newNo = $lastNo + 1;
        
                DataLeads::create([
            'no' => $newNo,
            'cust_name' => $row['cust_name'],
            'kcp' => $row['kcukcp'],
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
            'kcu' => $this->kcu,
            'jenis_data' => 'Data Leads',
            'status' => 'Belum Dikerjakan',
            'data_tanggal' => $this->tanggal_akhir,
            
            
        ]);
    }
    $nonEmptyRows = $rows->filter(function ($row) {
        return !empty(array_filter($row->toArray()));
    });

    // Jika ada data yang tidak kosong, simpan ke $this->importedData
    if (!$nonEmptyRows->isEmpty()) {
        $this->importedData = $nonEmptyRows->all();
    }
    $importedDataNames = collect($this->importedData)->pluck('cust_name')->toArray();

    $duplicateNames = array_unique(array_diff_assoc($importedDataNames, array_unique($importedDataNames)));

if (!empty($duplicateNames)) {
    // Ada nama yang sama, beri pesan kesalahan
    $errorMessage = 'Dalam File Nama berikut memiliki duplikat: ' . implode(', ', $duplicateNames);
    throw new \Exception($errorMessage);

}


}
}
