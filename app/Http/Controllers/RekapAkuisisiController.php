<?php

namespace App\Http\Controllers;

use App\Imports\RekapAkuisisiImport;
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
       
        try {
            $file = $request->file('file');
            
            // Menggunakan import yang telah dibuat (DataLeadsImport)
            Excel::import(new RekapAkuisisiImport, $file);

            $request->session()->flash('success', 'Rekap Akuisisi berhasil diupload');
            
            return view('rekapcall.rekapcallindex');

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
        $request->session()->flash('error', 'Terjadi Kesalahan: ' . $errorMessage);
            
        return view('rekapcall.rekapcallindex');
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
