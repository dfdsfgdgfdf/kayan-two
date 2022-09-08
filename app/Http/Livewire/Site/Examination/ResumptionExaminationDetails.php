<?php

namespace App\Http\Livewire\Site\Examination;

use App\Models\Book;
use App\Models\Diagonse;
use App\Models\MedicalTest;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class ResumptionExaminationDetails extends Component
{
    use WithFileUploads;
    public $last_exam, $medicin_search ,$book_id , $book ,$prescriptions, $medicalRadiology,$medicalTest, $prescription_setting ,$diagonse, $new_info, $new_prescription, $medicine_names, $medical_test, $medical_radiology;

    public function mount($id)
    {
        $this->book_id = $id;
        $this->medicine_names = Medicine::all();
        $this->book = Book::find($id);
        $this->prescriptions = Prescription::where('book_id',$this->book_id)->get();
        $this->medicalRadiology = MedicalTest::where(['type'=> 1, 'book_id' => $this->book_id])->get();
        $this->medicalTest = MedicalTest::where(['type'=> 0, 'book_id' => $this->book_id])->get();
        $this->prescription_setting = Auth::User()->prescription_setting;
        $this->diagonse = Diagonse::where('book_id', $this->book_id)->first();
        if($this->diagonse){ $this->diagnosisInfo = $this->diagonse['content'];}
        $this->last_exam = Book::select('date')->where(['doctor_id' => Auth::user()->id, 'patient_id' => $this->book->patient_id  , 'status' => 'finished'])->latest('id')
        ->first();
        $this->new_prescription = [
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
        return view('livewire.site.examination.resumption-examination-details')->extends('layouts.site.base')
        ->section('content');
    }

    public function preview(){
        $this->dispatchBrowserEvent('show:prescription');
    }
    
    public function addInfo()
    {
        if($this->new_info != Null){
            $old_data = Diagonse::where('book_id', $this->book_id)->first();
            if($old_data){
                $old_data['content']=$this->new_info;
                $old_data->save();
            }else{
                Diagonse::create([
                    'content' => $this->new_info,
                    'book_id' => $this->book_id,
                ]);
            }
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Saved Successfully!',
            ]);
            $this->new_info = '';
            $this->emitTo('site.examination.resumption-component.diagnosis', '$refresh');
            $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');

        }else{
            $this->dispatchBrowserEvent('swal:modal:false', [
                'type' => 'error',  
                'message' => 'Enter Diagnosis Info firts!',
            ]);
        }
    }

    public function add_prescription()
    {
        try{
            $medicin_id = Medicine::where('name' , $this->medicin_search)->first();

            if(!$medicin_id){
                $medicin_id = Medicine::insertGetId(['name'=>$this->medicin_search]);
                $this->new_prescription['medicine_id']= $medicin_id;
            }else{
                $this->new_prescription['medicine_id']= $medicin_id['id'];
            }

            $this->new_prescription['book_id']= $this->book_id;
            Prescription::create([
                'medicine_id' => $this->new_prescription['medicine_id'],
                'time' => $this->new_prescription['time'],
                'dose' => $this->new_prescription['dose'],
                'note' => $this->new_prescription['note'],
                'book_id' => $this->new_prescription['book_id'],
            ]);
            $this->medicine_names = Medicine::all();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => ' Added Successfully!',
            ]);
            $this->emitTo('site.examination.resumption-component.prescription-only', '$refresh');
            $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
            $this->new_prescription = [
                'note' => ' ',
                'time' => ' ',
                'dose' => ' '
            ];
            $this->medicin_search = ' ';
        }catch (\Exception $e){
            $this->dispatchBrowserEvent('swal:modal:false', [
                'type' => 'error',  
                'message' => 'Compelete all Data firts!',
            ]);
        }
    }

    public function add_test(){
        try{
            $imageName = time(). md5(uniqid()) .'.'.$this->medical_test['file']->extension();
            $this->medical_test['file'] = $this->medical_test['file']->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
            $this->medical_test['type'] = 0;
            $this->medical_test['book_id'] = $this->book_id;
            MedicalTest::create($this->medical_test);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => ' Added Successfully!',
            ]);
            $this->medical_test = [
                'note' => ' '
            ];
            $this->emitTo('site.examination.resumption-component.medical-test', '$refresh');
            $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        }catch (\Exception $e){
            $this->dispatchBrowserEvent('swal:modal:false', [
                'type' => 'error',  
                'message' => 'Try again!',
            ]);
        }

    }

    public function add_radiology(){
        try{
            $imageName = time(). md5(uniqid()) .'.'.$this->medical_radiology['file']->extension();
            $this->medical_radiology['file'] = $this->medical_radiology['file']->storeAs('PatientMedicalRadiologyImages', $imageName, 'public');
            $this->medical_radiology['type'] = 1;
            $this->medical_radiology['book_id'] = $this->book_id;
            MedicalTest::create($this->medical_radiology);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => ' Added Successfully!',
            ]);
            $this->medical_radiology = [
                'note' => ' '
            ];
            $this->emitTo('site.examination.resumption-component.medical-radiology', '$refresh');
            $this->emitTo('site.examination.resumption-component.prescription-all', '$refresh');
        }catch (\Exception $e){
            $this->dispatchBrowserEvent('swal:modal:false', [
                'type' => 'error',  
                'message' => 'Try again!',
            ]);
        }
    }

    public function done(){
        $this->book['status'] = 'finished' ;
        $this->book->save();
        return redirect(route('doctor.Examination.list' , 'resumption'));
    }

    public function updatedMedicinSearch(){
        $this->medicine_names = Medicine::where('name', 'like', '%' . $this->medicin_search . '%')->get();
    }
    
}
