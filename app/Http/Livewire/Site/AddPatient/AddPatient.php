<?php

namespace App\Http\Livewire\Site\AddPatient;

use App\Models\City;
use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AddPatient extends Component
{
    public $new_patient, $cities ,$state;

    public function mount(){
        $this->cities = City::all();
        $this->states = City::STATE;
    }

    public function render()
    {
        return view('livewire.site.add-patient.add-patient');
    }

    public function add(){
        $data = $this->validate([
            'new_patient.name' => 'required',
            'new_patient.city_id' => 'required|exists:cities,id',
            'new_patient.phone' => 'required|unique:patients,phone',
            'new_patient.address' =>'required|max:1024',
            'new_patient.age' =>'required',
            'new_patient.gender' =>'required|in:0,1',
        ],
        [
            'new_patient.name.required' => 'required',
            'new_patient.phone.required' => 'required',
            'new_patient.phone.unique' => 'alrady found',
            'new_patient.city_id.required' => 'required',
            'new_patient.address.required' => 'required',
            'new_patient.age.required' => 'required',
            'new_patient.gender.required' => 'required',
        ]);
        $this->new_patient['easy'] = 0; 
        $city = City::find($this->new_patient['city_id']);
        $code = strval(substr($city->state, 0, 2)) . strval(substr($city->name, 0, 1)) . substr(uniqid(rand(), true), 8, 8);
        $old_p = Patient::where('code' , $code)->exists();
        while($old_p){
            $code = strval(substr($city->state, 0, 2)) . strval(substr($city->name, 0, 1)) . substr(uniqid(rand(), true), 8, 8);
            $old_p = Patient::where('code' , $code)->first();
        }
        $this->new_patient['code'] = $code;
        $this->new_patient['password'] = bcrypt($code);
        $pateint_id = Patient::insertGetId($this->new_patient);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Patient Added Successfully!',
        ]);
        $this->dispatchBrowserEvent('show-code');
        $this->emit('setPatientId', $pateint_id);
    }

    public function updatedState($value)
    {
        $this->cities = City::where('state', $value)->get();
    }
}
