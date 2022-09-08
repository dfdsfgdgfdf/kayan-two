<?php

namespace App\Http\Livewire\Site\Easy;

use App\Models\MedicalTest as MedicalTestModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class MedicalTest extends Component
{
    use WithFileUploads;
    public $medical_test , $booking_id , $data, $deleteTestIndex ,$updateIndex ,$updateFlag , $updatMedicalTest;
    protected $listeners = ['setBookingId' ,'deleteTest'];


    public function mount()
    {
        $this->data = MedicalTestModel::where(['type'=> 0, 'book_id' => $this->booking_id])->get();
        $this->medical_test = [
            'note' => ' '
        ];
        
    }

    public function render()
    {
        return view('livewire.site.easy.medical-test');
    }

    public function setBookingId($id){
        $this->booking_id = $id;
    }

    public function add()
    {
        $data = $this->validate([
            'medical_test.name' => 'required',
            'medical_test.file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'medical_test.note' =>'',
        ]);
        $imageName = time(). md5(uniqid()) .'.'.$this->medical_test['file']->extension();
        $this->medical_test['file'] = $this->medical_test['file']->storeAs('PatientMedicalTestImages', $imageName, 'public');
        $this->medical_test['type'] = 0;
        $this->medical_test['book_id'] = $this->booking_id;
        MedicalTestModel::create($this->medical_test);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => ' Added Successfully!',
        ]);
        $this->data = MedicalTestModel::where(['type'=> 0, 'book_id' => $this->booking_id])->get();
        $this->medical_test = [
            'note' => ' '
        ];

    }

    public function alertConfirm($index)
    {   
        $this->deleteTestIndex = $index;
        $this->dispatchBrowserEvent('swal:confirmDeleteTest', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function deleteTest()
    {
        $file_path = public_path('storage/'.$this->data[$this->deleteTestIndex]['file']);
        if(File::exists($file_path)){
            unlink($file_path);
        }
        $this->data[$this->deleteTestIndex]->delete();
        $this->data = MedicalTestModel::where(['type'=> 0, 'book_id' => $this->booking_id])->get();
        $this->deleteTestIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
        ]);
    }

    public function update($index)
    {
        $this->updateIndex = $index;
        $this->updatMedicalTest = [
            'name' => $this->data[$index]['name'],
            'note' => $this->data[$index]['note'],
        ];
        $this->updateFlag = 1;
    }

    public function saveUpdate()
    {
        try{
            $imageName = time(). md5(uniqid()) .'.'.$this->updatMedicalTest['file']->extension();
            $this->updatMedicalTest['file'] = $this->updatMedicalTest['file']->storeAs('PatientMedicalTestImages', $imageName, 'public');
            $file_path = public_path('storage/'.$this->data[$this->updateIndex]['file']);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            $this->data[$this->updateIndex]['name']= $this->updatMedicalTest['name'];
            $this->data[$this->updateIndex]['note'] = $this->updatMedicalTest['note'];
            $this->data[$this->updateIndex]['file'] = $this->updatMedicalTest['file'];

        } catch (\Exception $e) {
            $this->data[$this->updateIndex]['name']= $this->updatMedicalTest['name'];
            $this->data[$this->updateIndex]['note'] = $this->updatMedicalTest['note'];
        }
        $this->data[$this->updateIndex]->save();
        $this->updateFlag = 0;
        $this->data = MedicalTestModel::where(['type'=> 0, 'book_id' => $this->booking_id])->get();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Updated Successfully!', 
        ]);
    }

    
}
