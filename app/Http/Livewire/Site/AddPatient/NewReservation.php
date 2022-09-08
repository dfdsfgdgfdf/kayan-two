<?php

namespace App\Http\Livewire\Site\AddPatient;

use Livewire\Component;

class NewReservation extends Component
{
    public function mount(){
        
    }

    public function render()
    {
        return view('livewire.site.add-patient.new-reservation')->extends('layouts.site.base')
        ->section('content');
    }
}
