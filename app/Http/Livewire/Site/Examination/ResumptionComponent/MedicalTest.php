<?php

namespace App\Http\Livewire\Site\Examination\ResumptionComponent;

use App\Models\Book;
use App\Models\MedicalTest as ModelsMedicalTest;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;

class MedicalTest extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $patient_id , $deletetestId, $updateFlag, $singleTest, $file;
    protected $listeners = [
        '$refresh' , 'deleteTest'
    ];

    protected $rules = [
        'singleTest.name' => ['required'],
        'singleTest.note' => ['required'],
    ];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;

    }

    public function render()
    {
        $books = Book::with('medicalTests')->where(['patient_id' => $this->patient_id , 'doctor_id' => Auth::User()->id ])->whereIn('status', ['finished', 'accepted'])->orderBy('id' , 'DESC')->paginate(5,['*'],'medical-test');
        $data = [
            'books' => $books,
        ];
        return view('livewire.site.examination.resumption-component.medical-test',$data);
    }

    public function update($id){
        $this->updateFlag = 1;
        $this->singleTest = ModelsMedicalTest::where('id',$id)->first();
    }

    public function updateSave(){
        if ($this->file) {
            $imageName = time(). md5(uniqid()) .'.'.$this->file->extension();
            $file_path = public_path('storage/'.$this->singleTest['file']);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            $this->singleTest['file'] = $this->file->storeAs('PatientMedicalTestImages', $imageName, 'public');
        }
        $this->singleTest->save();
        $this->updateFlag = 0;
        $this->file= '';
        $this->emitTo(PrescriptionAll::class, '$refresh');
        $this->render();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Update Successfully!', 
        ]);
    }

    public function alertDeleteConfirm($id)
    {   
        $this->deletetestId = $id;
        $this->dispatchBrowserEvent('swal:DeleteTestConfirm', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function deleteTest()
    {   
        $single_data = ModelsMedicalTest::where('id',$this->deletetestId)->first();

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
