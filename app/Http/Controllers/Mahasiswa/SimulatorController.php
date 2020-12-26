<?php

namespace App\Http\Controllers\Mahasiswa;

use App\History;
use App\Http\Controllers\Controller;
use App\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SimulatorController extends Controller
{
    public function index()
    {
        return view('mahasiswa.simulator', [
            'kendaraan'=>$this->getKendaraan()
        ]);
    }

    public function getKendaraan()
    {
        return Kendaraan::where('mahasiswa_id', Auth::user()->id)->get();
    }

    public function parkir(Request $request)
    {
        $request->validate([
            "tipe"=>"required|numeric|digits_between:0,1",
            "id"=>"required|numeric",
        ]);

        $kendaraan = Kendaraan::find($request->id);
        if(!$kendaraan || $kendaraan->mahasiswa_id!=Auth::user()->id) {
            return redirect()->back();
        }

        $lastH = History::where('kendaraan_id', $request->id)->orderBy('waktu', 'desc')->first();
        if($lastH) {
            // Check apakah sudah Parkir dan ingin parkir lagi
            if($lastH->kendaraan_id==$request->id && $lastH->tipe==1 && $request->tipe==1) {
                return redirect()->back()->withErrors('Maaf, Kendaraan sudah Diparkiran');
            }
            // Check apakah belum Parkir dan ingin keluar
            if($lastH->kendaraan_id==$request->id && $lastH->tipe==0 && $request->tipe==0) {
                return redirect()->back()->withErrors('Maaf, Kendaraan Tidak sedang Diparkiran');
            }
        }
        
        History::create([
            'kendaraan_id'=>$request->id,
            'tipe'=>$request->tipe,
            'waktu'=>Carbon::now()
        ]);

        $message = $request->tipe==1 ? 'Anda Masuk Parkiran' : 'Anda Keluar Parkiran';

        return redirect()->back()->with('success', $message);
    }
}
