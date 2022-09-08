<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Doctor;
use App\Models\PrescriptionSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\Specializations;
use Livewire\Component;
use PhpParser\Comment\Doc;
use Livewire\WithFileUploads;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Hash;

class Doctors extends Component
{

    use WithFileUploads, HelperTrait;

    public $flag;
    public $doctors;
    public $specializations;

    
    public $name;
    public $phone;
    public $email;
    public $password;
    public $image;
    public $specialization_id,  $ChangePasswordIndex, $newDoctorPassword, $adminPassword;

    protected $listeners = ['statusChanged' => '$refresh'];


    // protected $rules = [
    //     'doctors.*.status' => 'in|0,1,2',
    //     'doctors.*.name' => 'required',
    //     'doctors.*.email' => 'required', 
    //     'doctors.*.phone' => 'required',
    //     'doctors.*.image' => 'required'
    // ];

    public function mount($flag){
        $this->flag = $flag;
        $this->doctors = Doctor::where('status' , $flag)->get(); 
        $this->specializations = Specializations::all();
    }
    public function render()
    {
        return view('livewire.dashboard.doctors')
            ->extends('layouts.dashboard.base')
            ->section('content');
    }

    public function changeStatus($index){
        $this->doctors[$index]->status ? $this->doctors[$index]->status = 0 : $this->doctors[$index]->status = 1;
        $this->doctors[$index]->save();
        $this->doctors = Doctor::where('status' , $this->flag)->get();
    }

    public function archived($index){
        $this->doctors[$index]->status = 2;
        $this->doctors[$index]->save();
        $this->doctors = Doctor::where('status' , $this->flag)->get(); 

    }

    public function getBack($index){
        $this->doctors[$index]->status = 1;
        $this->doctors[$index]->save();
        $this->doctors = Doctor::where('status' , $this->flag)->get();
        session()->flash('message', 'send to active successfully.');
    }

    
    public function add(){
        // dd($this->specialization_id);
        $data = $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email',
            'phone' => 'required|unique:doctors,phone',
            'image' =>'required|max:1024',
            'password' => 'required|min:8',
            'specialization_id'=> 'required',
        ]);
        $data['status']= '1';
        $data['curriculum']= 'write your curriculum';
        $data['specialization_id']= $this->specialization_id;
        $imageName = time(). md5(uniqid()) .'.'.$this->image->extension();
        $data['image'] = $this->image->storeAs('doctorProfileImages', $imageName, 'public');

        $doctor = Doctor::create($data);
        PrescriptionSetting::create([
            'doctor_id' => $doctor->id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'specialization' => 'enter your specialization here',
            'description' => 'enter your description here',
            'logo' => '1.jpg',
            'seal' => '1.jpg',
        ]);
        $this->doctors = Doctor::where('status' , $this->flag)->get();
        $this->dispatchBrowserEvent('hide-form');
        session()->flash('message', 'Doctor added successfully.');

    }

    public function pre_change_password($index){
        $this->ChangePasswordIndex = $index;
        $this->dispatchBrowserEvent('update');
    }

    public function changePassword(){
        if (Hash::check( $this->adminPassword, Auth::user()->password)) {
            $this->doctors[$this->ChangePasswordIndex]->password = $this->newDoctorPassword;
            $this->doctors[$this->ChangePasswordIndex]->save();
            $this->ChangePasswordIndex = '';
            $this->adminPassword='';
            $this->newDoctorPassword='';
            $this->doctors = Doctor::where('status' , $this->flag)->get();
            $this->dispatchBrowserEvent('hide-form');
            session()->flash('message', 'Password changed successfully.');
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',  
                'message' => 'Admin Password Incorect!',
            ]);
        }  
    }

}
