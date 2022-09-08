<?php

namespace App\Http\Livewire\Site\Reports;

use App\Models\Book;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DataTableReport extends Component
{
    public $searchItems=[];
    
    public function render()
    {
        $books = Book::whereHas('patient', function($query){
            if(isset($this->searchItems['gender'])){
                if($this->searchItems['gender'] != 3){
                    $query->where('gender', $this->searchItems['gender']);
                }
            }
        })->where(function($q){
            $q->where('doctor_id', Auth::user()->id);
            if(isset($this->searchItems['type'])){
                if($this->searchItems['type']==2){
                    $q->where('type', 'new');

                }
                if($this->searchItems['type']==3){
                    $q->where('type', 'resumption');
                }
            }
            
            if(isset($this->searchItems['startDate'])){
                $q->where('date', '>=', $this->searchItems['startDate']);
            }
            if(isset($this->searchItems['endDate'])){
                $q->where('date', '<=', $this->searchItems['endDate']);
            }
        })->get();

        $new_books = Book::whereHas('patient', function($query){
            if(isset($this->searchItems['gender'])){
                if($this->searchItems['gender'] != 3){
                    $query->where('gender', $this->searchItems['gender']);
                }
            }
        })->where(function($q){
            $q->where('doctor_id', Auth::user()->id);
            $q->where('type', 'new');
            
            if(isset($this->searchItems['startDate'])){
                $q->where('date', '>=', $this->searchItems['startDate']);
            }
            if(isset($this->searchItems['endDate'])){
                $q->where('date', '<=', $this->searchItems['endDate']);
            }
        })->get();

        $re_books = Book::whereHas('patient', function($query){
            if(isset($this->searchItems['gender'])){
                if($this->searchItems['gender'] != 3){
                    $query->where('gender', $this->searchItems['gender']);
                }
            }
        })->where(function($q){
            $q->where('doctor_id', Auth::user()->id);
            $q->where('type', 'resumption');
            
            if(isset($this->searchItems['startDate'])){
                $q->where('date', '>=', $this->searchItems['startDate']);
            }
            if(isset($this->searchItems['endDate'])){
                $q->where('date', '<=', $this->searchItems['endDate']);
            }
        })->get();

        if($this->searchItems == null){
            $male = Patient::whereHas('books', function($q){
                $q->where('doctor_id', Auth::user()->id);
            })->where('gender', 0)->count();
    
            $female = Patient::whereHas('books', function($q){
                $q->where('doctor_id', Auth::user()->id);
            })->where('gender', 1)->count();

            $all = Patient::whereHas('books', function($q){
                $q->where('doctor_id', Auth::user()->id);
            })->count();

            $new = $new_books->count();
            

            $resupmtion = $re_books->count();
        }

        $patients =  Patient::whereHas('books', function($q){
            $q->where('doctor_id', Auth::user()->id);

            if(isset($this->searchItems['type'])){
                if($this->searchItems['type']==2){
                    $q->where('type', 'new');
                }
                if($this->searchItems['type']==3){
                    $q->where('type', 'resumption');
                }
            }
            
            if(isset($this->searchItems['startDate'])){
                $q->where('date', '>=', $this->searchItems['startDate']);
            }
            if(isset($this->searchItems['endDate'])){
                $q->where('date', '<=', $this->searchItems['endDate']);
            }

        })->where(function ($query){
            if(isset($this->searchItems['gender'])){
                if($this->searchItems['gender'] != 3){
                    $query->where('gender', $this->searchItems['gender']);
                }
            }
        })->orderBy('id')->get();

        $patients_list =  Patient::whereHas('books', function($q){
            $q->where('doctor_id', Auth::user()->id);

            if(isset($this->searchItems['type'])){
                if($this->searchItems['type']==2){
                    $q->where('type', 'new');
                }
                if($this->searchItems['type']==3){
                    $q->where('type', 'resumption');
                }
            }
            
            if(isset($this->searchItems['startDate'])){
                $q->where('date', '>=', $this->searchItems['startDate']);
            }
            if(isset($this->searchItems['endDate'])){
                $q->where('date', '<=', $this->searchItems['endDate']);
            }

        })->where(function ($query){
            if(isset($this->searchItems['gender'])){
                if($this->searchItems['gender'] != 3 ){
                    $query->where('gender', $this->searchItems['gender']);
                }
            }
        })->orderBy('id')->paginate(40);

        

        if($this->searchItems != null){

            $male = $patients->where('gender', 0)->count();
    
            $female = $patients->where('gender', 1)->count();

            $all = $patients->count();

            $new = $new_books->count();
            
            $resupmtion = $re_books->count();

            if(isset($this->searchItems['type'])){
                if($this->searchItems['type']==2){
                    $new =  $books->count();
                    $resupmtion =  0;

                }
                if($this->searchItems['type']==3){
                    $new =  0;
                    $resupmtion =  $books->count();
                }

            }
        }

        $data = [
            'patients' => $patients_list,
            'male' => $male,
            'female' => $female,
            'all' => $all,
            'new' => $new,
            'resupmtion' => $resupmtion,
        ];

        return view('livewire.site.reports.data-table-report', $data)->extends('layouts.site.base')
        ->section('content');
    }

}
