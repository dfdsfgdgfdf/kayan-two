<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\City;
use Livewire\Component;

class Cities extends Component
{
    public $cities, $name, $state, $deleteIndex;
    public $states=[
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
    protected $listeners = ['remove'];


    public function mount(){
        $this->cities = City::all();
    }

    public function render()
    {
        return view('livewire.dashboard.cities')->extends('layouts.dashboard.base')
        ->section('content');
    }

    public function add(){
        $data = $this->validate([
            'state' => 'required',
            'name' => 'required',
        ]);
        City::create($data);
        $this->name='';
        $this->state='';
        $this->dispatchBrowserEvent('hide-form');
        $this->cities = City::all();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Added Successfully!',
        ]);
    }

    public function alertConfirm($index)
    {
        $this->deleteIndex = $index;
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',  
                'message' => 'Are you sure delete '. $this->cities[$index]->name . '?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function remove()
    {
        $this->cities[$this->deleteIndex]->delete();
        $this->cities = City::all();
        $this->deleteIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!',
        ]);

    }
}
