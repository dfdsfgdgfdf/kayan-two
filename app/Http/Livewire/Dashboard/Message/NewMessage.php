<?php

namespace App\Http\Livewire\Dashboard\Message;

use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewMessage extends Component
{
    public $new_message, $doctors;

    public function mount(){
        $this->doctors = Doctor::where('status' , 1)->get(); 
    }

    public function render()
    {
        return view('livewire.dashboard.message.new-message')->extends('layouts.dashboard.base')
        ->section('content');
    }

    public function send(){
        $this->validate([
            'new_message.title' => 'required',
            'new_message.content' => 'required',
            'new_message.receiver_id' => 'required|numeric|min:0|not_in:0',
        ],
        [
            'new_message.title.required' => 'required',
            'new_message.content.required' => 'required',
            'new_message.receiver_id.required' => 'required',
            'new_message.receiver_id.not_in' => 'required',
        ]);
        $this->new_message['sender_type'] = Message::TYPE_ADMIN; 
        $this->new_message['sender_id'] = Auth::user()->id; 
        $this->new_message['receiver_type'] = Message::TYPE_DOCTOR; 
        Message::create($this->new_message);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Message Send Successfully!',
        ]);
        $this->new_message=[];
    }
}
