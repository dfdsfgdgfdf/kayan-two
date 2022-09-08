<?php

namespace App\Http\Livewire\Site\Examination\ResumptionComponent;

use App\Models\Book;
use App\Models\Diagonse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Diagnosis extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $patient_id, $deleteDiagnosisId , $updateFlage , $sigleDiagnois ;
    protected $listeners = [
        '$refresh', 'delete'
    ];
    protected $rules = [
        'sigleDiagnois.content' => ['required'],
    ];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }
    public function render()
    {
        $books = Book::where(['patient_id' => $this->patient_id ,  'doctor_id' => Auth::User()->id ])->whereIn('status', ['finished', 'accepted'])->pluck('id')->toArray();
        $list = Diagonse::whereIn('book_id', $books)->orderBy('id', 'DESC')->paginate(1,['*'],'diagonse');
        
        $data = [
            'diagnosis' => $list,
        ];
        return view('livewire.site.examination.resumption-component.diagnosis', $data);
    }

    public function update($id){
        $this->updateFlage = 1;
        $this->sigleDiagnois = Diagonse::find($id);
    }

    public function updateSave(){
        $this->sigleDiagnois->save();
        $this->updateFlage = 0;
        $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        $this->render();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Update Successfully!', 
        ]);

    }

    public function alertDeleteConfirm($id)
    {   
        $this->deleteDiagnosisId = $id;
        $this->dispatchBrowserEvent('swal:diagnosisDeleteConfirm', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function delete()
    {   
        Diagonse::where('id',$this->deleteDiagnosisId)->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Delete Successfully!', 
        ]);
        $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        $this->render();
    }
}
