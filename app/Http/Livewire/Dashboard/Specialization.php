<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Specializations;
use Livewire\Component;

class Specialization extends Component
{

    public $specializations, $name, $deleteIndex, $updateIndex;
    protected $listeners = ['remove'];

    public function mount(){
        $this->specializations = Specializations::all();
    }

    public function render()
    {
        return view('livewire.dashboard.specialization')->extends('layouts.dashboard.base')
        ->section('content');
    }

    public function add(){
        $data = $this->validate([
            'name' => 'required',
        ]);
        Specializations::create($data);
        $this->name='';
        $this->dispatchBrowserEvent('hide-form');
        $this->specializations = Specializations::all();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Added Successfully!',
        ]);
    }
    
    public function re_update($index){
        $this->name = $this->specializations[$index]->name;
        $this->updateIndex = $index;
        $this->dispatchBrowserEvent('update');
    }

    public function update($index){
        $this->specializations[$index]->name = $this->name;
        $this->specializations[$index]->save();
        $this->updateIndex='';
        $this->dispatchBrowserEvent('hide-form');
        $this->specializations = Specializations::all();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Updated Successfully!',
        ]);

    }
    public function alertConfirm($index)
    {
        $this->deleteIndex = $index;
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',  
                'message' => 'Are you sure delete '. $this->specializations[$index]->name . '?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function remove()
    {
        $this->specializations[$this->deleteIndex]->delete();
        $this->specializations = Specializations::all();
        $this->deleteIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
                // 'text' => 'It will not list on users table soon.'
        ]);

    }

}



