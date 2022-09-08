<?php

namespace App\Http\Livewire\Site\Examination;

use App\Models\Book;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ExaminationList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchItem , $type;

    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        sleep(1);
        if($this->searchItem != ''){
            $books = Book::whereLike(['patient.name', 'patient.code','patient.age','date','type'], $this->searchItem)
            ->where(['type'=> $this->type ,'date' => Carbon::now()->toDateString(), "status" => "accepted", "doctor_id" => Auth::user()->id])->paginate(15);
        }else{
            $books = Book::with('patient')->where(['type'=> $this->type ,'date' => Carbon::now()->toDateString(), "status" => "accepted", 'arrive_status' => 1, "doctor_id" => Auth::user()->id])->paginate(15);
        }

        $data = [
            'books' => $books,
        ];
        return view('livewire.site.examination.examination-list', $data)->extends('layouts.site.base')
        ->section('content');
    }

}
