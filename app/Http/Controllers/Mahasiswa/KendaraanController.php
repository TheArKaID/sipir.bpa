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
        return view('mahasiswa.kendaraan.index', [
            'kendaraan'=>$this->getKendaraan()
        ]);
    }

    public function getKendaraan()
    {
        return Kendaraan::where('mahasiswa_id', Auth::user()->id)->get();
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

    public function detail($id)
    {
        $kendaraan = Kendaraan::find($id);
        if(!$kendaraan || $kendaraan->mahasiswa_id!=Auth::user()->id) {
            return redirect()->back();
        }

        return view('mahasiswa.kendaraan.detail', [
            'kendaraan'=>$kendaraan
        ]);
    }

    public function simpan($id, Request $request)
    {
        $kendaraan = Kendaraan::find($id);
        if(!$kendaraan || $kendaraan->mahasiswa_id!=Auth::user()->id) {
            return redirect()->back();
        }

        $request->validate([
            "jenis"=>"required|numeric|digits_between:1,2",
            "merk"=>"required|string",
            "nomor"=>"required|string",
        ]);

        $kendaraan->jenis = $request->jenis;
        $kendaraan->merk = $request->merk;
        $kendaraan->nomor = $request->nomor;
        
        $kendaraan->save();

        return redirect()->back()->with('success', 'Kendaraan Disimpan');
    }
}
