<?php

namespace App\Http\Livewire\Site\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class All extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchItem;

    public function render()
    {
        sleep(1);   
        if($this->searchItem != ''){
            $patients = Patient::whereHas('books', function($q){
                $q->where('doctor_id' , Auth::user()->id);
                })->whereLike(['code', 'name','phone'], $this->searchItem)->orderBy('id', 'DESC')->paginate(20);
        }else{
            $patients = Patient::whereHas('books', function($q){
                $q->where('doctor_id' , Auth::user()->id);
                })->orderBy('id', 'DESC')->paginate(20);
        }

        $data = [
            'patients' => $patients
        ];

        return view('livewire.site.patients.all', $data)->extends('layouts.site.base')
        ->section('content');
    }
}
