<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Helpers\Profiling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('mahasiswa.profile', [
            'user'=>Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $profiling = new Profiling;
        $profiling->update($request);
        
        return redirect()->back()->with('success', 'Profile Updated');
    }
}
