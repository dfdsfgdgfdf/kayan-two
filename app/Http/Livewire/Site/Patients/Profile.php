<?php

namespace App\Http\Livewire\Site\Patients;

use App\Models\Book;
use App\Models\City;
use App\Models\Patient;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Profile extends Component
{
    public $patient_id , $patient, $booking_id;

    protected $rules = [
        'patient.name' => ['required'],
        'patient.age' => ['required'],
        'patient.phone' => ['required'],
        'patient.city_id' => ['required'],
        'patient.address' => ['required'],
        'patient.gender' => ['required'],
    ];

    public function mount($id){
        $this->patient_id = $id ;
    }

    public function render()
    {
        $this->patient = Patient::find($this->patient_id);
        $last_exam = Book::select('date')->where(['doctor_id' => Auth::user()->id, 'patient_id' => $this->patient_id , 'status' => 'finished'])->latest('id')
        ->first();
        $data = [
            'patient' => $this->patient,
            'last_exam' => $last_exam,
            'cities' => City::all(),
        ];
        return view('livewire.site.patients.profile', $data)->extends('layouts.site.base')
        ->section('content');
    }

    public function reservation(){
        $check = Book::where(['doctor_id' => Auth::user()->id, 'patient_id' => $this->patient_id , 'date' => Carbon::now()->format('Y-m-d')])->latest()->first();
        if($check ){
            // $this->dispatchBrowserEvent('swal:modal', [
            //     'type' => 'error',  
            //     'message' => 'This Reservationa alerady found!',
            // ]);
            $this->booking_id = $check->id;
        }else{
            $this->booking_id = Book::insertGetId([ 
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->toDateTimeString(),
                'type' => 'resumption',
                'patient_id' => $this->patient_id,
                'doctor_id' =>  Auth::user()->id,
                'status' => 'accepted',
            ]);
        }
        return redirect(route('doctor.examination.resumption.details' , $this->booking_id));

    }

    public function updateInfo(){
        $this->patient->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Update Successfully!', 
        ]);
    }
}
