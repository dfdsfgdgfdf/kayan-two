<?php

namespace App\Http\Livewire\Site\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;

class PrescriptionSettings extends Component
{
    use WithFileUploads;

    public $addresses , $prescription_setting , $logoImage , $sealImage;

    protected $rules = [
        'prescription_setting.name' => 'required',
        'prescription_setting.phone' => 'required',
        'prescription_setting.seal' => 'required',
        'prescription_setting.logo' => 'required',
        'prescription_setting.specialization' => 'required',
        'prescription_setting.description' => 'required',
        'prescription_setting.address_id' => 'required',
    ];

    public function mount(){
        $this->prescription_setting = Auth::User()->prescription_setting;
        $this->addresses = Auth::User()->addresses;
    }

    public function render()
    {
        return view('livewire.site.setting.prescription-settings');
    }

    public function updatedLogoImage()
    {
        $imageName = time(). md5(uniqid()) .'.'.$this->logoImage->extension();
        $image_data = $this->logoImage->storeAs('doctorPrescriptionSettingLogoesImages', $imageName, 'public');
        $this->prescription_setting->logo = $image_data;
        $this->prescription_setting->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Logo updated Successfully!',
        ]);
    }

    public function updatedSealImage()
    {
        $imageName = time(). md5(uniqid()) .'.'.$this->sealImage->extension();
        $image_data = $this->sealImage->storeAs('doctorPrescriptionSettingSealesImages', $imageName, 'public');
        $this->prescription_setting->seal = $image_data;
        $this->prescription_setting->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Seal updated Successfully!',
        ]);
    }

    public function update(){
        $this->prescription_setting->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Prescription Setting Updated Successfully!',
        ]);
    }
}
