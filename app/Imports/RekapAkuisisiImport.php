<?php

namespace App\Imports;

use App\Models\DataLeads;
use App\Models\DataLog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RekapAkuisisiImport implements ToCollection, WithHeadingRow
{
    protected $currentRow = 0;

    protected $kcu;


    private $tanggal_awal_akuisisi;
    private $tanggal_akhir_akuisisi;
    

    public function headingRow(): int
    {
        return 2; // Set the heading row to 3
    }

    public function __construct($kcu, $tanggal_awal_akuisisi, $tanggal_akhir_akuisisi)
    {
        $this->kcu = $kcu;
        $this->tanggal_awal_akuisisi = $tanggal_awal_akuisisi;
        $this->tanggal_akhir_akuisisi = $tanggal_akhir_akuisisi;
    }
    public function collection(Collection $rows)
    {

        set_time_limit(120);
        // Increment the row counter
        $this->currentRow++;
   

        // Process only the third row
        // Your existing logic for processing the row goes here
        foreach ($rows as $row) { 

            // Check if the customer name exists in the data_leads table
            $existingLeads = DataLeads::where('cust_name', $row['nama_perusahaan'])
            ->where('kcu', $this->kcu)
            ->get();


            foreach ($existingLeads as $existingLead) {
          
              
               
                $jenis_data = $existingLead -> jenis_data;
               
                
                    $lastNo = DataLeads::max('no');

                    // Menambahkan 1 ke nomor terakhir
                    $newNo = $lastNo + 1;
                  

                    DataLeads::create([
                        'no' => $newNo,
                        'cust_name' => $row['nama_perusahaan'],
                        'jenis_data' => $jenis_data, // Assuming jenis_data is a column in the DataLeads table
                        'tanggal_terima_form_kbb' => $row['tanggal_terima_formulir_kbb'] !== null ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_terima_formulir_kbb'])->format('Y-m-d') : null,
                        'tanggal_terima_form_kbb_payroll' => $row['tanggal_terima_formulir_kbb_untuk_payroll'] !== null ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_terima_formulir_kbb_untuk_payroll'])->format('Y-m-d') : null,
                        'status' => ($row['tanggal_terima_formulir_kbb'] && $row['tanggal_terima_formulir_kbb_untuk_payroll']) ? 'Closing' : null,
                        'data_tanggal' => $row['tanggal_terima_formulir_kbb_untuk_payroll'] !== null ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_terima_formulir_kbb_untuk_payroll'])->format('Y-m-d') : null,
                        'tanggal_awal' => $this ->tanggal_awal_akuisisi,
                        'tanggal_akhir' => $this->tanggal_akhir_akuisisi,
                        'kcu' => $this ->kcu,
                    ]);
    
                    $newLeadId = DataLeads::where('cust_name', $row['nama_perusahaan'])->first()->id;

                    // Set data untuk DataLog
                    $logData = [
                        'id_data_leads' => $newLeadId,
                        'jenis_data' => $jenis_data,// Sesuaikan dengan jenis data yang dibuat di DataLeads
                        'status' => ($row['tanggal_terima_formulir_kbb'] && $row['tanggal_terima_formulir_kbb_untuk_payroll']) ? 'Closing' : null,
                        'tanggal_follow_up' => null,
                        'kcu' => $this->kcu, 
                        'data_tanggal' => $row['tanggal_terima_formulir_kbb_untuk_payroll'] !== null ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_terima_formulir_kbb_untuk_payroll'])->format('Y-m-d') : null,
                    ];

                    DataLog::create($logData);
                
            }
        }
    }
    
    // Function to calculate Jaro-Winkler similarity
    // private function similarity($str1, $str2)
    // {
    //     similar_text($str1, $str2, $percentage);
    //     return $percentage / 100;
    // }
    


   
}

