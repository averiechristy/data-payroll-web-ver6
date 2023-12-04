<?php

namespace App\Http\Controllers;

use App\Models\DataKCU;
use App\Models\DataLeads;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $today = Carbon::now();
    
    $startOfWeek = $today->startOfWeek(); 
    $endOfWeek = $today->copy()->endOfWeek(Carbon::FRIDAY);    


    $dataLeads = DataLeads::where('tanggal_awal', '>=', $startOfWeek)
    ->where('tanggal_awal', '<=', $endOfWeek)
    ->get();

    $today = Carbon::now();
    $startOfMonth = $today->startOfMonth();
    $endOfMonth = $today->copy()->endOfMonth();
    
    $dataleads = DataLeads::where('tanggal_awal', '>=', $startOfMonth)
        ->where('tanggal_awal', '<=', $endOfMonth)
        ->get();

        
        

    $kcu = DataKCU::all();

    $dtkcu = DataKCU::all();

    $totalBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status', 'Berminat')->count();
    }

    $totalContactedPerKCU = [];
    foreach ($kcu as $item) {
        $totalContactedPerKCU[$item->id] = $dataleads->where('kcu', $item->id)
            ->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat', 'Call Again', 'Closing'])
            ->count();
    }

    $totalClosingPerKCU = [];
    foreach ($kcu as $item) {
        $totalClosingPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status', 'Closing')->count();
    }

   

    $totalBerminat = $dataleads->where('status', 'Berminat')->count();
    

    // Menghitung persentase data yang memiliki status 'Berminat'
    $persentaseBerminat = $dataleads->count() > 0 ? number_format(($totalBerminat / $dataleads->count()) * 100, 1) : 0;
    
    // Menghitung total data yang memiliki status tertentu
    $totalContacted = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat','Call Again', 'Closing'])->count();
    
    // Menghitung persentase data yang memiliki status tertentu
    $persentaseContacted = $dataleads->count() > 0 ? number_format(($totalContacted / $dataleads->count()) * 100, 1) : 0;
    
    // Menghitung total data yang memiliki status 'Closing'
    $totalClosing = $dataleads->where('status', 'Closing')->count();
    
    // Menghitung persentase data yang memiliki status 'Closing'
    $persentaseClosing = $dataleads->count() > 0 ? number_format(($totalClosing / $dataleads->count()) * 100, 1) : 0;


    
       
    $weeklyData = [];

$today = Carbon::now();
$currentWeekStart = $today->startOfWeek();  

// Membagi data per minggu
while ($currentWeekStart->lte($endOfMonth)) {
    $currentWeekEnd = $currentWeekStart->copy()->endOfWeek(Carbon::FRIDAY);

    $weeklyData[] = [
        'start_date' => $currentWeekStart->toDateString(),
        'end_date' => $currentWeekEnd->toDateString(),
        'totalBerminat' => DataLeads::where('status', 'Berminat')->where('tanggal_awal', '>=', $currentWeekStart)->where('tanggal_akhir', '<=', $currentWeekEnd)->count(),
        'totalContacted' => DataLeads::whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat', 'Call Again', 'Closing'])->where('tanggal_awal', '>=', $currentWeekStart)->where('tanggal_akhir', '<=', $currentWeekEnd)->count(),
        'totalClosing' => DataLeads::where('status', 'Closing')->where('tanggal_awal', '>=', $currentWeekStart)->where('tanggal_akhir', '<=', $currentWeekEnd)->count(),
    ];

    $currentWeekStart->addWeek(); // Pindah ke minggu berikutnya
}

// Modifikasi indeks array
$weeklyData = array_combine(range(1, count($weeklyData)), array_values($weeklyData));



    

    
    
    return view('dashboard', [
        'dataleads' => $dataleads,
        'kcu' => $kcu,
'weeklyData' => $weeklyData,
        'persentaseBerminat' => $persentaseBerminat, 
        'persentaseContacted' => $persentaseContacted,
        'persentaseClosing' => $persentaseClosing,
        'totalBerminatPerKCU' => $totalBerminatPerKCU,
        'totalContactedPerKCU' => $totalContactedPerKCU,
        'totalClosingPerKCU' => $totalClosingPerKCU,
        'dtkcu' => $dtkcu,
        
    ]);
}

public function filterdata(Request $request)
{
    $currentMonth = now()->format('m');
    $selectedKCU = $request->input('kcu');
    $selectedJenis = $request->input('jenis_data');
    $tanggalawal = $request->input('tanggal_awal');
    $tanggalakhir = $request->input('tanggal_akhir');


    if ($tanggalakhir < $tanggalawal) {
            
        $request->session()->flash('error', 'Tanggal Akhir tidak boleh kurang dari Tanggal Awal.');
        return redirect(route('dashboard'));
    }

    
    
    $dataKCU = DataKCU::find($selectedKCU);
    
    // Mengambil semua data leads pada bulan berjalan
    $today = Carbon::now();
    
    $startOfWeek = $today->startOfWeek(); 
    $endOfWeek = $today->copy()->endOfWeek(Carbon::FRIDAY);    


    $dataLeads = DataLeads::where('tanggal_awal', '>=', $startOfWeek)
    ->where('tanggal_awal', '<=', $endOfWeek)
    ->get();

    $today = Carbon::now();
    $startOfMonth = $today->startOfMonth();
    $endOfMonth = $today->copy()->endOfMonth();
    
    $dataleads = DataLeads::where('tanggal_awal', '>=', $startOfMonth)
        ->where('tanggal_awal', '<=', $endOfMonth);

        if ($tanggalawal && $tanggalakhir) {
            // Filter berdasarkan range tanggal
            $dataleads = DataLeads::whereBetween('tanggal_awal', [$tanggalawal, $tanggalakhir]);

            $dataleads = DataLeads::where('tanggal_awal', '>=', $tanggalawal)
            ->where('tanggal_awal', '<=', $tanggalakhir);

          
        } else {
            // Jika salah satu atau kedua tanggal tidak diisi, tetap gunakan filter tanggal bulan ini
            $today = Carbon::now();
            $startOfMonth = $today->startOfMonth();
            $endOfMonth = $today->copy()->endOfMonth();
        
            $dataleads = DataLeads::where('tanggal_awal', '>=', $startOfMonth)
                ->where('tanggal_awal', '<=', $endOfMonth);
        }
        
        
    if ($selectedKCU) {
        $dataleads->where('kcu', $selectedKCU);
    }

    
    if ($selectedJenis) {
        $dataleads->where('jenis_data', $selectedJenis);
    }

   

    $dataleads = $dataleads->get();

    


    $kcu = DataKCU::all();
    
    $dtkcu = DataKCU::all();

    // Total data per KCU
    $totalBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status', 'Berminat')->count();
    }

    
   

    $totalContactedPerKCU = [];
    foreach ($kcu as $item) {
        $totalContactedPerKCU[$item->id] = $dataleads->where('kcu', $item->id)
            ->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat', 'Call Again', 'Closing'])
            ->count();
    }

    $totalClosingPerKCU = [];
    foreach ($kcu as $item) {
        $totalClosingPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status', 'Closing')->count();
    }

    // $totalBerminatPerKCU = $dataleads->where('status', 'Berminat')->count();
  
   
    // $totalContactedPerKCU = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat','Call Again', 'Closing'])->count();
    // $totalClosingPerKCU = $dataleads->where('status', 'Closing')->count();


$totalBerminat = $dataleads->where('status', 'Berminat')->count();

$persentaseBerminat = $dataleads->count() > 0 ? number_format(($totalBerminat / $dataleads->count()) * 100, 1) : 0;


$totalContacted = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat','Call Again', 'Closing'])->count();

$persentaseContacted = $dataleads->count() > 0 ? number_format(($totalContacted / $dataleads->count()) * 100, 1) : 0;

$totalClosing = $dataleads->where('status', 'Closing')->count();

$persentaseClosing = $dataleads->count() > 0 ? number_format(($totalClosing / $dataleads->count()) * 100, 1) : 0;
       




        session()->put('selectedJenis', $selectedJenis);
    session()->put('selectedKCU', $selectedKCU);
    session()->put('tanggalAwal', $tanggalawal);
    session()->put('tanggalAkhir', $tanggalakhir);
    
    return view('dashboard', [
        'dataleads' => $dataleads,
        'kcu' => $kcu,
        'persentaseBerminat' => $persentaseBerminat,
        'persentaseContacted' => $persentaseContacted,
        'persentaseClosing' => $persentaseClosing,
        'totalBerminatPerKCU' => $totalBerminatPerKCU,
        'totalContactedPerKCU' => $totalContactedPerKCU,
        'totalClosingPerKCU' => $totalClosingPerKCU,
        'dtkcu' => $dtkcu,
        'selectedKCU' =>$selectedKCU,
        'dataKCU' => $dataKCU,
        'selectedJenis' => $selectedJenis,
        'tanggalAwal' => $tanggalawal,
        'tanggalAkhir' => $tanggalakhir,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function reset()
    {
        return view ('dashboard');
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
