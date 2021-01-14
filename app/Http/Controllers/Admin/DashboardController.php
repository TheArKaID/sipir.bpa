<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mahasiswa;

/**
 * Implementing Polymorphism with Reportable
 */
class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        // @php
        $vehicles = 0;
        $histories = 0;
        $mahasiswa = 0;
        $parked = 0;
        
        $allmahasiswa = $this->getMahasiswa();
        foreach ($allmahasiswa as $m) {
            $mahasiswa++;
            foreach ($m->kendaraans as $k) {
                $parkedCount = 0;
                $vehicles++;
                foreach ($k->histories as $h) {
                    $histories++;
                }
                $isParked = $k->getIsParked();
                if($isParked && $parkedCount==0){
                    $parked++;
                    $parkedCount++;
                }
            }
        }
        return view('admin.dashboard', [
            'mahasiswa'=>$mahasiswa,
            'vehicles'=>$vehicles,
            'histories'=>$histories,
            'parked'=>$parked
        ]);
    }

    /**
     * Mengambil data semua mahasiswa
     * 
     * @return \Illuminate\Database\Eloquent\Collection|[]
     */
    public function getMahasiswa()
    {
        return Mahasiswa::all();
    }
}
