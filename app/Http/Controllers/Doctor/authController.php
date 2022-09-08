<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class authController extends Controller
{
    function check(Request $request){

        $request->validate([
           'phone'=>'required|exists:doctors,phone',
           'password'=>'required|min:5|max:30',
           'remember_me'=>'nullable'
        ],[
            'phone.exists'=>'This phone is not exists'
        ]);
    
        $creds = $request->only('phone','password');
        $remember_me = $request->has('remember_me') ? true : false;

        if( Auth::guard('doctor')->attempt($creds,$remember_me) ){
            return redirect()->route('doctor.home');
        }else{
            return redirect()->route('doctor.login')->with('fail','Incorrect Info');
        }
    }

    function forgetPassword(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            return view('site.forgetPassword');
        }else{
            $request->validate([
                'email'=>'required|exists:doctors,email',
            ],[
                 'phone.exists'=>'This Email is not exists'
            ]);

            ### send email code
        }

        
    }

    function logout(Request $request){
        Auth::logout();
        return view('site.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
