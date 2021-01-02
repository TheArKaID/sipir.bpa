<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Overloaded Class
 */
class Profiling {
    private $validation = [
        "nama"=>"required|string",
        "username"=>"required|string",
    ];

    private $user = [];

    /**
     * Overload the validation and user array
     */
    public function __set($name, $value)
    {
        $this->validation[$name] = 'required';
        $this->user[$name] = $value;
    }

    /**
     * Updating profile
     */
    public function update(Request $request)
    {
        $request->validate($this->validation);

        foreach ($request->only(['nama', 'username']) as $row => $data) {
            $this->user[$row] = $data;
        }

        if($request->password || $request->repassword){
            $request->validate([
                "password"=>"required|string|min:8",
                "repassword"=>"required|string|min:8"
            ]);
            if(!($request->password==$request->repassword)){
                return redirect()->back()->withErrors(['errors'=>'Password and Repassword must same'])->withInput();
            }
            $this->user['password'] = Hash::make($request->password);
        }

        Auth::user()->update($this->user);        
    }
}

?>