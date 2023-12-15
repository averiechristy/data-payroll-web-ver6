<?php

namespace App\Imports;

use App\Models\DataLeads;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// app/Imports/RekapCallImport.php

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RekapCallImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {        
        foreach ($row as $column => $value) {
            // Check if the customer name exists in the data_leads table
            $existingLead = DataLeads::where('cust_name', $row['nama_nasabah'])->first();
          
            if ($existingLead) {
                // Update the existing lead with data from the Excel file

                $validStatusValues =  ['Tidak Terhubung', 'Diskusi Internal', 'Berminat', 'Tidak Berminat', 'No. Telp Tidak Valid', 'Call Again', 'Closing']; // Gantilah dengan nilai status yang valid di database

                // Check if the status value from Excel is not in the valid status values
                if (!in_array($row['status_follow_up'], $validStatusValues)) {
                    // Jika tidak valid, buat pesan error
                    throw new \Exception(" Invalid status value '{$row['status_follow_up']}'.");
                }

                $validJenisDataValues = ['Data Leads', 'Referral'];

                if (!in_array($row['data_leads_referral_cabang'], $validJenisDataValues)) {
                    // Jika tidak valid, buat pesan error
                    throw new \Exception(" Invalid jenis data value '{$row['data_leads_referral_cabang']}'.");
                }
              
            $tanggalFollowUp = null;

            // Check if 'tanggal_follow_up' is not null in the Excel data
            if (!is_null($row['tanggal_follow_up'])) {
                try {
                    $tanggalFollowUp = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_follow_up'])->format('Y-m-d');
                } catch (\Exception $e) {
                    // Jika tidak valid, buat pesan error
                    throw new \Exception("Invalid date format '{$row['tanggal_follow_up']}'.");
                }
            }
                
                $updateData = [
                    'jenis_data' => $row['data_leads_referral_cabang'],
                    'status' => $row['status_follow_up'],
                    'tanggal_follow_up' => $tanggalFollowUp,
                ];

                // Check if 'pic_nasabah' is not null in the Excel data
                if (!is_null($row['pic_nasabah'])) {
                    $updateData['nama_pic_kbb'] = $row['pic_nasabah'];
                }

                $existingLead->update($updateData);
            }
        }
    }
}