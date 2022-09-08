<?php

namespace App\Http\Livewire\Dashboard\Message;

use App\Models\Message;
use Livewire\Component;

class MessageInfo extends Component
{
    public $message;

    protected $rules = [
        'data.title' => 'required',
    ];

    public function mount($id)
    {
        $this->message = Message::where('id',$id)->first();
        if($this->message->read_status == 0){
            if($this->message->receiver_type == Message::TYPE_ADMIN){
                $this->message->read_status = 1;
                $this->message->save();
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.message.message-info')->extends('layouts.dashboard.base')
        ->section('content');
    }
}
