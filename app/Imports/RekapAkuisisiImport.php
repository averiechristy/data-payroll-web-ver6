<?php

namespace App\Imports;

use App\Models\DataLeads;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RekapAkuisisiImport implements ToModel, WithHeadingRow
{
    protected $currentRow = 0;

    public function headingRow(): int
    {
        return 2; // Set the heading row to 3
    }

    public function model(array $row)
    {
        // Increment the row counter
        $this->currentRow++;
   
        // Process only the third row
        // Your existing logic for processing the row goes here
        foreach ($row as $column => $value) {

            
            // Check if the customer name exists in the data_leads table
            $existingLeads = DataLeads::all();
    
            foreach ($existingLeads as $existingLead) {
                // Compare the similarity of customer names using Jaro-Winkler algorithm
                $similarityScore = $this->similarity($row['nama_perusahaan'], $existingLead->cust_name);

               
    
                // You can adjust the threshold as needed
                $threshold = 0.5;
    
                if ($similarityScore > $threshold) {
                    // Update the existing lead with data from the Excel file
                    $updateData = [];

                    if ($row['tanggal_terima_formulir_kbb'] !== null) {
                        $updateData['tanggal_terima_form_kbb'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_terima_formulir_kbb'])->format('Y-m-d');
                    }
                    else {
                        $updateData['tanggal_terima_form_kbb'] = null;
                    }
    
    
    
                    if ($row['tanggal_terima_formulir_kbb_untuk_payroll'] !== null) {
                        $updateData['tanggal_terima_form_kbb_payroll'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_terima_formulir_kbb_untuk_payroll'])->format('Y-m-d');
                    }
                    else {
                        $updateData['tanggal_terima_form_kbb_payroll'] = null;
                    }
    
    
                

                    $updateData['status'] = ($row['tanggal_terima_formulir_kbb'] && $row['tanggal_terima_formulir_kbb_untuk_payroll']) ? 'Closing' : $existingLead->status;
    
                    // Update the existing lead only if there is data to update
                    if (!empty($updateData)) {
                        $existingLead->update($updateData);
                    }
                }
            }
        }
    }
    
    // Function to calculate Jaro-Winkler similarity
    private function similarity($str1, $str2)
    {
        similar_text($str1, $str2, $percentage);
        return $percentage / 100;
    }
    


   
}

