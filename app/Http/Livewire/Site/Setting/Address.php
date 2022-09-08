<?php

namespace App\Http\Livewire\Site\Setting;

use App\Models\Address as ModelsAddress;
use App\Models\City;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Address extends Component
{
    public $addresses, $cities , $state , $city_id , $phone , $address, $deleteAddressIndex;
    protected $listeners = ['removeOneAddress'];
    public $states=[
        'Alexandria',
        'Aswan',
        'Asyut',
        'Beheira',
        'Beni Suef',
        'Cairo',
        'Dakahlia',
        'Damietta',
        'Faiyum',
        'Gharbia',
        'Giza',
        'Ismailia',
        'Kafr ElSheikh',
        'Luxor',
        'Matruh',
        'Minya',
        'Monufia',
        'New Valley',
        'North Sinai',
        'Qalyubia',
        'Qena',
        'Red Sea',
        'Sharqia',
        'Sohag',
        'South Sinai',
        'Suez'
    ];

    public function mount()
    {
        $this->addresses = Auth::User()->addresses;
        $this->cities = City::where('state', 'Alexandria')->get();
    }

    public function resetData(){
        $this->state = '';
        $this->city_id = '';
        $this->phone = '';
        $this->address = '';
    }

    public function render()
    {
        return view('livewire.site.setting.address');
    }

    public function updatedState($value)
    {
        $this->cities = City::where('state', $value)->get();
    }

    public function add(){
        $data = $this->validate([
            'state' => 'required',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required',
            'address' =>'required|max:1024',
        ]);
        $data['doctor_id'] = Auth::user()->id; 
        ModelsAddress::create($data);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Address Added Successfully!',
        ]);
        $this->addresses = Auth::User()->addresses;
        $this->resetData();
    }

    public function alertConfirm($index)
    {   
        $this->deleteAddressIndex = $index;
        $this->dispatchBrowserEvent('swal:confirmAddress', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this Address ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function removeOneAddress()
    {
        $this->addresses[$this->deleteAddressIndex]->delete();
        $this->addresses = Auth::User()->addresses;
        $this->deleteAddressIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!', 
                // 'text' => 'It will not list on users table soon.'
        ]);
        
    }
}
