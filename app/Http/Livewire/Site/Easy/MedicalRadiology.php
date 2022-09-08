<?php

namespace App\Http\Livewire\Site\Easy;

use App\Models\MedicalTest;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;


class MedicalRadiology extends Component
{
    use WithFileUploads;
    public $medical_radiology , $booking_id , $data, $deleteRadiologyIndex, $updateIndex ,$updateFlag , $updatMedicalRadiology;
    protected $listeners = ['setBookingId' ,'deleteRadiology'];


    public function mount()
    {
        $this->data = MedicalTest::where(['type'=> 1, 'book_id' => $this->booking_id])->get();
        $this->medical_radiology = [
            'note' => ' '
        ];
    }

    public function render()
    {
        return view('livewire.site.easy.medical-radiology');
    }

    public function setBookingId($id){
        $this->booking_id = $id;
    }

    public function add()
    {
        $data = $this->validate([
            'medical_radiology.name' => 'required',
            'medical_radiology.file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'medical_radiology.note' =>'',
        ]);
        $imageName = time(). md5(uniqid()) .'.'.$this->medical_radiology['file']->extension();
        $this->medical_radiology['file'] = $this->medical_radiology['file']->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
        $this->medical_radiology['type'] = 1;
        $this->medical_radiology['book_id'] = $this->booking_id;
        MedicalTest::create($this->medical_radiology);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => ' Added Successfully!',
        ]);
        $this->data = MedicalTest::where(['type'=> 1, 'book_id' => $this->booking_id])->get();
        $this->medical_radiology = [
            'note' => ' '
        ];

    }


    public function alertConfirm($index)
    {   
        $this->deleteRadiologyIndex = $index;
        $this->dispatchBrowserEvent('swal:confirmDeleteRadiology', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function deleteRadiology()
    {
        $file_path = public_path('storage/'.$this->data[$this->deleteRadiologyIndex]['file']);
        if(File::exists($file_path)){
            unlink($file_path);
        }
        $this->data[$this->deleteRadiologyIndex]->delete();
        $this->data = MedicalTest::where(['type'=> 1, 'book_id' => $this->booking_id])->get();
        $this->deleteRadiologyIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
        ]);
    }

    public function update($index)
    {
        $this->updateIndex = $index;
        $this->updatMedicalRadiology = [
            'name' => $this->data[$index]['name'],
            'note' => $this->data[$index]['note'],
        ];
        $this->updateFlag = 1;
    }

    public function saveUpdate()
    {
        try{
            $imageName = time(). md5(uniqid()) .'.'.$this->updatMedicalRadiology['file']->extension();
            $this->updatMedicalRadiology['file'] = $this->updatMedicalRadiology['file']->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
            $file_path = public_path('storage/'.$this->data[$this->updateIndex]['file']);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            $this->data[$this->updateIndex]['name']= $this->updatMedicalRadiology['name'];
            $this->data[$this->updateIndex]['note'] = $this->updatMedicalRadiology['note'];
            $this->data[$this->updateIndex]['file'] = $this->updatMedicalRadiology['file'];

        } catch (\Exception $e) {
            $this->data[$this->updateIndex]['name']= $this->updatMedicalRadiology['name'];
            $this->data[$this->updateIndex]['note'] = $this->updatMedicalRadiology['note'];
        }
        $this->data[$this->updateIndex]->save();
        $this->updateFlag = 0;
        $this->data = MedicalTest::where(['type'=> 1, 'book_id' => $this->booking_id])->get();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Updated Successfully!', 
        ]);
    }

    
}
