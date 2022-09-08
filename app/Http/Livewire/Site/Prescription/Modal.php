<?php

namespace App\Http\Livewire\Site\Prescription;

use App\Models\Book;
use App\Models\Diagonse;
use App\Models\MedicalTest;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{
    public $book_id ,$all_book, $all_diagonse, $all_prescriptions = [], $all_medicalRadiology= [],$all_medicalTest =[], $all_prescription_setting;
    protected $listeners = ['refreshModal' => 'mount'];

    public function mount($book_id = 0){
        $this->book_id = $book_id;

    }

    public function render()
    {
        return view('livewire.site.prescription.modal');
    }

    public function showModel(){
        $this->all_book = Book::find($this->book_id);
        $this->all_prescriptions = Prescription::where('book_id',$this->book_id)->get();
        $this->all_medicalRadiology = MedicalTest::where(['type'=> 1, 'book_id' => $this->book_id])->get();
        $this->all_medicalTest = MedicalTest::where(['type'=> 0, 'book_id' => $this->book_id])->get();
        $this->all_prescription_setting = Auth::User()->prescription_setting;
        $this->all_diagonse = Diagonse::where('book_id', $this->book_id)->first();
        if($this->all_diagonse){ $this->diagnosisInfo = $this->all_diagonse['content'];}
        $this->dispatchBrowserEvent('show-model');

    }
}
