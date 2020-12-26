<?php

namespace App\Http\Controllers;

use App\Kendaraan;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = $this->getMahasiswa();
        return view('admin.mahasiswa.index', [
            'mahasiswa'=>$mahasiswa
        ]);
    }

    public function getMahasiswa()
    {
        return Kendaraan::all();
    }

    public function tambah(Request $request)
    {
        $request->validate([
            "nama"=>"required|string",
            "nim"=>"required|numeric|digits:11",
            "email"=>"required|email",
            "username"=>"required|string",
            "password"=>"required|string|min:8",
            "repassword"=>"required|string|min:8"
        ]);

        if(!($request->password==$request->repassword)){
            return redirect()->back()->withErrors(['errors'=>'Password and Repassword must same'])->withInput();
        }
        
        Mahasiswa::create([
            'nama'=>$request->nama,
            'nim'=>$request->nim,
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>Hash::make($request->password)
        ]);
        
        return redirect()->back()->with('success', 'Mahasiswa Added');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if(!$mahasiswa) {
            return redirect()->back();
        }
        return view('admin.mahasiswa.detail', [
            'mahasiswa'=>$mahasiswa
        ]);
    }
}
