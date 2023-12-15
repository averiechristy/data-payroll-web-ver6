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
    
    // $startOfWeek = $today->startOfWeek(); 
    // $endOfWeek = $today->copy()->endOfWeek();    


    // $dataLeads = DataLeads::where('tanggal_awal', '>=', $startOfWeek)
    // ->where('tanggal_awal', '<=', $endOfWeek)
    // ->get();

    $today = Carbon::now();
    $startOfMonth = $today->startOfMonth();
    
    $endOfMonth = $today->copy()->endOfMonth();
    
    $dataleads = DataLeads::where('data_tanggal', '>=', $startOfMonth)
        ->where('data_tanggal', '<=', $endOfMonth)
        ->get();
       

    $kcu = DataKCU::all();

    $dtkcu = DataKCU::all();

    $totalBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->whereIn('status', ['Berminat',  'Diskusi Internal'])->count();
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


    $totalUnContactedPerKCU = [];
    foreach ($kcu as $item) {
        $totalUnContactedPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->whereIn('status',['Tidak Terhubung', 'No. Telp Tidak Valid'])->count();
    }

   

    $totalNotCallPerKCU = [];
    foreach ($kcu as $item) {
        $totalNotCallPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Belum Dikerjakan')->count();
    }


    $totalStatusBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Berminat')->count();
    }
    
    
    $totalStatusTidakBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusTidakBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Tidak Berminat')->count();
    }

   
    
    $totalStatusTidakTerhubungPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusTidakTerhubungPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Tidak Terhubung')->count();
    }
    
    $totalStatusNoTelpTidakValidPerKCU = [];
    foreach ($kcu as $item) {        
    $totalStatusNoTelpTidakValidPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','No. Telp Tidak Valid')->count();
    }
    
    $totalStatusDiskusiInternalPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusDiskusiInternalPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Diskusi Internal')->count();
    }

    $totalStatusCallAgainPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusCallAgainPerKCU [$item->id] = $dataleads->where('kcu', $item->id)->where('status','Call Again')->count();
    }
    
    


    $totalBerminat = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal'])->count();
   
    

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

    $totalNotCall = $dataleads->where('status', 'Belum Dikerjakan')->count();
    
    $persentaseNotCall = $dataleads->count() > 0 ? number_format(($totalNotCall / $dataleads->count()) * 100, 1) : 0;

    $totalUnContacted = $dataleads->whereIn('status', ['Tidak Terhubung', 'No. Telp Tidak Valid'])->count();
   
$persentaseUnContacted =  $dataleads->count() > 0 ? number_format(($totalUnContacted / $dataleads->count()) * 100, 1) : 0;

$Berminat = $dataleads->where('status', 'Berminat')->count();
$TidakBerminat = $dataleads->where('status', 'Tidak Berminat')->count();
$TidakTerhubung = $dataleads->where('status', 'Tidak Terhubung')->count();
$NoTelpTidakValid = $dataleads->where('status', 'No. Telp Tidak Valid')->count();
$DiskusiInternal = $dataleads->where('status', 'Diskusi Internal')->count();
$CallAgain = $dataleads->where('status', 'Call Again')->count();



$persentaseStatusBerminat = $dataleads->count() > 0 ? number_format(($Berminat / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusTidakBerminat =  $dataleads->count() > 0 ? number_format(($TidakBerminat / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusTidakTerhubung =  $dataleads->count() > 0 ? number_format(($TidakTerhubung / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusNoTelpTidakValid =  $dataleads->count() > 0 ? number_format(($NoTelpTidakValid / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusDiskusiInternal =  $dataleads->count() > 0 ? number_format(($DiskusiInternal / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusCallAgain =  $dataleads->count() > 0 ? number_format(($CallAgain / $dataleads->count()) * 100, 1) : 0;
       
    $weeklyData = [];

    $today = Carbon::now();
    $endOfMonth = $today->endOfMonth();
    $currentWeekStart = $today->copy()->startOfMonth();  
    $weekCount = 0;
    
    while ($currentWeekStart->lte($endOfMonth)) {
        $currentWeekEnd = $currentWeekStart->copy()->addDays(6)->endOfDay(); // Akhir minggu adalah 9 hari setelah awal minggu
    
        // Check if the week contains the 22nd day
        $contains22ndDay = $currentWeekStart->lte($today) && $currentWeekEnd->gte($today->copy()->setDay(22));
    
        if ($contains22ndDay) {
            $currentWeekEnd = $endOfMonth;
        } elseif ($currentWeekEnd->gt($endOfMonth)) {
            $currentWeekEnd = $endOfMonth;
        }
    
        $weekCount++;
    
        // Check if it's beyond the 4th week, and if so, break out of the loop
        if ($weekCount > 4) {
            break;
        }
    
        $weeklyData[] = [
            'start_date' => $currentWeekStart->toDateString(),
            'end_date' => $currentWeekEnd->toDateString(),
            'totalBerminat' => DataLeads::whereIn('status', ['Berminat', 'Diskusi Internal'])
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),
            'totalContacted' => DataLeads::whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat', 'Call Again', 'Closing'])
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),
            'totalClosing' => DataLeads::where('status', 'Closing')
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),

        ];
    
        $currentWeekStart->addDays(7); // Pindah ke minggu berikutnya (10 hari untuk memastikan selalu melewati akhir bulan)
    }
    
    // Modifikasi indeks array
    $weeklyData = array_combine(range(1, count($weeklyData)), array_values($weeklyData));


    $weeklyDataStatus = [];

    $today = Carbon::now();
    $endOfMonth = $today->endOfMonth();
    $currentWeekStart = $today->copy()->startOfMonth();  
    $weekCount = 0;
    
    while ($currentWeekStart->lte($endOfMonth)) {
        $currentWeekEnd = $currentWeekStart->copy()->addDays(6)->endOfDay(); // Akhir minggu adalah 9 hari setelah awal minggu
    
        // Check if the week contains the 22nd day
        $contains22ndDay = $currentWeekStart->lte($today) && $currentWeekEnd->gte($today->copy()->setDay(22));
    
        if ($contains22ndDay) {
            $currentWeekEnd = $endOfMonth;
        } elseif ($currentWeekEnd->gt($endOfMonth)) {
            $currentWeekEnd = $endOfMonth;
        }
    
        $weekCount++;
    
        // Check if it's beyond the 4th week, and if so, break out of the loop
        if ($weekCount > 4) {
            break;
        }
    
        $weeklyDataStatus[] = [
            'start_date' => $currentWeekStart->toDateString(),
            'end_date' => $currentWeekEnd->toDateString(),
            'Berminat' => DataLeads::where('status','Berminat')
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),
            'TidakBerminat' => DataLeads::where('status','Tidak Berminat')
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),
            'TidakTerhubung' => DataLeads::where('status', 'Tidak Terhubung')
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),

                'NoTelpTidakValid' => DataLeads::where('status', 'No. Telp Tidak Valid')
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),
                'DiskusiInternal' => DataLeads::where('status', 'Diskusi Internal')
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),

                'CallAgain' => DataLeads::where('status',  'Call Again')
                ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
                ->count(),

        ];
    
        $currentWeekStart->addDays(7); // Pindah ke minggu berikutnya (10 hari untuk memastikan selalu melewati akhir bulan)
    }
    
    // Modifikasi indeks array
    $weeklyDataStatus = array_combine(range(1, count($weeklyDataStatus)), array_values($weeklyDataStatus));
    
   
   

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
        'totalClosing' => $totalClosing,
       'Berminat' => $Berminat,
        'TidakBerminat' => $TidakBerminat,
        'TidakTerhubung' => $TidakTerhubung,
        'NoTelpTidakValid' => $NoTelpTidakValid,
        'DiskusiInternal' => $DiskusiInternal,
        'CallAgain' => $CallAgain,
       'persentaseStatusBerminat' =>$persentaseStatusBerminat,
       'persentaseStatusCallAgain' => $persentaseStatusCallAgain,
        'persentaseStatusDiskusiInternal'=> $persentaseStatusDiskusiInternal,
       'persentaseStatusNoTelpTidakValid' =>$persentaseStatusNoTelpTidakValid,
       'persentaseStatusTidakBerminat'=> $persentaseStatusTidakBerminat,
       'persentaseStatusTidakTerhubung'=>$persentaseStatusTidakTerhubung,
       'totalBerminat' => $totalBerminat,
       'totalNotCall' => $totalNotCall,
       'totalContacted' => $totalContacted,
       'persentaseNotCall' =>  $persentaseNotCall,
       'totalUnContacted' => $totalUnContacted,
       'persentaseUnContacted' => $persentaseUnContacted,

       'totalUnContactedPerKCU' => $totalUnContactedPerKCU,
       'totalNotCallPerKCU' => $totalNotCallPerKCU,

       'weeklyDataStatus' => $weeklyDataStatus,

       'totalStatusBerminatPerKCU' => $totalStatusBerminatPerKCU,
       'totalStatusTidakBerminatPerKCU' => $totalStatusTidakBerminatPerKCU,
       'totalStatusTidakTerhubungPerKCU' => $totalStatusTidakTerhubungPerKCU,
       'totalStatusNoTelpTidakValidPerKCU' => $totalStatusNoTelpTidakValidPerKCU,
       'totalStatusDiskusiInternalPerKCU' => $totalStatusDiskusiInternalPerKCU,
       'totalStatusCallAgainPerKCU' => $totalStatusCallAgainPerKCU,
    
        
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
    $endOfWeek = $today->copy()->endOfWeek();    

    

    $dataLeads = DataLeads::where('tanggal_awal', '>=', $startOfWeek)
    ->where('tanggal_awal', '<=', $endOfWeek)
    ->get();

    $today = Carbon::now();
    $startOfMonth = $today->startOfMonth();
    
    $endOfMonth = $today->copy()->endOfMonth();
    
    $dataleads = DataLeads::where('data_tanggal', '>=', $startOfMonth)
        ->where('data_tanggal', '<=', $endOfMonth)
        ->get();

        if ($tanggalawal && $tanggalakhir) {
            // Filter berdasarkan range tanggal
            $dataleads = DataLeads::whereBetween('data_tanggal', [$tanggalawal, $tanggalakhir]);
        
            $dataleads = DataLeads::where('data_tanggal', '>=', $tanggalawal)
                ->where('data_tanggal', '<=', $tanggalakhir);
        
            $startOfMonth = Carbon::parse($tanggalawal)->startOfMonth();
                       
            $endOfMonth = Carbon::parse($tanggalakhir)->endOfMonth();
        
            // Check if the selected date range is exactly one year          
        
            // If the selected date range is not one year, continue with the weekly data calculation
            $currentWeekStart = Carbon::parse($tanggalawal)->startOfMonth();            
            
            // $currentWeekEnd = Carbon::parse($tanggalakhir)->endOfMonth()->endOfWeek();
        
            // ...
        } else {
        
            // Jika salah satu atau kedua tanggal tidak diisi, tetap gunakan filter tanggal bulan ini
            $today = Carbon::now();
            $startOfMonth = $today->startOfMonth();
            $endOfMonth = $today->copy()->endOfMonth();

            $today = Carbon::now();
            $endOfMonth = $today->endOfMonth();
            $currentWeekStart = $today->copy()->startOfMonth();  
        
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
        $totalBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->whereIn('status', ['Berminat',  'Diskusi Internal'])->count();
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

    $totalUnContactedPerKCU = [];
    foreach ($kcu as $item) {
        $totalUnContactedPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->whereIn('status',['Tidak Terhubung', 'No. Telp Tidak Valid'])->count();
    }

    $totalNotCallPerKCU = [];
    foreach ($kcu as $item) {
        $totalNotCallPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Belum Dikerjakan')->count();
    }


    $totalStatusBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Berminat')->count();
    }
    
    

    $totalStatusTidakBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusTidakBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Tidak Berminat')->count();
    }

   
    
    $totalStatusTidakTerhubungPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusTidakTerhubungPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Tidak Terhubung')->count();
    }
    
    $totalStatusNoTelpTidakValidPerKCU = [];
    foreach ($kcu as $item) {        
    $totalStatusNoTelpTidakValidPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','No. Telp Tidak Valid')->count();
    }
    
    $totalStatusDiskusiInternalPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusDiskusiInternalPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Diskusi Internal')->count();
    }

    $totalStatusCallAgainPerKCU = [];
    foreach ($kcu as $item) {
        $totalStatusCallAgainPerKCU [$item->id] = $dataleads->where('kcu', $item->id)->where('status','Call Again')->count();
    }
    
    

    $totalBerminat = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal'])->count();

$persentaseBerminat = $dataleads->count() > 0 ? number_format(($totalBerminat / $dataleads->count()) * 100, 1) : 0;

$totalContacted = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat','Call Again', 'Closing'])->count();

$persentaseContacted = $dataleads->count() > 0 ? number_format(($totalContacted / $dataleads->count()) * 100, 1) : 0;

$totalClosing = $dataleads->where('status', 'Closing')->count();

$persentaseClosing = $dataleads->count() > 0 ? number_format(($totalClosing / $dataleads->count()) * 100, 1) : 0;

$totalNotCall = $dataleads->where('status', 'Belum Dikerjakan')->count();


    $persentaseNotCall = $dataleads->count() > 0 ? number_format(($totalNotCall / $dataleads->count()) * 100, 1) : 0;

    $totalUnContacted = $dataleads->where('status', ['Tidak Terhubung', 'No. Telp Tidak Valid'])->count();
$persentaseUnContacted =  $dataleads->count() > 0 ? number_format(($totalUnContacted / $dataleads->count()) * 100, 1) : 0;

$Berminat = $dataleads->where('status', 'Berminat')->count();
$TidakBerminat = $dataleads->where('status', 'Tidak Berminat')->count();
$TidakTerhubung = $dataleads->where('status', 'Tidak Terhubung')->count();
$NoTelpTidakValid = $dataleads->where('status', 'No. Telp Tidak Valid')->count();
$DiskusiInternal = $dataleads->where('status', 'Diskusi Internal')->count();
$CallAgain = $dataleads->where('status', 'Call Again')->count();


$persentaseStatusBerminat = $dataleads->count() > 0 ? number_format(($Berminat / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusTidakBerminat =  $dataleads->count() > 0 ? number_format(($TidakBerminat / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusTidakTerhubung =  $dataleads->count() > 0 ? number_format(($TidakTerhubung / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusNoTelpTidakValid =  $dataleads->count() > 0 ? number_format(($NoTelpTidakValid / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusDiskusiInternal =  $dataleads->count() > 0 ? number_format(($DiskusiInternal / $dataleads->count()) * 100, 1) : 0;
$persentaseStatusCallAgain =  $dataleads->count() > 0 ? number_format(($CallAgain / $dataleads->count()) * 100, 1) : 0;
       
$isOneYearRange = Carbon::parse($tanggalawal)->diffInMonths($endOfMonth) === 11;
        
if ($isOneYearRange) {

    $selectedKCU = $request->input('kcu');
    $selectedJenis = $request->input('jenis_data');
    // If the selected date range is exactly one year, display data monthly
    $monthlyData = [];

    $currentMonthStart = Carbon::parse($tanggalawal)->startOfMonth();
    $currentMonthEnd = $currentMonthStart->copy()->endOfMonth();

    while ($currentMonthStart->lte($endOfMonth)) {
        $monthName = $currentMonthStart->format('F'); // Ambil nama bulan

        $monthlyData[$monthName]  = [
            'monthName'=> $monthName,
           'totalBerminat' => DataLeads::whereIn('status', ['Berminat', 'Diskusi Internal'])
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),
            'totalContacted' => DataLeads::whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat', 'Call Again', 'Closing'])
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),
            'totalClosing' => DataLeads::where('status', 'Closing')
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),
        ];
    
        $currentMonthStart->addMonth();
        $currentMonthEnd = $currentMonthStart->copy()->endOfMonth();

    }
    
    // Modifikasi indeks array
    $monthlyData = array_values($monthlyData);


    $monthlyDataStatus = [];

    $currentMonthStart = Carbon::parse($tanggalawal)->startOfMonth();
    $currentMonthEnd = $currentMonthStart->copy()->endOfMonth();

    while ($currentMonthStart->lte($endOfMonth)) {
        $monthName = $currentMonthStart->format('F'); // Ambil nama bulan

        $monthlyDataStatus[$monthName]  = [
            'monthName'=> $monthName,
           'Berminat' => DataLeads::where('status', 'Berminat')
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),
          
                'TidakBerminat' => DataLeads::where('status', 'Tidak Berminat')
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),

                'TidakTerhubung' => DataLeads::where('status', 'Tidak Terhubung')
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),

                'NoTelpTidakValid' => DataLeads::where('status', 'No. Telp Tidak Valid')
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),

                'DiskusiInternal' => DataLeads::where('status', 'Diskusi Internal')
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),

                'CallAgain' => DataLeads::where('status', 'Call Again')
                ->when($selectedKCU, function ($query) use ($selectedKCU) {
                    return $query->where('kcu', $selectedKCU);
                })
                ->when($selectedJenis, function ($query) use ($selectedJenis) {
                    return $query->where('jenis_data', $selectedJenis);
                })
                ->whereBetween('data_tanggal', [$currentMonthStart, $currentMonthEnd])
                ->count(),
        ];
    
        $currentMonthStart->addMonth();
        $currentMonthEnd = $currentMonthStart->copy()->endOfMonth();

    }
    
    // Modifikasi indeks array
    $monthlyDataStatus = array_values($monthlyDataStatus);
    


    session()->put('selectedJenis', $selectedJenis);
session()->put('selectedKCU', $selectedKCU);
session()->put('tanggalAwal', $tanggalawal);
session()->put('tanggalAkhir', $tanggalakhir);
    return view('dashboard', [
        'dataleads' => $dataleads,
        'kcu' => $kcu,
        'monthlyData' => $monthlyData,
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
        'totalClosing' => $totalClosing,
        'Berminat' => $Berminat,
         'TidakBerminat' => $TidakBerminat,
         'TidakTerhubung' => $TidakTerhubung,
         'NoTelpTidakValid' => $NoTelpTidakValid,
         'DiskusiInternal' => $DiskusiInternal,
         'CallAgain' => $CallAgain,
        'persentaseStatusBerminat' =>$persentaseStatusBerminat,
        'persentaseStatusCallAgain' => $persentaseStatusCallAgain,
         'persentaseStatusDiskusiInternal'=> $persentaseStatusDiskusiInternal,
        'persentaseStatusNoTelpTidakValid' =>$persentaseStatusNoTelpTidakValid,
        'persentaseStatusTidakBerminat'=> $persentaseStatusTidakBerminat,
        'persentaseStatusTidakTerhubung'=>$persentaseStatusTidakTerhubung,
        'totalBerminat' => $totalBerminat,
        'totalNotCall' => $totalNotCall,
        'totalContacted' => $totalContacted,
        'persentaseNotCall' =>  $persentaseNotCall,
        'totalUnContacted' => $totalUnContacted,
        'persentaseUnContacted' => $persentaseUnContacted,
        'totalUnContactedPerKCU' => $totalUnContactedPerKCU,
        'totalNotCallPerKCU' => $totalNotCallPerKCU,
        'monthlyDataStatus' =>$monthlyDataStatus,
     
        'totalStatusBerminatPerKCU' => $totalStatusBerminatPerKCU,
        'totalStatusTidakBerminatPerKCU' => $totalStatusTidakBerminatPerKCU,
        'totalStatusTidakTerhubungPerKCU' => $totalStatusTidakTerhubungPerKCU,
        'totalStatusNoTelpTidakValidPerKCU' => $totalStatusNoTelpTidakValidPerKCU,
        'totalStatusDiskusiInternalPerKCU' => $totalStatusDiskusiInternalPerKCU,
        'totalStatusCallAgainPerKCU' => $totalStatusCallAgainPerKCU,
     
        
    ]);
    
}

else {

$weeklyData = [];
$weekCount = 0;
while ($currentWeekStart->lte($endOfMonth)) {
    $currentWeekEnd = $currentWeekStart->copy()->addDays(6)->endOfDay(); // Akhir minggu adalah 9 hari setelah awal minggu

    // Check if the week contains the 22nd day
    $contains22ndDay = $currentWeekStart->lte($today) && $currentWeekEnd->gte($today->copy()->setDay(22));

    if ($contains22ndDay) {
        $currentWeekEnd = $endOfMonth;
    } elseif ($currentWeekEnd->gt($endOfMonth)) {
        $currentWeekEnd = $endOfMonth;
    }

    $weekCount++;

    // Check if it's beyond the 4th week, and if so, break out of the loop
    if ($weekCount > 4) {
        break;
    }

    $weeklyData[] = [
        'start_date' => $currentWeekStart->toDateString(),
        'end_date' => $currentWeekEnd->toDateString(),
       'totalBerminat' => DataLeads::whereIn('status', ['Berminat', 'Diskusi Internal']) 
       ->when($selectedKCU, function ($query) use ($selectedKCU) {
        return $query->where('kcu', $selectedKCU);
    })
    ->when($selectedJenis, function ($query) use ($selectedJenis) {
        return $query->where('jenis_data', $selectedJenis);
    })
    ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
    ->count(),

        'totalContacted' => DataLeads::whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat', 'Call Again', 'Closing'])
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
        ->count(),
        'totalClosing' => DataLeads::where('status', 'Closing')
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal', [$currentWeekStart, $currentWeekEnd])
        ->count(),

            
    ];

    $currentWeekStart->addDays(7); // Pindah ke minggu berikutnya (10 hari untuk memastikan selalu melewati akhir bulan)
}

// Modifikasi indeks array
$weeklyData = array_combine(range(1, count($weeklyData)), array_values($weeklyData));


$weeklyDataStatus = [];

$today = Carbon::now();
$endOfMonth = $today->endOfMonth();
$currentWeekStart = $today->copy()->startOfMonth();  
$weekCount = 0;

while ($currentWeekStart->lte($endOfMonth)) {
    $currentWeekEnd = $currentWeekStart->copy()->addDays(6)->endOfDay(); // Akhir minggu adalah 9 hari setelah awal minggu

    // Check if the week contains the 22nd day
    $contains22ndDay = $currentWeekStart->lte($today) && $currentWeekEnd->gte($today->copy()->setDay(22));

    if ($contains22ndDay) {
        $currentWeekEnd = $endOfMonth;
    } elseif ($currentWeekEnd->gt($endOfMonth)) {
        $currentWeekEnd = $endOfMonth;
    }

    $weekCount++;

    // Check if it's beyond the 4th week, and if so, break out of the loop
    if ($weekCount > 4) {
        break;
    }

    $weeklyDataStatus[] = [
        'start_date' => $currentWeekStart->toDateString(),
        'end_date' => $currentWeekEnd->toDateString(),
        'Berminat' => DataLeads::where('status', 'Berminat')
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal',[$currentWeekStart, $currentWeekEnd])
        ->count(),
  
        'TidakBerminat' => DataLeads::where('status', 'Tidak Berminat')
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal',[$currentWeekStart, $currentWeekEnd])
        ->count(),

        'TidakTerhubung' => DataLeads::where('status', 'Tidak Terhubung')
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal',[$currentWeekStart, $currentWeekEnd])
        ->count(),

        'NoTelpTidakValid' => DataLeads::where('status', 'No. Telp Tidak Valid')
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal',[$currentWeekStart, $currentWeekEnd])
        ->count(),

        'DiskusiInternal' => DataLeads::where('status', 'Diskusi Internal')
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal',[$currentWeekStart, $currentWeekEnd])
        ->count(),

        'CallAgain' => DataLeads::where('status', 'Call Again')
        ->when($selectedKCU, function ($query) use ($selectedKCU) {
            return $query->where('kcu', $selectedKCU);
        })
        ->when($selectedJenis, function ($query) use ($selectedJenis) {
            return $query->where('jenis_data', $selectedJenis);
        })
        ->whereBetween('data_tanggal',[$currentWeekStart, $currentWeekEnd])
        ->count(),

    ];

    $currentWeekStart->addDays(7); // Pindah ke minggu berikutnya (10 hari untuk memastikan selalu melewati akhir bulan)
}

// Modifikasi indeks array
$weeklyDataStatus = array_combine(range(1, count($weeklyDataStatus)), array_values($weeklyDataStatus));



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
    'weeklyData' => $weeklyData,
    'totalClosing' => $totalClosing,
    'Berminat' => $Berminat,
     'TidakBerminat' => $TidakBerminat,
     'TidakTerhubung' => $TidakTerhubung,
     'NoTelpTidakValid' => $NoTelpTidakValid,
     'DiskusiInternal' => $DiskusiInternal,
     'CallAgain' => $CallAgain,
    'persentaseStatusBerminat' =>$persentaseStatusBerminat,
    'persentaseStatusCallAgain' => $persentaseStatusCallAgain,
     'persentaseStatusDiskusiInternal'=> $persentaseStatusDiskusiInternal,
    'persentaseStatusNoTelpTidakValid' =>$persentaseStatusNoTelpTidakValid,
    'persentaseStatusTidakBerminat'=> $persentaseStatusTidakBerminat,
    'persentaseStatusTidakTerhubung'=>$persentaseStatusTidakTerhubung,
    'totalBerminat' => $totalBerminat,
    'totalNotCall' => $totalNotCall,
    'totalContacted' => $totalContacted,
    'persentaseNotCall' =>  $persentaseNotCall,
    'totalUnContacted' => $totalUnContacted,
    'persentaseUnContacted' => $persentaseUnContacted,
    'totalUnContactedPerKCU' => $totalUnContactedPerKCU,
    'totalNotCallPerKCU' => $totalNotCallPerKCU,
    'weeklyDataStatus' => $weeklyDataStatus,
    
    'totalStatusBerminatPerKCU' => $totalStatusBerminatPerKCU,
    'totalStatusTidakBerminatPerKCU' => $totalStatusTidakBerminatPerKCU,
    'totalStatusTidakTerhubungPerKCU' => $totalStatusTidakTerhubungPerKCU,
    'totalStatusNoTelpTidakValidPerKCU' => $totalStatusNoTelpTidakValidPerKCU,
    'totalStatusDiskusiInternalPerKCU' => $totalStatusDiskusiInternalPerKCU,
    'totalStatusCallAgainPerKCU' => $totalStatusCallAgainPerKCU,
 
    
]);

}




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
