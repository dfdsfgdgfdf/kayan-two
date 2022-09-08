<?php

namespace App\Http\Livewire\Site\Easy;

use App\Models\Book;
use App\Models\City;
use App\Models\Diagonse;
use App\Models\MedicalTest;
use App\Models\Patient;
use App\Models\Prescription;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Add extends Component
{
    public $new_patient , $cities , $book, $booking_id = 0 , $state, $prescriptions, $medicalRadiology,$medicalTest, $prescription_setting;

    public function mount(){
        $this->cities = City::all();
        $this->states = City::STATE;
    }
    
    public function render()
    {
        return view('livewire.site.easy.add')->extends('layouts.site.base')
        ->section('content');
    }

    public function add(){
        $this->validate([
            'new_patient.name' => 'required',
            'new_patient.city_id' => 'required|exists:cities,id',
            'new_patient.phone' => 'required|unique:patients,phone',
            'new_patient.address' =>'required|max:1024',
            'new_patient.age' =>'required',
            'new_patient.gender' =>'required|in:0,1',
        ],
        [
            'new_patient.name.required' => 'required',
            'new_patient.phone.required' => 'required',
            'new_patient.phone.unique' => 'alrady found',
            'new_patient.city_id.required' => 'required',
            'new_patient.address.required' => 'required',
            'new_patient.age.required' => 'required',
            'new_patient.gender.required' => 'required',
        ]);
        $this->new_patient['easy'] = 1; 
        $city = City::find($this->new_patient['city_id']);
        $code = strval(substr($city->state, 0, 2)) . strval(substr($city->name, 0, 1)) . substr(uniqid(rand(), true), 8, 8);
        $old_p = Patient::where('code' , $code)->exists();
        while($old_p){
            $code = strval(substr($city->state, 0, 2)) . strval(substr($city->name, 0, 1)) . substr(uniqid(rand(), true), 8, 8);
            $old_p = Patient::where('code' , $code)->first();
        }
        $this->new_patient['code'] = $code;
        $this->new_patient['password'] = bcrypt($code);
        $pateint_id = Patient::insertGetId($this->new_patient);
        $this->booking_id = Book::insertGetId([ 
            'date' => Carbon::now()->toDateString(),
            'time' => Carbon::now()->toDateTimeString(),
            'type' => 'new',
            'patient_id' => $pateint_id,
            'doctor_id' =>  Auth::user()->id,
            'status' => 'finished',
        ]);
        $this->book = Book::find($this->booking_id);
        $this->prescriptions = Prescription::where('book_id',$this->booking_id)->get();
        $this->medicalRadiology = MedicalTest::where(['type'=> 1, 'book_id' => $this->booking_id])->get();
        $this->medicalTest = MedicalTest::where(['type'=> 0, 'book_id' => $this->booking_id])->get();
        $this->prescription_setting = Auth::User()->prescription_setting;
        $this->diagonse = Diagonse::where('book_id', $this->booking_id)->first();
        if($this->diagonse){ $this->diagnosisInfo = $this->diagonse['content'];}
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Patient Added Successfully!',
        ]);
        $this->dispatchBrowserEvent('show-code');
        $this->emit('setBookingId', $this->booking_id);
        $this->emit('refreshModal', $this->booking_id);
    }


    public function updatedState($value)
    {
        $this->cities = City::where('state', $value)->get();
    }

    public function show(){
        $this->book = Book::find($this->booking_id);
        $this->prescriptions = Prescription::where('book_id',$this->booking_id)->get();
        $this->medicalRadiology = MedicalTest::where(['type'=> 1, 'book_id' => $this->booking_id])->get();
        $this->medicalTest = MedicalTest::where(['type'=> 0, 'book_id' => $this->booking_id])->get();
        $this->prescription_setting = Auth::User()->prescription_setting;
        $this->diagonse = Diagonse::where('book_id', $this->booking_id)->first();
        if($this->diagonse){ $this->diagnosisInfo = $this->diagonse['content'];}
        $this->dispatchBrowserEvent('show');
    }


    
}
