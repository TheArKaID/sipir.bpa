<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.index', [
            'kendaraans'=>$this->getKendaraan()
        ]);
    }

    public function getKendaraan()
    {
        return Kendaraan::where('mahasiswa_id', Auth::user()->id)->get();
    }
}
