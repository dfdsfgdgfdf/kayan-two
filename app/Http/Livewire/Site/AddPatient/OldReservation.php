<?php

namespace App\Http\Livewire\Site\AddPatient;

use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OldReservation extends Component
{
    public $patients =[], $searchItem;
    protected $listeners = [
        '$refresh'
    ];


    public function render()
    {
        sleep(1);
        if($this->searchItem != ''){
            $this->patients = Patient::whereLike(['name', 'code','phone'], $this->searchItem)->get();
        }
        return view('livewire.site.add-patient.old-reservation')->extends('layouts.site.base')
        ->section('content');
    }

    

    public function add($id){
        $this->patients = Patient::where('id', $id)->get();
        $this->emit('setPatientId', $id);
    }
}
