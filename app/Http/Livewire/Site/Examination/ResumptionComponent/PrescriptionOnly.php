<?php

namespace App\Http\Livewire\Site\Examination\ResumptionComponent;

use App\Models\Book;
use App\Models\Medicine;
use App\Models\Prescription;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PrescriptionOnly extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $medicin_search, $patient_id, $deleteId, $medicine_namesm, $updateFlag, $single ;
    protected $listeners = [
        '$refresh', 'delete'
    ];

    protected $rules = [
        'single.medicine.name' => ['required'],
        'single.dose' => ['required'],
        'single.time' => ['required'],
        'single.note' => ['required'],
    ];
    
    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
        

    }
    public function render()
    {
        $this->medicine_names = Medicine::all();
        $books = Book::where(['patient_id' => $this->patient_id , 'doctor_id' => Auth::User()->id ])->whereIn('status', ['finished', 'accepted'])->pluck('id')->toArray();
        
        $list = Prescription::whereIn('book_id', $books)->orderBy('id', 'DESC')->paginate(10);
        $data = [
            'prescription' => $list,
        ];
        return view('livewire.site.examination.resumption-component.prescription-only', $data);
    }

    public function update($id){
        $this->updateFlag=1;
        $this->single = Prescription::with('medicine')->find($id);
        $this->medicin_search = $this->single['medicine']['name'];
    }

    public function updateSave(){
        $medicin_id = Medicine::where('name' , $this->medicin_search)->first();
        if(!$medicin_id){
            $medicin_id = Medicine::insertGetId(['name'=>$this->medicin_search]);
            $this->single['medicine_id']= $medicin_id;
        }else{
            $this->single['medicine_id']= $medicin_id['id'];
        }
        $this->single->save();
        $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        $this->render();
        $this->updateFlag=0;
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Updated Successfully!', 
        ]);

    }

    

    public function alertDeleteConfirm($id)
    {   
        $this->deleteId = $id;
        $this->dispatchBrowserEvent('swal:DeletePreConfirm', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function delete()
    {   
        Prescription::where('id',$this->deleteId)->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Delete Successfully!', 
        ]);
        $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        $this->render();
    }

    public function updatedMedicinSearch(){
        $this->medicine_names = Medicine::where('name', 'like', '%' . $this->medicin_search . '%')->get();
    }

}
