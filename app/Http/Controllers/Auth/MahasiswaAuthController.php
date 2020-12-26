<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    public function login()
    {
        if(Auth::guard('mahasiswa')){
            return redirect(route('mahasiswa.app'));
        }
        return view('auth.m-login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $mahasiswa = Mahasiswa::where('username', $request->username)->first();
        if($mahasiswa){
            if(Hash::check($request->password, $mahasiswa->password)){
                Auth::guard('mahasiswa')->login($mahasiswa);
                $request->session()->regenerate();
                $this->clearLoginAttempts($request);
                return redirect(route('mahasiswa.app'));
            }
        }else {
            $this->incrementLoginAttempts($request);
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['username' => "Username atau Password anda Salah!"]);
        }
    }
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
}
