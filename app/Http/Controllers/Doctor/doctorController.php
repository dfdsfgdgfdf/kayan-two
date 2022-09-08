<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class doctorController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $states=[
            'Alexandria',
            'Aswan',
            'Asyut',
            'Beheira',
            'Beni Suef',
            'Cairo',
            'Dakahlia',
            'Damietta',
            'Faiyum',
            'Gharbia',
            'Giza',
            'Ismailia',
            'Kafr ElSheikh',
            'Luxor',
            'Matruh',
            'Minya',
            'Monufia',
            'New Valley',
            'North Sinai',
            'Qalyubia',
            'Qena',
            'Red Sea',
            'Sharqia',
            'Sohag',
            'South Sinai',
            'Suez'
        ];
        return view('site.setting',[
            'cities' => $cities,
            'states' => $states
        ]);
    }

    public function prespiction_setting()
    {
        return view('site.prescriptionSetting');
    }

}
