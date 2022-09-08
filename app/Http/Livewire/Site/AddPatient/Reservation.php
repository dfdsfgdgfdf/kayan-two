<?php

namespace App\Http\Livewire\Site\AddPatient;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reservation extends Component
{
    
    public $patient_id, $new_reservation;
    protected $listeners = ['setPatientId'];

    public function mount(){
        $this->new_reservation['discount'] = 0;
        $this->new_reservation['date'] = date("Y-m-d");
        $this->new_reservation['time'] = date('h:i');
    }

    public function render()
    {
        return view('livewire.site.add-patient.reservation');
    }

    public function setPatientId($id){
        $this->patient_id = $id;
    }


    public function updatedNewReservationType(){
        $this->new_reservation['cost'] = Auth::user()->resumption_cost;
        if($this->new_reservation['type'] == 'new'){
            $this->new_reservation['cost'] = Auth::user()->new_cost;
        }
        $this->new_reservation['final_cost'] = $this->new_reservation['cost'];
    }

    public function updatedNewReservationCost(){
        $discount =(floatval($this->new_reservation['discount']) * floatval($this->new_reservation['cost']))/100;
        $this->new_reservation['final_cost'] = floatval($this->new_reservation['cost']) - floatval($discount);
    }

    public function updatedNewReservationDiscount(){
        $discount =(floatval($this->new_reservation['discount']) * floatval($this->new_reservation['cost']))/100;
        $this->new_reservation['final_cost'] = floatval($this->new_reservation['cost']) - floatval($discount);
    }

    public function reservation(){
        $data = $this->validate([
            'new_reservation.date' => 'required',
            'new_reservation.time' => 'required',
            'new_reservation.type' => 'required',
            'new_reservation.cost' =>'required',
            'new_reservation.final_cost' =>'required',
            'new_reservation.discount' =>'required',
        ],
        [
            'new_reservation.date.required' => 'required',
            'new_reservation.time.required' => 'required',
            'new_reservation.type.required' => 'required',
            'new_reservation.cost.required' => 'required',
            'new_reservation.discount.required' => 'required',
            'new_reservation.final_cost.required' => 'required',
        ]);
        $this->new_reservation['status'] = 'accepted'; 
        $this->new_reservation['patient_id'] = $this->patient_id; 
        $this->new_reservation['doctor_id'] = Auth::user()->id; 
        Book::create($this->new_reservation);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Reservation done Successfully!',
        ]);
        $this->patient_id = '';
        // $check = Book::where(['patient_id' => $this->patient_id , 'date' => Carbon::now()->format('Y-m-d')])->get();
        // if(count($check) > 0 ){
        //     $this->dispatchBrowserEvent('swal:modal', [
        //         'type' => 'error',  
        //         'message' => 'This Reservationa alerady found!',
        //     ]);
        // }else{
            
        // }


    }
}
