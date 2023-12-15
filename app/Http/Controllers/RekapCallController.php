<?php

namespace App\Http\Controllers;

use App\Imports\RekapCallImport;
use App\Models\DataKCU;
use App\Models\DataLeads;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RekapCallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kcu = DataKCU::all();
        $dataleads = DataLeads::all();
        return view('rekapcall.rekapcallindex',[
            'kcu' => $kcu,
            'dataleads' => $dataleads,
        ]);
    }

    

    public function import(Request $request)
    {
        $kcu = DataKCU::all();
        $dataleads = DataLeads::all();
        $tanggal_awal_call = $request->input('tanggal_awal');
        $tanggal_akhir_call = $request->input('tanggal_akhir');
       

        $dataLeadsBeforeImport =DataLeads::where('tanggal_awal', $tanggal_awal_call)
        ->where('tanggal_akhir',  $tanggal_akhir_call)
        ->get();

        

     
        if ($tanggal_akhir_call < $tanggal_awal_call) {
            
            $request->session()->flash('error', 'Tanggal Akhir tidak boleh kurang dari Tanggal Awal.');
            return redirect(route('rekapcall.index'));
        }

        $tanggalAwalBulan = date('m', strtotime($tanggal_awal_call));
        $tanggalAkhirBulan = date('m', strtotime($tanggal_akhir_call));

        if ($tanggalAwalBulan != $tanggalAkhirBulan) {
            $request->session()->flash('error', 'Tanggal Awal dan Tanggal Akhir harus pada bulan yang sama.');
            return redirect(route('rekapcall.index'));
        }

       
        try {
            $file = $request->file('file');
            $kcu = $request->input('kcu');
         

            // Menggunakan import yang telah dibuat (DataLeadsImport)
            $rekapCallImport = new RekapCallImport($kcu, $tanggal_awal_call, $tanggal_akhir_call);
            Excel::import($rekapCallImport, $file);
    
            $dataLeadsAfterImport = $rekapCallImport->getImportedData();
           
            // dd($dataLeadsBeforeImport,$dataLeadsAfterImport);
            

            $request->session()->flash('success', 'Rekap Call berhasil diupload');
            
            return redirect(route('dataleads.index'));
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
        $request->session()->flash('error', 'Terjadi Kesalahan: ' . $errorMessage);
            
        return redirect(route('rekapcall.index'));
    
    }
}
    /**
     * 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
