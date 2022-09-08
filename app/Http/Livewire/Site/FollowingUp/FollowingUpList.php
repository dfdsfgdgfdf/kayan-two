<?php

namespace App\Http\Livewire\Site\FollowingUp;

use App\Http\Livewire\Site\Easy\Patient;
use App\Models\Book;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class FollowingUpList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchItem;

    public function render()
    {
        // sleep(1);
        if($this->searchItem != ''){
            $books = Book::whereLike(['patient.name', 'patient.code','patient.age','date','type'], $this->searchItem)
            ->where(['date' => Carbon::now()->toDateString(), "status" => "accepted", "doctor_id" => Auth::user()->id])->paginate(15);
        }else{
            $books = Book::with('patient')->where(['date' => Carbon::now()->toDateString(), "status" => "accepted", "doctor_id" => Auth::user()->id])->paginate(15);
        }

        $data = [
            'books' => $books,
        ];
        return view('livewire.site.following-up.following-up-list', $data)->extends('layouts.site.base')
        ->section('content');
    }

    public function arriveStatus($id){
        $this->dispatchBrowserEvent('show-loder');
        $currunt_booking = Book::where('id' , $id)->first();
        $currunt_booking->arrive_status ? $currunt_booking->arrive_status = 0 : $currunt_booking->arrive_status = 1;
        $currunt_booking->save();
        $this->dispatchBrowserEvent('hide-loder');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => ' Changed Successfully!',
        ]);

    }

}
