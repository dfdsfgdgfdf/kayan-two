<?php

namespace App\Http\Livewire\Site\Setting;

use App\Models\DoctorSchedule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Schedule extends Component
{

    public $schedules, $deleteIndex, $start, $end, $day;
    protected $listeners = ['removeSchedule'];

    public function mount()
    {
        $this->schedules = Auth::User()->schedules;
    }

    public function render()
    {
        return view('livewire.site.setting.schedule');
    }

    public function resetData(){
        $this->day = '';
        $this->start = '';
        $this->end = '';
    }

    public function add(){
        $data = $this->validate([
            'day' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);
        $data['doctor_id'] = Auth::user()->id;
        DoctorSchedule::create($data);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Pricing Added Successfully!',
        ]);
        $this->schedules = Auth::User()->schedules;
        $this->resetData();
    }

    public function alertConfirm($index)
    {
        $this->deleteIndex = $index;
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',  
                'message' => 'Are you sure delete this Price ?', 
                'text' => 'If deleted, you will not be able to recover !',
        ]);
    }

    public function removeSchedule()
    {
        $this->schedules[$this->deleteIndex]->delete();
        $this->schedules = Auth::User()->schedules;
        $this->deleteIndex='';
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Delete Successfully!',
        ]);

    }
}
