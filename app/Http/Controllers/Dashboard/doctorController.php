<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;


class doctorController extends Controller
{
    public function show($flag)
    {
        return view('dashboard.doctors',[
            'flag' => $flag,
        ]);
    }



}
