<?php

namespace App\Http\Controllers;

use App\Models\DataKCU;
use App\Models\DataLeads;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardNewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now();
        $startOfMonth = $today->startOfMonth();
        
        $endOfMonth = $today->copy()->endOfMonth();
    
        $dataleads = DataLeads::where('data_tanggal', '>=', $startOfMonth)
            ->where('data_tanggal', '<=', $endOfMonth)
            ->get();

            $kcu = DataKCU::all();
            $totalBerminat = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal'])->count();
            $persentaseBerminat = $dataleads->count() > 0 ? number_format(($totalBerminat / $dataleads->count()) * 100, 1) : 0;
            $totalContacted = $dataleads->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat','Call Again'])->count();
            $persentaseContacted = $dataleads->count() > 0 ? number_format(($totalContacted / $dataleads->count()) * 100, 1) : 0;
            $totalNotCall = $dataleads->where('status', 'Belum Dikerjakan')->count();
            $persentaseNotCall = $dataleads->count() > 0 ? number_format(($totalNotCall / $dataleads->count()) * 100, 1) : 0;
            $totalUnContacted = $dataleads->whereIn('status', ['Tidak Terhubung', 'No. Telp Tidak Valid'])->count();
        $persentaseUnContacted =  $dataleads->count() > 0 ? number_format(($totalUnContacted / $dataleads->count()) * 100, 1) : 0;

            $totalBerminatPerKCU = [];
    foreach ($kcu as $item) {
        $totalBerminatPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->whereIn('status', ['Berminat',  'Diskusi Internal'])->count();
    }


    $totalContactedPerKCU = [];
    foreach ($kcu as $item) {
        $totalContactedPerKCU[$item->id] = $dataleads->where('kcu', $item->id)
            ->whereIn('status', ['Berminat', 'Diskusi Internal', 'Tidak Berminat', 'Call Again'])
            ->count();
    }

    

   


    $totalUnContactedPerKCU = [];
    foreach ($kcu as $item) {
        $totalUnContactedPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->whereIn('status',['Tidak Terhubung', 'No. Telp Tidak Valid'])->count();
    }

   

    $totalNotCallPerKCU = [];
    foreach ($kcu as $item) {
        $totalNotCallPerKCU[$item->id] = $dataleads->where('kcu', $item->id)->where('status','Belum Dikerjakan')->count();
    }
        return view('dashboardnew',[
            'dataleads' => $dataleads,
        'kcu' => $kcu,

        'totalBerminat' => $totalBerminat,
        'totalNotCall' => $totalNotCall,
        'totalContacted' => $totalContacted,
        'totalUnContacted' => $totalUnContacted,

        'persentaseUnContacted' => $persentaseUnContacted,
        'persentaseBerminat' => $persentaseBerminat, 
        'persentaseContacted' => $persentaseContacted,
        'persentaseNotCall' =>  $persentaseNotCall,

        'totalUnContactedPerKCU' => $totalUnContactedPerKCU,
       'totalNotCallPerKCU' => $totalNotCallPerKCU,
       'totalBerminatPerKCU' => $totalBerminatPerKCU,
       'totalContactedPerKCU' => $totalContactedPerKCU,

        ]);
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
