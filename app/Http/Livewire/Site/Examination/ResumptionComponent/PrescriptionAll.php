<?php

namespace App\Http\Livewire\Site\Examination\ResumptionComponent;

use App\Models\Book;
use App\Models\Diagonse;
use App\Models\MedicalTest;
use App\Models\Prescription;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;



class PrescriptionAll extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $patient_id, $book_id ,$all_book, $all_diagonse, $all_prescriptions = [], $all_medicalRadiology= [],$all_medicalTest =[], $all_prescription_setting;
    protected $listeners = [
        '$refresh'
    ];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
        $this->prescription_setting = Auth::User()->prescription_setting;
        $this->render();
    }
    public function render()
    {
        $books = Book::with('diagonse')->with('prescriptions')->with('medicalTests')->with('medicalRadiologies')->where(['patient_id' => $this->patient_id , 'doctor_id' => Auth::User()->id ])->whereIn('status', ['finished', 'accepted'])->
        where(function ($query) {
            $query->has('diagonse')->orHas('prescriptions')->orHas('medicalTests')->orHas('medicalRadiologies');
        })->orderBy('id', 'DESC')->paginate(3,['*'],'prescription');
        $data = [
            'books' => $books,
        ];
        return view('livewire.site.examination.resumption-component.prescription-all', $data);
    }

    public function showModel($book_id){
        $this->book_id = $book_id;
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
