<?php

namespace App\Http\Controllers;

use App\Models\DataKCU;
use App\Models\DataLeads;
use Illuminate\Http\Request;

class KCUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kcu = DataKCU::orderBy('created_at', 'desc')->get();
        return view('kcu.index',[
            'kcu' => $kcu,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kcu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DataKCU::create([
            'nama_kcu' => $request->nama_kcu,
           
        ]);

        $request->session()->flash('success',  'KCU berhasil ditambahkan');
    
        return redirect(route('kcu.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $data = DataKCU::find($id);
        return view('kcu.edit',[
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
        $data = DataKCU::find($id);
        $data->nama_kcu = $request->nama_kcu;

        $data->save();

        $request->session()->flash('success', "Akun User berhasil diupdate");
    
        return redirect(route('kcu.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $kcu = DataKCU::find($id);

        if (DataLeads::where('kcu', $kcu->id)->exists()) {
            $request->session()->flash('error', "Tidak dapat menghapus KCU, karena masih ada data leads yang berhubungan.");
            return redirect()->route('kcu.index');
        }

        $kcu->delete();
        
        $request->session()->flash('error', "KCU berhasil dihapus.");
        
        return redirect()->route('kcu.index');
        
    }
}
