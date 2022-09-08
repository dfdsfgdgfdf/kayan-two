<?php

namespace App\Http\Livewire\Site\Setting;

use App\Models\Specializations;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class BasicInfo extends Component
{
    use WithFileUploads;

    public $doctor , $image , $specializations;

    protected $rules = [
        'doctor.name' => 'required',
        'doctor.email' => 'required',
        'doctor.phone' => 'required',
        'doctor.image' => 'required',
        'doctor.specialization_id' => 'required',
        'doctor.diagnosis_availability' => 'required',
        'doctor.online_check_ups' => 'required',
        'doctor.online_chat' => 'required',
        'doctor.dashboard_availability' => 'required',
        'doctor.resumption_cost' => 'required',
        'doctor.new_cost' => 'required',
    ];

    public function mount()
    {
        $this->doctor = Auth::User();
        $this->specializations = Specializations::all();

    }

    public function render()
    {
        return view('livewire.site.setting.basic-info');
    }

    public function updatedImage()
    {
        $imageName = time(). md5(uniqid()) .'.'.$this->image->extension();
        $image_data = $this->image->storeAs('doctorProfileImages', $imageName, 'public');
        $this->doctor->image = $image_data;
        $this->doctor->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Photo updated Successfully!',
        ]);
    }

    public function update()
    {
        $this->doctor->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Profile Updated Successfully!',
        ]);
    }

}
