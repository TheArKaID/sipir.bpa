<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function index()
    {
        return view('mahasiswa.kendaraan.index');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            "jenis"=>"required|numeric|digits_between:1,2",
            "merk"=>"required|string",
            "nomor"=>"required|string",
        ]);

        Kendaraan::create([
            'mahasiswa_id'=>Auth::user()->id,
            'jenis'=>$request->jenis,
            'merk'=>$request->merk,
            'nomor'=>$request->nomor
        ]);
        
        return redirect()->back()->with('success', 'Kendaraan Ditambahkan');
    }
}
