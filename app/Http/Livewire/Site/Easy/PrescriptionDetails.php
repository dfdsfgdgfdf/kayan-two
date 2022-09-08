<?php

namespace App\Http\Livewire\Site\Easy;

use App\Models\Medicine;
use App\Models\Prescription;
use Faker\Provider\Medical;
use Livewire\Component;

class PrescriptionDetails extends Component
{
    public $medicin_search, $booking_id, $medicine_names , $medicine , $prescriptions, $deletePrecriptionIndex, $updateIndex ,$updateFlag , $updatPrescription;
    protected $listeners = ['setBookingId' ,'deletePrescription'];

    public function mount()
    {
        $this->medicine_names = Medicine::all();
        $this->prescriptions = Prescription::where('book_id',$this->booking_id)->get();

        $this->medicine = [
            'note' => ' ',
            'time' => ' ',
            'dose' => ' '
        ];
        
    }

    public function render()
    {
        return view('livewire.site.easy.prescription-details');
    }

    public function setBookingId($id){
        $this->booking_id = $id;
    }

    public function add()
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
        $this->medicine['book_id']= $this->booking_id;
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
        $this->prescriptions = Prescription::where('book_id',$this->booking_id)->get();
        $this->medicine = [
            'note' => ' ',
            'time' => ' ',
            'dose' => ' '
        ];
        $this->medicin_search = '';
    }

    public function alertConfirm($index)
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
        $this->prescriptions = Prescription::where('book_id',$this->booking_id)->get();
        $this->deleteAddressIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
        ]);
    }

    public function update($index)
    {
        $this->updateIndex = $index;
        $this->updatPrescription = [
            'name' => $this->prescriptions[$index]['medicine']['name'],
            'dose' => $this->prescriptions[$index]['dose'],
            'time' => $this->prescriptions[$index]['time'],
            'note' => $this->prescriptions[$index]['note'],
        ];
        $this->updateFlag = 1;
        $this->medicin_search = $this->prescriptions[$index]['medicine']['name'];
    }

    public function saveUpdate()
    {
        $medicin_id = Medicine::where('name' , $this->medicin_search)->first();
        if(!$medicin_id){
            $medicin_id = Medicine::insertGetId(['name'=>$this->medicine['name']]);
            $this->updatPrescription['medicine_id']= $medicin_id;
        }else{
            $this->updatPrescription['medicine_id']= $medicin_id['id'];
        }
        $this->prescriptions[$this->updateIndex]['medicine_id']= $this->updatPrescription['medicine_id'];
        $this->prescriptions[$this->updateIndex]['dose'] = $this->updatPrescription['dose'];
        $this->prescriptions[$this->updateIndex]['time'] = $this->updatPrescription['time'];
        $this->prescriptions[$this->updateIndex]['note'] = $this->updatPrescription['note'];
        $this->prescriptions[$this->updateIndex]->save();

        $this->updateFlag = 0;
        $this->prescriptions = Prescription::where('book_id',$this->booking_id)->get();
        $this->updatPrescription = '' ;
        $this->medicin_search = '';
        $this->medicine_names = Medicine::all();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Updated Successfully!', 
        ]);
    }
    public function updatedMedicinSearch(){
        $this->medicine_names = Medicine::where('name', 'like', '%' . $this->medicin_search . '%')->get();
    }
}
