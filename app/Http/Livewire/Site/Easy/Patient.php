<?php

namespace App\Http\Livewire\Site\Easy;

use App\Models\Patient as ModelsPatient;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Patient extends Component
{
    use WithPagination ;
    protected $paginationTheme = 'bootstrap';

    public $searchItem;

    public function render()
    {
        sleep(1);
        if($this->searchItem != ''){
            $patients = ModelsPatient::whereHas('books', function($q){
                $q->where('doctor_id' , Auth::user()->id);
                })->whereLike(['code', 'name','phone'], $this->searchItem)->where('easy','1')->latest()
                ->paginate(10);
        }else{
            $patients = ModelsPatient::whereHas('books', function($q){
                $q->where('doctor_id' , Auth::user()->id);
                })->where('easy','1')->latest()->paginate(10);
        }

        $data = [
            'patients' => $patients
        ];
        return view('livewire.site.easy.patient', $data)->extends('layouts.site.base')
        ->section('content');
    }
}
