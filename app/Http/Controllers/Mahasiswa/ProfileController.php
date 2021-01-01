<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            "nama"=>"required|string",
            "username"=>"required|string",
        ]);

        $user = Auth::user();

        if($request->password || $request->repassword){
            $request->validate([
                "password"=>"required|string|min:8",
                "repassword"=>"required|string|min:8"
            ]);
            if(!($request->password==$request->repassword)){
                return redirect()->back()->withErrors(['errors'=>'Password and Repassword must same'])->withInput();
            }
            $user->password = Hash::make($request->password);
        }

        $user->nama = $request->nama;
        $user->username = $request->username;

        $user->save();
        
        return redirect()->back()->with('success', 'Profile Updated');
    }
}
