<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtUser = User::orderBy('created_at', 'desc')->get();

        return view('user.index',[
            'dtUser' => $dtUser,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
        ],
        [
            
            'username.unique' => 'Username sudah digunakan, masukan username lain',
           

        ]);
    
        // Membuat entri baru jika validasi sukses
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
    
        $request->session()->flash('success', 'Akun User berhasil ditambahkan');
    
        return redirect(route('user.index'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('user.edit',[
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
        $data = User::find($id);
        $data->nama = $request->nama;
        $data->username = $request->username;

        $data->save();

        $request->session()->flash('success', "Akun User berhasil diupdate");
    
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $useraccount = User::find($id);

            if ($useraccount->id === Auth::id()) {
                return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun anda sendiri.');
            

           
       
        }

        $useraccount->delete();

        $request->session()->flash('error', "Akun User Berhasil dihapus.");

        return redirect()->route('user.index');
    }

    public function resetPassword(User $user, Request $request)
{
    $user->update([
        'password' => Hash::make('12345678'), // Ganti 'password_awal' dengan password yang Anda inginkan
    ]);

    $request->session()->flash('success', 'Password berhasil direset');

    return redirect()->route('user.index');
}

}
