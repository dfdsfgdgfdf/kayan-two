<?php

namespace App\Http\Livewire\Site\Examination;

use App\Models\Book;
use App\Models\Diagonse;
use App\Models\MedicalTest;
use App\Models\Medicine;
use App\Models\Prescription;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class NewExaminationDetails extends Component
{
    use WithFileUploads;

    public $medicin_search, $book, $book_id , $medicine_names, $medicine, $prescriptions, $deletePrecriptionIndex , $diagonse
    , $medical_radiology , $medicalTest, $deleteRadiologyIndex, $deleteTestIndex, $medicalRadiology, $medical_test, 
    $diagnosisInfo ,$updatePreFlag, $updatePreIndex, $updateRadFlag, $updateRadIndex, $updateRadImage, $updateTestImage, $updateTestFlag, $updateTestIndex;

    protected $listeners = ['deletePrescription', 'deleteRadiology','deleteTest'];

    protected $rules = [
        'prescriptions.*.medicine.name' => ['required'],
        'prescriptions.*.time' => ['required'],
        'prescriptions.*.dose' => ['required'],
        'prescriptions.*.note' => ['required'],
        'medicalRadiology.*.name' => ['required'],
        'medicalRadiology.*.note' => ['required'],
        'medicalTest.*.name' => ['required'],
        'medicalTest.*.note' => ['required'],
    ];

    public function mount($id)
    {
        $this->book_id = $id;
        $this->book = Book::find($id);
        $this->medicine_names = Medicine::all();
        $this->prescriptions = Prescription::where('book_id',$this->book_id)->get();
        $this->medicalRadiology = MedicalTest::where(['type'=> 1, 'book_id' => $this->book_id])->get();
        $this->medicalTest = MedicalTest::where(['type'=> 0, 'book_id' => $this->book_id])->get();
        $this->prescription_setting = Auth::User()->prescription_setting;
        $this->diagonse = Diagonse::where('book_id', $this->book_id)->first();
        if($this->diagonse){ $this->diagnosisInfo = $this->diagonse['content'];}

        $this->medicine = [
            'note' => ' ',
            'time' => ' ',
            'dose' => ' '
        ];
        $this->medical_test = [
            'note' => ' '
        ];
        $this->medical_radiology = [
            'note' => ' '
        ];
       
    }

    public function render()
    {
        return view('livewire.site.examination.new-examination-details')->extends('layouts.site.base')
        ->section('content');
    }

    public function save(){
        $old_data = Diagonse::where('book_id', $this->book_id)->first();
        if($old_data){
            $old_data['content']=$this->diagnosisInfo;
            $old_data->save();
        }else{
            if($this->diagnosisInfo != NULL){
                Diagonse::create([
                    'book_id' => $this->book_id,
                    'content' => $this->diagnosisInfo
                ]);
            }  
        }
        $this->diagonse = Diagonse::where('book_id', $this->book_id)->first();
        if($this->diagonse){ $this->diagnosisInfo = $this->diagonse['content'];}

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Saved Successfully!',
        ]);
    }

    public function done(){
        $this->book['status'] = 'finished' ;
        $this->book->save();
        return redirect(route('doctor.Examination.list' , 'new'));
    }
    
    public function add_prescriptions()
    {
        $data = $this->validate([
            'medicin_search' => 'required',
            'medicine.time' => '',
            'medicine.dose' => '',
            'medicine.note' =>'',
        ]);
        $medicin_id = Medicine::where('name' , $this->medicin_search)->first();
        if(!$medicin_id){
            $medicin_id = Medicine::insertGetId(['name'=>$this->medicin_search]);
            $this->medicine['medicine_id']= $medicin_id;
        }else{
            $this->medicine['medicine_id']= $medicin_id['id'];
        }
        $this->medicine['book_id']= $this->book_id;
        Prescription::create([
            'medicine_id' => $this->medicine['medicine_id'],
            'time' => $this->medicine['time'],
            'dose' => $this->medicine['dose'],
            'note' => $this->medicine['note'],
            'book_id' => $this->medicine['book_id'],
        ]);
        $this->medicine_names = Medicine::all();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => ' Added Successfully!',
        ]);
        $this->prescriptions = Prescription::where('book_id',$this->book_id)->get();
        $this->medicine = [
            'note' => ' ',
            'time' => ' ',
            'dose' => ' '
        ];
        $this->medicin_search = '';
    }

    public function alertPrescriptionsConfirm($index)
    {   
        $this->deletePrecriptionIndex = $index;
        $this->dispatchBrowserEvent('swal:confirmDeletePrescription', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function deletePrescription()
    {
        $this->prescriptions[$this->deletePrecriptionIndex]->delete();
        $this->prescriptions = Prescription::where('book_id',$this->book_id)->get();
        $this->deleteAddressIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
        ]);
    }

    public function addRadiology()
    {
        $data = $this->validate([
            'medical_radiology.name' => 'required',
            'medical_radiology.file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'medical_radiology.note' =>'',
        ]);
        $imageName = time(). md5(uniqid()) .'.'.$this->medical_radiology['file']->extension();
        $this->medical_radiology['file'] = $this->medical_radiology['file']->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
        $this->medical_radiology['type'] = 1;
        $this->medical_radiology['book_id'] = $this->book_id;
        MedicalTest::create($this->medical_radiology);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => ' Added Successfully!',
        ]);
        $this->medicalRadiology = MedicalTest::where(['type'=> 1, 'book_id' => $this->book_id])->get();
        $this->medical_radiology = [
            'note' => ' '
        ];

    }

    public function alertRadiologyConfirm($index)
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
        $file_path = public_path('storage/'.$this->medicalRadiology[$this->deleteRadiologyIndex]['file']);
        if(File::exists($file_path)){
            unlink($file_path);
        }
        $this->medicalRadiology[$this->deleteRadiologyIndex]->delete();
        $this->medicalRadiology = MedicalTest::where(['type'=> 1, 'book_id' => $this->book_id])->get();
        $this->deleteRadiologyIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
        ]);
    }

    public function addTese()
    {
        $data = $this->validate([
            'medical_test.name' => 'required',
            'medical_test.file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'medical_test.note' =>'',
        ]);
        $imageName = time(). md5(uniqid()) .'.'.$this->medical_test['file']->extension();
        $this->medical_test['file'] = $this->medical_test['file']->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
        $this->medical_test['type'] = 0;
        $this->medical_test['book_id'] = $this->book_id;
        MedicalTest::create($this->medical_test);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => ' Added Successfully!',
        ]);
        $this->medicalTest = MedicalTest::where(['type'=> 0, 'book_id' => $this->book_id])->get();
        $this->medical_test = [
            'note' => ' '
        ];


    }

    public function alertTestConfirm($index)
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
        $file_path = public_path('storage/'.$this->medicalTest[$this->deleteTestIndex]['file']);
        if(File::exists($file_path)){
            unlink($file_path);
        }
        $this->medicalTest[$this->deleteTestIndex]->delete();
        $this->medicalTest = MedicalTest::where(['type'=> 0, 'book_id' => $this->book_id])->get();
        $this->deleteTestIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
        ]);
    }

    public function updatePrescription($index){
        $this->updatePreIndex = $index;
        $this->updatePreFlag = 1;
        $this->medicin_search = $this->prescriptions[$index]->medicine->name;
    }

    public function updatePrescriptionSave(){
        $medicin_id = Medicine::where('name' ,$this->prescriptions[$this->updatePreIndex]->medicine->name)->first();
        if(!$medicin_id){
            $medicin_id = Medicine::insertGetId(['name'=>$this->prescriptions[$this->updatePreIndex]->medicine->name]);
            $this->prescriptions[$this->updatePreIndex]->medicine_id = $medicin_id;
        }else{
            $this->prescriptions[$this->updatePreIndex]->medicine_id = $medicin_id['id'];
        }
        $this->prescriptions[$this->updatePreIndex]->save();
        $this->updatePreIndex = '';
        $this->updatePreFlag = 0;
        $this->medicin_search = '';
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Update Successfully!', 
        ]);
    }

    public function updateRad($index){
        $this->updateRadIndex = $index;
        $this->updateRadFlag = 1;
    }

    public function updateRadSave(){
        if ($this->updateRadImage) {
            $imageName = time(). md5(uniqid()) .'.'.$this->updateRadImage->extension();
            $file_path = public_path('storage/'.$this->medicalRadiology[$this->updateRadIndex]['file']);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            $this->medicalRadiology[$this->updateRadIndex]['file'] = $this->updateRadImage->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
        }
        $this->medicalRadiology[$this->updateRadIndex]->save();
        $this->updateRadIndex = '';
        $this->updateRadFlag = 0;
        $this->updateRadImage= '';
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Update Successfully!', 
        ]);
    }

    public function updateTest($index){
        $this->updateTestIndex = $index;
        $this->updateTestFlag = 1;
    }

    public function updateTestSave(){
        if ($this->updateTestImage) {
            $imageName = time(). md5(uniqid()) .'.'.$this->updateTestImage->extension();
            $file_path = public_path('storage/'.$this->medicalTest[$this->updateTestIndex]['file']);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            $this->medicalTest[$this->updateTestIndex]['file'] = $this->updateTestImage->storeAs('PatientMedicalTestImages', $imageName, 'public');
        }
        $this->medicalTest[$this->updateTestIndex]->save();
        $this->updateTestImage = '';
        $this->updateTestIndex = '';
        $this->updateTestFlag = 0;
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Update Successfully!', 
        ]);
    }

    public function updatedMedicinSearch(){
        $this->medicine_names = Medicine::where('name', 'like', '%' . $this->medicin_search . '%')->get();
    }
}
