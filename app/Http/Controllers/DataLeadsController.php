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
            return redirect(route('rekapcall.index'));
        }

        $tanggalAwalBulan = date('m', strtotime($tanggal_awal));
        $tanggalAkhirBulan = date('m', strtotime($tanggal_akhir));

        if ($tanggalAwalBulan != $tanggalAkhirBulan) {
            $request->session()->flash('error', 'Tanggal Awal dan Tanggal Akhir harus pada bulan yang sama.');
            return redirect(route('rekapcall.index'));
        }

        // Penjagaan: Tidak boleh memilih tanggal yang belum berjalan
       

        // Menggunakan import yang telah dibuat (DataLeadsImport)

        $dataleadsImport = new DataLeadsImport($tanggal_awal, $tanggal_akhir, $kcu);
        Excel::import($dataleadsImport, $file);

        // Excel::import(new DataLeadsImport($tanggal_awal, $tanggal_akhir, $kcu), $file);

        

        $request->session()->flash('success', 'Data Leads berhasil ditambahkan');
        return redirect(route('dataleads.index'));
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        $request->session()->flash('error', 'Terjadi Kesalahan: ' . $errorMessage);
        return redirect(route('rekapcall.index'));
    }
}


// DataLeadsController.php

public function export(Request $request)
{
    // Retrieve filter parameters from the request
    $kcu = $request->input('kcu');
    $jenis_data = $request->input('jenis_data');
    $tanggal_awal = $request->input('tanggal_awal');
    $tanggal_akhir = $request->input('tanggal_akhir');

    // Build query based on filter parameters
    $query = DB::table('data_leads');

    if ($kcu) {
        $query->where('kcu', $kcu);
    }

    if ($jenis_data) {
        $query->where('jenis_data', $jenis_data);
    }

    

    // Execute the query to get filtered data
    $filteredData = $query->get();

    // Tentukan nama file
    $filename = 'dataleads_export_' . date('YmdHis') . '.csv';

    // Buat file CSV
    $csvFile = fopen('php://temp', 'w');

    // Tulis header ke file CSV
    fputcsv($csvFile, [
        'No', 'Nama Customer', 'PIC', 'Status', 'KCU',
        'Tanggal Terima Form KBB', 'Tanggal Terima Form KBB Payroll',
        'Jenis Data', 'Tanggal Follow Up'
    ]);

    // Tulis data ke file CSV
    foreach ($filteredData as $data) {
        $kcuData = DataLeads::find($data->id)->kcuData;

        fputcsv($csvFile, [
            $data->no,
            $data->cust_name,
            $data->nama_pic_kbb,
            $data->status,
            $kcuData -> nama_kcu,
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



public function filterData(Request $request)
{

    $kcu = DataKCU::all();
    // Validasi request
    $request->validate([
        'kcu' => 'nullable|numeric',
        // tambahkan aturan validasi lainnya sesuai kebutuhan
    ]);

    // Ambil nilai KCU dari formulir
    $selectedKCU = $request->input('kcu');
    $selectedJenis = $request->input('jenis_data');
    
    $tanggalawal = $request->input('tanggal_awal');
    $tanggalakhir = $request->input('tanggal_akhir');

   
   
   

    // Query data berdasarkan filter
    $query = DataLeads::query();

    if ($selectedKCU) {
        $query->where('kcu', $selectedKCU);
    }

    if ($selectedJenis) {
        $query->where('jenis_data', $selectedJenis);
    }

    if ($tanggalawal) {
        $query->where('tanggal_awal', $tanggalawal);
    }

    

   

    // ... (Tambahkan logika filter lainnya jika diperlukan)

    // Ambil data hasil query
    $filteredData = $query->get();
    

    // Kirim data yang difilter ke tampilan
    return view('dataleads.index')->with([
        'dataleads' => $filteredData,
         // Sesuaikan dengan cara Anda mendapatkan data KCU
        'selectedKCU' => $selectedKCU,
        'selectedJenis' => $selectedJenis,
        'kcu' => $kcu,
        'tanggalawal' => $tanggalawal,
        'tanggalakhir' => $tanggalakhir,
        // tambahkan data lain yang perlu dikirim ke tampilan
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function rename(Request $request, $id)
    {

        $data = DataLeads::find($id);
       
       $data ->cust_name = $request->input('new_name');
       $data ->save();
    
       $request->session()->flash('success',  'Nama Customer Berhasil diedit');
    
        return redirect(route('dataleads.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DataLeads::find($id);
        return view('dataleads.editnama',[
            'data' => $data,
        ]);
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
    public function deleteData(Request $request)
    {
        $selectedIds = $request->input('selectedIds');

        // Pastikan checkbox dipilih sebelum menghapus
        if (!empty($selectedIds)) {
            DataLeads::whereIn('id', $selectedIds)->delete();
        }

        $request->session()->flash('error', 'Data Leads Berhasil Di hapus.');
            return redirect(route('dataleads.index'));

         // Ganti 'route.name' dengan nama route yang sesuai
    }
}
