<?php

namespace App\Http\Livewire\Site\Setting;

use App\Models\DoctorPrice;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Pricing extends Component
{
    public $pricing , $title , $price , $deleteIndex;
    protected $listeners = ['removePrice'];

    public function mount()
    {
        $this->pricing = Auth::User()->pricing;
    }

    public function render()
    {
        return view('livewire.site.setting.pricing');
    }

    public function resetData(){
        $this->title = '';
        $this->price = '';
    }

    public function add(){
        $data = $this->validate([
            'title' => 'required',
            'price' => 'required',
        ]);
        $data['doctor_id'] = Auth::user()->id; 
        DoctorPrice::create($data);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Pricing Added Successfully!',
        ]);
        $this->pricing = Auth::User()->pricing;
        $this->resetData();
    }

    public function alertConfirm($index)
    {
        $this->deleteIndex = $index;
        $this->dispatchBrowserEvent('swal:confirmPricing', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this Price ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function removePrice()
    {
        $this->pricing[$this->deleteIndex]->delete();
        $this->pricing = Auth::User()->pricing;
        $this->deleteIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!',
        ]);

    }
}
