<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Book::where('doctor_id' , Auth::user()->id)->whereIn('status', ['finished', 'accepted'])->count();
        $today = Book::where('doctor_id' , Auth::user()->id)->where(['date' => Carbon::now()->toDateString()])->whereIn("status" , ['finished', 'accepted'])->count();
        $last_week = Book::where('doctor_id' , Auth::user()->id)->whereBetween("date" , [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->whereIn('status', ['finished', 'accepted'])->count();
        $last_mounth = Book::where('doctor_id' , Auth::user()->id)->whereMonth('date', Carbon::now()->month)->whereIn('status', ['finished', 'accepted'])->count();
        $female = Book::where('doctor_id' , Auth::user()->id)->whereMonth('date', Carbon::now()->month)->whereIn('status', ['finished', 'accepted'])->whereHas('patient', function($q){
            $q->where('gender','=',1);})->count();
        if($today != 0 ){
            $today_percantage = ($today / $all ) * 100 ;
        }else{
            $today_percantage = 0;
        }

        if($last_week != 0 ){
            $last_week_percantage = ($last_week / $all ) * 100 ;
        }else{
            $last_week_percantage = 0;
        }
        if($last_mounth != 0 ){
            $last_mounth_percantage = ($last_mounth / $all ) * 100 ;
        }else{
            $last_mounth_percantage = 0;
        }
        if($all != 0 ){
            $female_percanteg = ($female / $all )* 100; 
            $male_percanteg = 100 - $female_percanteg;
        }else{
            $female_percanteg = 0; 
            $male_percanteg = 0;
        }
        
        $date = [
            'new' => Book::where(['type'=> 'new' ,'date' => Carbon::now()->toDateString(), "doctor_id" => Auth::user()->id])->whereIn('status', ['finished', 'accepted'])->count(),
            're' => Book::where(['type'=> 'resumption' ,'date' => Carbon::now()->toDateString(),"doctor_id" => Auth::user()->id])->whereIn('status', ['finished', 'accepted'])->count(),
            'today_percantage' => $today_percantage,
            'last_week_percantage' => $last_week_percantage,
            'last_mounth_percantage' => $last_mounth_percantage,
            'female_percanteg' => $female_percanteg,
            'male_percanteg' => $male_percanteg,
        ];
        return view('site.home', $date);
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
