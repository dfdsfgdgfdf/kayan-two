<?php

namespace App\Http\Livewire\Site\Examination\ResumptionComponent;

use App\Models\Book;
use App\Models\MedicalTest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;


class MedicalRadiology extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $patient_id , $deleteId, $updateFlag, $singleRad, $file;
    protected $listeners = [
        '$refresh' , 'deleteRad'
    ];

    protected $rules = [
        'singleRad.name' => ['required'],
        'singleRad.note' => ['required'],
    ];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;

    }

    public function render()
    {
        $books = Book::where(['patient_id' => $this->patient_id , 'doctor_id' => Auth::User()->id ])->whereIn('status', ['finished', 'accepted'])->orderBy('id', 'DESC')->with('medicalRadiologies')->paginate(5,['*'],'medical-radiology');
        $data = [
            'books' => $books,
        ];
        return view('livewire.site.examination.resumption-component.medical-radiology', $data);
    }

    public function update($id){
        $this->updateFlag = 1;
        $this->singleRad = MedicalTest::where('id',$id)->first();
    }

    public function updateSave(){
        if ($this->file) {
            $imageName = time(). md5(uniqid()) .'.'.$this->file->extension();
            $file_path = public_path('storage/'.$this->singleRad['file']);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            $this->singleRad['file'] = $this->file->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
        }
        $this->singleRad->save();
        $this->updateFlag = 0;
        $this->file= '';
        $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        $this->render();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Update Successfully!', 
        ]);
    }

    public function alertDeleteConfirm($id)
    {   
        $this->deleteId = $id;
        $this->dispatchBrowserEvent('swal:DeleteConfirm', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function deleteRad()
    {   
        $single_data = MedicalTest::where('id',$this->deleteId)->first();
        $file_path = public_path('storage/'.$single_data['file']);
        if(File::exists($file_path)){
            unlink($file_path);
        }
        $single_data->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Delete Successfully!', 
        ]);
        $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        $this->render();
    }

}
