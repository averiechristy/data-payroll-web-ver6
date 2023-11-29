<?php

namespace App\Http\Controllers;

use App\Models\DataKCU;
use App\Models\DataLeads;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataLeadsImport;
use Response;



class DataLeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataleads = DataLeads::all();
        $kcu = DataKCU::all();
                return view('dataleads.index',[
            'dataleads'=> $dataleads,
            'kcu' => $kcu,]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function import(Request $request)
{
    try {
        $file = $request->file('file');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $kcu = $request->input('kcu');
        

        if ($tanggal_akhir < $tanggal_awal) {
            
            $request->session()->flash('error', 'Tanggal Akhir tidak boleh kurang dari Tanggal Awal.');
            return redirect(route('dataleads.index'));
        }

        // Penjagaan: Tidak boleh memilih tanggal yang belum berjalan
        $today = now()->format('Y-m-d');
        if ($tanggal_awal > $today || $tanggal_akhir > $today) {
            $request->session()->flash('error', 'Tidak boleh memilih tanggal yang belum berjalan.');
            return redirect(route('dataleads.index'));
        }


        // Menggunakan import yang telah dibuat (DataLeadsImport)
        Excel::import(new DataLeadsImport($tanggal_awal, $tanggal_akhir, $kcu), $file);

        $request->session()->flash('success', 'Data Leads berhasil ditambahkan');
        return redirect(route('dataleads.index'));
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        $request->session()->flash('error', 'Terjadi Kesalahan: ' . $errorMessage);
        return redirect(route('dataleads.index'));
    }
}


// DataLeadsController.php

public function export()
{
    // Ambil data dari tabel DataLeads
    $dataleads = DB::table('data_leads')->get();

    // Tentukan nama file
    $filename = 'dataleads_export_' . date('YmdHis') . '.csv';

    // Buat file CSV
    $csvFile = fopen('php://temp', 'w');

    // Tulis header ke file CSV
    fputcsv($csvFile, ['No', 'Nama Customer', 'PIC', 'Status', 'Tanggal Terima Form KBB', 'Tanggal Terima Form KBB Payroll', 'Jenis Data', 'Tanggal Follow Up']);

    // Tulis data ke file CSV
    foreach ($dataleads as $data) {
        fputcsv($csvFile, [
            $data->no,
            $data->cust_name,
            $data->nama_pic_kbb,
            $data->status,
            $data->tanggal_terima_form_kbb,
            $data->tanggal_terima_form_kbb_payroll,
            $data->jenis_data,
            $data->tanggal_follow_up,
        ]);
    }

    // Kembalikan file CSV sebagai response
    rewind($csvFile);
    $csvContent = stream_get_contents($csvFile);
    fclose($csvFile);

    return Response::make($csvContent, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
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
