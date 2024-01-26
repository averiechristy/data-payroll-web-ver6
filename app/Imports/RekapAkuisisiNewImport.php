<?php

namespace App\Imports;

use App\Models\DataAkuisisi;
use App\Models\DataLeads;
use App\Models\DataUsage;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RekapAkuisisiNewImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */


    protected $currentRow = 0;

    protected $kcu;


    // private $bulan;

    private $tanggal_awal_akuisisi;
    private $tanggal_akhir_akuisisi;
   
    private $importedData = [];

    public function headingRow(): int
    {
        return 2; // Set the heading row to 3
    }

    public function __construct($kcu, $tanggal_awal_akuisisi, $tanggal_akhir_akuisisi)
    {
        $this->kcu = $kcu;
        // $this->bulan = $bulan;
        $this->kcu = $kcu;
        $this->tanggal_awal_akuisisi = $tanggal_awal_akuisisi;
        $this->tanggal_akhir_akuisisi = $tanggal_akhir_akuisisi;
    }
    
    public function collection(Collection $collection)
    {
        set_time_limit(120);
        // Increment the row counter
        $this->currentRow++;
    
        // $existingLeads = DataLeads::whereIn('cust_name', $collection->pluck('nama_perusahaan')->map(function($namaPerusahaan) {
        //     return strtolower($namaPerusahaan);
        // }))
        // ->where('kcu', $this->kcu)
        // ->get();
    
     
            foreach ($collection as $row) {

                if (empty(array_filter($row->toArray()))) {
                    // Baris kosong, skip pemrosesan
                    continue;
                }
    
                $namaPerusahaan = $row['nama_perusahaan'];
    
                // Ubah nama perusahaan menjadi huruf kecil
                $namaPerusahaanLowercase = strtolower($namaPerusahaan);
    
                $existingLead = DataLeads::where('cust_name', $namaPerusahaanLowercase)
                    ->where('kcu', $this->kcu)
                    ->orderBy('tanggal_follow_up', 'asc') // Order by date in descending order
                    ->first();

    

             if (!is_null($existingLead)) {
                    $latestTanggalAkhir = $existingLead->tanggal_akhir;
    
                    // Your existing logic for date formatting
                    $tanggal_awal = $existingLead->tanggal_awal;
                    $tanggal_awal_formatted = date('Y-m', strtotime($tanggal_awal));
    
                    $tanggal_akhir = $existingLead->tanggal_akhir;
                    $tanggal_akhir_formatted = date('Y-m', strtotime($tanggal_akhir));

                    $tanggal_awal_akuisisi_formatted  = date('Y-m', strtotime($this->tanggal_awal_akuisisi));
                    $tanggal_akhir_akuisisi_formatted  = date('Y-m', strtotime($this->tanggal_akhir_akuisisi));

                   
                    $status_akuisisi = null;
    
                    if ($tanggal_awal_formatted ==  $tanggal_awal_akuisisi_formatted && $tanggal_akhir_formatted ==  $tanggal_akhir_akuisisi_formatted) {

                        if (empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                        empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                        empty($row['konfirmasi_cmc'])) {
                        $status_akuisisi = "Waiting confirmation from BCA";
                    } else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                        empty($row['konfirmasi_cmc'])
                    ) {
                        $status_akuisisi = "Waiting confirmation from BCA";
                    } else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                        ($row['konfirmasi_cmc'] == "Y")
                    ){
                        $status_akuisisi = "Akuisisi";
                    } else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                        ($row['konfirmasi_cmc'] == "Y")
                    ){
                        $status_akuisisi = "Akuisisi";
                    }

                    else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                        empty($row['konfirmasi_cmc'])
                    ){
                        $status_akuisisi = "Waiting confirmation from BCA";
                    }else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                        ($row['konfirmasi_cmc'] == "N")
                    ){
                        $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                    }else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                        empty($row['konfirmasi_cmc'])
                    ){
                        $status_akuisisi = "Waiting confirmation from BCA";
                    }else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                        ($row['konfirmasi_cmc'] == "N")
                    ){
                        $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                    }
                    else if (
                        ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                        ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                        ($row['konfirmasi_cmc'] == "N")
                    ){
                        $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                    }

                    else if (
                        empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                        empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                        empty($row['konfirmasi_cmc'])
                    ){
                        $status_akuisisi = "Waiting confirmation from BCA";
                    }


                     else {
                        throw new \Exception("Tidak ditemukan status yang sesuai.");       

                    }

                    
                    
                   if($status_akuisisi == "Akuisisi" &&
                  !empty($row['usage_transaksi']) &&
                       !empty($row['frekuensi_transaksi']) &&
                       !empty($row['tanggal_transaksi_multi_payroll'])
                   ) {

                    $updateData = [
                        'status_akuisisi' => $status_akuisisi,
                        'data_tanggal' =>  $this->tanggal_akhir_akuisisi,
                        'tanggal_usage_claim' =>  $this->tanggal_akhir_akuisisi,
                 
                    ];

                  
                    $existingLead->update($updateData);

                   } else  if($status_akuisisi == "Akuisisi" &&
                   empty($row['usage_transaksi']) &&
                        empty($row['frekuensi_transaksi']) &&
                        empty($row['tanggal_transaksi_multi_payroll'])
                    ) {

                        $updateData = [
                            'status_akuisisi' => $status_akuisisi,
                            'data_tanggal' => $this->tanggal_akhir_akuisisi,
                                                 
                        ];

                        $existingLead->update($updateData);

                   } else if($status_akuisisi == "Migrasi Limit") {
                    $updateData = [
                        'status_akuisisi' => $status_akuisisi,
                        'data_tanggal' =>  $this->tanggal_akhir_akuisisi,
                        'tanggal_usage_not_claim' =>  $this->tanggal_akhir_akuisisi,
                    ];

                   

                    $existingLead->update($updateData);
                 


                   } else if($status_akuisisi == "Reaktivasi") {
                      $updateData = [
                        'status_akuisisi' => $status_akuisisi,
                        'data_tanggal' =>  $this->tanggal_akhir_akuisisi,
                        'tanggal_usage_not_claim' =>  $this->tanggal_akhir_akuisisi,
              
                    ];

                
                    
                    $existingLead->update($updateData);

                   }else if($status_akuisisi == "Migrasi Limit/ Reaktivasi/ Not OK") {
                    $updateData = [
                      'status_akuisisi' => $status_akuisisi,
                      'data_tanggal' =>  $this->tanggal_akhir_akuisisi,
                      'tanggal_usage_not_claim' =>  $this->tanggal_akhir_akuisisi,
            
                  ];

              
                  
                  $existingLead->update($updateData);

                 } 
                   
                   else if ($status_akuisisi == "Waiting confirmation from BCA") {

                    $updateData = [
                        'status_akuisisi' => $status_akuisisi,
                        'data_tanggal' =>  $this->tanggal_akhir_akuisisi,
                                             
                    ];
                   
                    $existingLead->update($updateData);
                   }

                    } else if ($tanggal_awal_formatted != $tanggal_awal_akuisisi_formatted || $tanggal_akhir_formatted != $tanggal_akhir_akuisisi_formatted ) {
                        // Update the existing lead with the latest date
                        if ($existingLead->status_akuisisi == "Akuisisi") {
                            if (!empty($row['usage_transaksi']) &&
                                !empty($row['frekuensi_transaksi']) &&
                                !empty($row['tanggal_transaksi_multi_payroll'])
                            ) {
                                // Check if usage data already exists for the same id_data_leads
                                $existingUsage = DataUsage::where('id_data_leads', $existingLead->id)->first();

                        
                                if ($existingUsage) {
                                    // Jika sudah ada, lakukan pembaruan
                                    $existingUsage->update([
                                        'tanggal_usage_claim' => $this->tanggal_akhir_akuisisi,
                                        'kcu' => $existingLead->kcu,
                                        'jenis_data' => $existingLead->jenis_data
                                        // Tambahkan kolom lain yang perlu diperbarui
                                    ]);
                                } else {
                                    // Jika belum ada, buat entri baru
                                    $createUsage = [
                                        'id_data_leads' => $existingLead->id,
                                        'tanggal_usage_claim' => $this->tanggal_akhir_akuisisi,
                                        'kcu' => $existingLead->kcu,
                                        'jenis_data' => $existingLead->jenis_data
                                    ];
                        
                                    DataUsage::create($createUsage);
                                }
                            } else if (empty($row['usage_transaksi']) &&
                                empty($row['frekuensi_transaksi']) &&
                                empty($row['tanggal_transaksi_multi_payroll'])
                            ) {
                                throw new \Exception("Nama perusahaan '{$row['nama_perusahaan']}' sudah akuisisi.");
                            }
                        }
                        
                           else  if ($existingLead->status_akuisisi == "Waiting confirmation from BCA") {
                        
                            $existingLeadConfirm = DataAkuisisi::join('data_leads', 'data_leads.id', '=', 'data_akuisisis.id_data_leads')
                            ->where('data_leads.cust_name', $namaPerusahaanLowercase)
                            ->where('data_akuisisis.kcu', $this->kcu) // Sesuaikan dengan kolom yang sesuai untuk kcu
                            ->select('data_akuisisis.*')
                            ->first();


                            if (!is_null($existingLeadConfirm)) {

                                $tanggal_awal_akuisisi_formatted  = date('Y-m', strtotime($this->tanggal_awal_akuisisi));
                                $tanggal_akhir_akuisisi_formatted  = date('Y-m', strtotime($this->tanggal_akhir_akuisisi));
                                $tanggal_status_formated = date('Y-m', strtotime($existingLeadConfirm->tanggal_status));


                                if ($tanggal_status_formated ==  $tanggal_awal_akuisisi_formatted && $tanggal_status_formated ==  $tanggal_akhir_akuisisi_formatted) {

                                    if (empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                                    empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                                    empty($row['konfirmasi_cmc'])) {
                                    $status_akuisisi = "Waiting confirmation from BCA";
                                } else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                    empty($row['konfirmasi_cmc'])
                                ) {
                                    $status_akuisisi = "Waiting confirmation from BCA";
                                } else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                    ($row['konfirmasi_cmc'] == "Y")
                                ){
                                    $status_akuisisi = "Akuisisi";
                                } else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                    ($row['konfirmasi_cmc'] == "Y")
                                ){
                                    $status_akuisisi = "Akuisisi";
                                }
            
                                else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                    empty($row['konfirmasi_cmc'])
                                ){
                                    $status_akuisisi = "Waiting confirmation from BCA";
                                }else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                    ($row['konfirmasi_cmc'] == "N")
                                ){
                                    $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                                }else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                    empty($row['konfirmasi_cmc'])
                                ){
                                    $status_akuisisi = "Waiting confirmation from BCA";
                                }else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                    ($row['konfirmasi_cmc'] == "N")
                                ){
                                    $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                                }
                                else if (
                                    ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                    ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                    ($row['konfirmasi_cmc'] == "N")
                                ){
                                    $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                                }
                                else if (
                                    empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                                    empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                                    empty($row['konfirmasi_cmc'])
                                ){
                                    $status_akuisisi = "Waiting confirmation from BCA";
                                }
            
                                 else {
                                    throw new \Exception("Tidak ditemukan status yang sesuai.");       
            
                                }
            

                                

                              
                                if($status_akuisisi == "Akuisisi" &&
                                !empty($row['usage_transaksi']) &&
                                     !empty($row['frekuensi_transaksi']) &&
                                     !empty($row['tanggal_transaksi_multi_payroll'])
                                 ) {
              
                                 
                                $updatedataconfirm = [
                                    'status_akuisisi_baru' => $status_akuisisi,
                                    'tanggal_status' => $this->tanggal_akhir_akuisisi,
                                    'tanggal_usage_claim' => $this->tanggal_akhir_akuisisi,
                                ];

                                $existingLeadConfirm->update($updatedataconfirm);

              
                                 } else  if($status_akuisisi == "Akuisisi" &&
                                 empty($row['usage_transaksi']) &&
                                      empty($row['frekuensi_transaksi']) &&
                                      empty($row['tanggal_transaksi_multi_payroll'])
                                  ) {
                                    $updatedataconfirm = [
                                        'status_akuisisi_baru' => $status_akuisisi,
                                        'tanggal_status' => $this->tanggal_akhir_akuisisi,
                                    ];
    
                                    $existingLeadConfirm->update($updatedataconfirm);

                                 } else {
                                    $updatedataconfirm = [
                                        'status_akuisisi_baru' => $status_akuisisi,
                                        'tanggal_status' => $this->tanggal_akhir_akuisisi,
                                    ];
    
                                    $existingLeadConfirm->update($updatedataconfirm);

                                 }


                                } else if ($tanggal_status_formated != $tanggal_awal_akuisisi_formatted || $tanggal_status_formated != $tanggal_akhir_akuisisi_formatted ) {

                                    if (empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                                empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                                empty($row['konfirmasi_cmc'])) {
                                $status_akuisisi = "Waiting confirmation from BCA";
                            } else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                empty($row['konfirmasi_cmc'])
                            ) {
                                $status_akuisisi = "Waiting confirmation from BCA";
                            } else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                ($row['konfirmasi_cmc'] == "Y")
                            ){
                                $status_akuisisi = "Akuisisi";
                            } else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                ($row['konfirmasi_cmc'] == "Y")
                            ){
                                $status_akuisisi = "Akuisisi";
                            }
        
                            else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                empty($row['konfirmasi_cmc'])
                            ){
                                $status_akuisisi = "Waiting confirmation from BCA";
                            }else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                ($row['konfirmasi_cmc'] == "N")
                            ){
                                $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                            }else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                empty($row['konfirmasi_cmc'])
                            ){
                                $status_akuisisi = "Waiting confirmation from BCA";
                            }else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                ($row['konfirmasi_cmc'] == "N")
                            ){
                                $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                            }
                            else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                ($row['konfirmasi_cmc'] == "N")
                            ){
                                $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                            }
                            else if (
                                empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                                empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                                empty($row['konfirmasi_cmc'])
                            ){
                                $status_akuisisi = "Waiting confirmation from BCA";
                            }
        
                             else {
                                throw new \Exception("Tidak ditemukan status yang sesuai.");       
        
                            }
        

                           
                            
                            if($status_akuisisi == "Akuisisi" &&
                            !empty($row['usage_transaksi']) &&
                                 !empty($row['frekuensi_transaksi']) &&
                                 !empty($row['tanggal_transaksi_multi_payroll'])
                             ) {
          
                              $createUsage = [
                                  'id_data_leads' => $existingLead->id,
          
                                  'status_akuisisi' => $status_akuisisi,
                                  'tanggal_usage_claim' => $this->tanggal_akhir_akuisisi,
                                  'kcu' => $existingLead->kcu,
                                  'jenis_data' => $existingLead->jenis_data

                           
                              ];
          
                              $createakuisisi =[
                                  'id_data_leads' => $existingLead->id,
                                  'status_akuisisi_baru' => $status_akuisisi,
                                  'tanggal_status' => $this->tanggal_akhir_akuisisi,
                                  'kcu' => $existingLead->kcu,
                                  'jenis_data' => $existingLead->jenis_data

                              ]; 
          
          
                              DataUsage::create($createUsage);
          
                              DataAkuisisi::create($createakuisisi);
          
                            
          
                             } else  if($status_akuisisi == "Akuisisi" &&
                             empty($row['usage_transaksi']) &&
                                  empty($row['frekuensi_transaksi']) &&
                                  empty($row['tanggal_transaksi_multi_payroll'])
                              ) {
          
                                  $createakuisisi =[
                                      'id_data_leads' => $existingLead->id,
                                      'status_akuisisi_baru' => $status_akuisisi,
                                      'tanggal_status' => $this->tanggal_akhir_akuisisi,
                                      'kcu' => $existingLead->kcu,
                                      'jenis_data' => $existingLead->jenis_data

                                  ]; 
          
                                  DataAkuisisi::create($createakuisisi);
          
                             } else {
                              $createakuisisi =[
                                  'id_data_leads' => $existingLead->id,
                                  'status_akuisisi_baru' => $status_akuisisi,
                                  'tanggal_status' => $this->tanggal_akhir_akuisisi,
                                  'kcu' => $existingLead->kcu,
                                  'jenis_data' => $existingLead->jenis_data

                              ]; 
          
                              DataAkuisisi::create($createakuisisi);
                             }


                                }

                                
                            } elseif  (is_null($existingLeadConfirm)) {

                                if (empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                                empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                                empty($row['konfirmasi_cmc'])) {
                                $status_akuisisi = "Waiting confirmation from BCA";
                            } else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                empty($row['konfirmasi_cmc'])
                            ) {
                                $status_akuisisi = "Waiting confirmation from BCA";
                            } else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                ($row['konfirmasi_cmc'] == "Y")
                            ){
                                $status_akuisisi = "Akuisisi";
                            } else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                ($row['konfirmasi_cmc'] == "Y")
                            ){
                                $status_akuisisi = "Akuisisi";
                            }
        
                            else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                empty($row['konfirmasi_cmc'])
                            ){
                                $status_akuisisi = "Waiting confirmation from BCA";
                            }else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                ($row['konfirmasi_cmc'] == "N")
                            ){
                                $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                            }else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                empty($row['konfirmasi_cmc'])
                            ){
                                $status_akuisisi = "Waiting confirmation from BCA";
                            }else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "Y") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "Y") &&
                                ($row['konfirmasi_cmc'] == "N")
                            ){
                                $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                            }
                            else if (
                                ($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada'] == "N") &&
                                ($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada'] == "N") &&
                                ($row['konfirmasi_cmc'] == "N")
                            ){
                                $status_akuisisi = "Migrasi Limit/ Reaktivasi/ Not OK";
                            }
                            else if (
                                empty($row['limit_payroll_y_sudah_ada_sebelumnya_n_blm_ada']) &&
                                empty($row['termasuk_reaktivasi_y_tidak_ada_penggunaan_sejak_1_jan_22_n_sudah_ada']) &&
                                empty($row['konfirmasi_cmc'])
                            ){
                                $status_akuisisi = "Waiting confirmation from BCA";
                            }
        
                             else {
                                throw new \Exception("Tidak ditemukan status yang sesuai.");       
        
                            }
        
                           

                           
                            if($status_akuisisi == "Akuisisi" &&
                  !empty($row['usage_transaksi']) &&
                       !empty($row['frekuensi_transaksi']) &&
                       !empty($row['tanggal_transaksi_multi_payroll'])
                   ) {

                    $createUsage = [
                        'id_data_leads' => $existingLead->id,

                        'status_akuisisi' => $status_akuisisi,
                        'tanggal_usage_claim' => $this->tanggal_akhir_akuisisi,
                        'kcu' => $existingLead->kcu,
                        'jenis_data' => $existingLead->jenis_data

                 
                    ];

                    $createakuisisi =[
                        'id_data_leads' => $existingLead->id,
                        'status_akuisisi_baru' => $status_akuisisi,
                        'tanggal_status' => $this->tanggal_akhir_akuisisi,
                        'kcu' => $existingLead->kcu,
                        'jenis_data' => $existingLead->jenis_data,
                        'tanggal_usage_claim' => $this->tanggal_akhir_akuisisi,

                    ]; 


                    DataUsage::create($createUsage);

                    DataAkuisisi::create($createakuisisi);

                  

                   } else  if($status_akuisisi == "Akuisisi" &&
                   empty($row['usage_transaksi']) &&
                        empty($row['frekuensi_transaksi']) &&
                        empty($row['tanggal_transaksi_multi_payroll'])
                    ) {

                        $createakuisisi =[
                            'id_data_leads' => $existingLead->id,
                            'status_akuisisi_baru' => $status_akuisisi,
                            'tanggal_status' => $this->tanggal_akhir_akuisisi,
                            'kcu' => $existingLead->kcu,
                            'jenis_data' => $existingLead->jenis_data

                        ]; 

                        DataAkuisisi::create($createakuisisi);

                   } else {
                    $createakuisisi =[
                        'id_data_leads' => $existingLead->id,
                        'status_akuisisi_baru' => $status_akuisisi,
                        'tanggal_status' => $this->tanggal_akhir_akuisisi,
                        'kcu' => $existingLead->kcu,
                        'jenis_data' => $existingLead->jenis_data

                    ]; 

                    DataAkuisisi::create($createakuisisi);
                   }
                               

                            }
                            
                         
                            

                           } 
                           
                           else {
                            throw new \Exception("Nama perusahaan '{$row['nama_perusahaan']}'tidak dengan status akuisisi atau waiting confirmation");       

                           }
                       
                    } else {
                        throw new \Exception("Nama perusahaan '{$row['nama_perusahaan']}' tidak terdapat pada data leads maupun referral.");       
                    }
                } else {
                    throw new \Exception("Nama perusahaan '{$row['nama_perusahaan']}' tidak terdapat pada data leads maupun referral.");       
                
                }
            }

       
    }
    
}
