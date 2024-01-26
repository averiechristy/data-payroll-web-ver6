<?php

namespace App\Http\Controllers;

use App\Imports\RekapAkuisisiImport;
use App\Imports\RekapAkuisisiNewImport;
use App\Models\DataKCU;
use App\Models\DataLeads;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RekapAkuisisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function import(Request $request)
    {
        $kcu = DataKCU::all();
        $dataleads = DataLeads::all();
        $tanggal_awal_akuisisi = $request->input('tanggal_awal');
        $tanggal_akhir_akuisisi = $request->input('tanggal_akhir');
        if ($tanggal_akhir_akuisisi < $tanggal_awal_akuisisi) {
            
            $request->session()->flash('error', 'Tanggal Akhir tidak boleh kurang dari Tanggal Awal.');
            return redirect(route('rekapcall.index'));
        }

        $tanggalAwalBulan = date('m', strtotime($tanggal_awal_akuisisi));
        $tanggalAkhirBulan = date('m', strtotime($tanggal_akhir_akuisisi));

        if ($tanggalAwalBulan != $tanggalAkhirBulan) {
            $request->session()->flash('error', 'Tanggal Awal dan Tanggal Akhir harus pada bulan yang sama.');
            return redirect(route('rekapcall.index'));
        }

        try {
            $file = $request->file('file');
            $kcu = $request->input('kcu');
            
            // Menggunakan import yang telah dibuat (DataLeadsImport)
            Excel::import(new RekapAkuisisiImport( $kcu,$tanggal_awal_akuisisi, $tanggal_akhir_akuisisi), $file);


            $request->session()->flash('success', 'Rekap Akuisisi berhasil diupload');
            
            return redirect(route('dataleads.index'));

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
        $request->session()->flash('error', 'Terjadi Kesalahan: ' . $errorMessage);
            
        return redirect(route('dataleads.index'));

    }
}


public function importbulan(Request $request)
{
    $kcu = DataKCU::all();
    $dataleads = DataLeads::all();
    // $bulan = $request->input('bulan');

    $tanggal_awal_akuisisi = $request->input('tanggal_awal');
    $tanggal_akhir_akuisisi = $request->input('tanggal_akhir');

    // $tanggal_akhir_akuisisi = $request->input('tanggal_akhir');
    // if ($tanggal_akhir_akuisisi < $tanggal_awal_akuisisi) {
        
    //     $request->session()->flash('error', 'Tanggal Akhir tidak boleh kurang dari Tanggal Awal.');
    //     return redirect(route('rekapcall.index'));
    // }

    // $tanggalAwalBulan = date('m', strtotime($tanggal_awal_akuisisi));
    // $tanggalAkhirBulan = date('m', strtotime($tanggal_akhir_akuisisi));

    // if ($tanggalAwalBulan != $tanggalAkhirBulan) {
    //     $request->session()->flash('error', 'Tanggal Awal dan Tanggal Akhir harus pada bulan yang sama.');
    //     return redirect(route('rekapcall.index'));
    // }

    try {
        $file = $request->file('file');
        $kcu = $request->input('kcu');
        
        // Menggunakan import yang telah dibuat (DataLeadsImport)
        Excel::import(new RekapAkuisisiNewImport( $kcu,$tanggal_awal_akuisisi,$tanggal_akhir_akuisisi), $file);


        $request->session()->flash('success', 'Rekap Akuisisi berhasil diupload');
        
        return redirect(route('dataleads.index'));

    } catch (\Exception $e) {

        $errorMessage = $e->getMessage();
    $request->session()->flash('error', 'Terjadi Kesalahan: ' . $errorMessage);
        
    return redirect(route('dataleads.index'));

}
}
    /**
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
