<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Profiling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile', [
            'user'=>Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $profiling = new Profiling;
        $profiling->email = $request->email;
        $profiling->update($request);
        
        return redirect()->back()->with('success', 'Profile Updated');
    }
}
