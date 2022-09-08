<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    function check(Request $request){

        $request->validate([
           'phone'=>'required|exists:admins,phone',
           'password'=>'required|min:5|max:30',
           'remember_me'=>'nullable'
        ],[
            'phone.exists'=>'This phone is not exists in admins table'
        ]);

        $creds = $request->only('phone','password');
        $remember_me = $request->has('remember_me') ? true : false;

        if( Auth::guard('admin')->attempt($creds,$remember_me) ){
            return redirect()->route('dashboard.home');
        }else{
            return redirect()->route('dashboard.login')->with('fail','Incorrect credentials');
        }
    }

    function logout(Request $request){
        Auth::logout();
        return view('dashboard.login');
    }
}
