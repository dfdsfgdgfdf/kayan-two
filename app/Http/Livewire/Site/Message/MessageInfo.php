<?php

namespace App\Http\Livewire\Site\Message;

use App\Models\Message;
use Livewire\Component;

class MessageInfo extends Component
{
    public $message;

    public function mount($id){
        $this->message = Message::find($id); 
        if($this->message->read_status == 0){
            if($this->message->receiver_type == Message::TYPE_DOCTOR){
                if($this->message->receiver_id == auth()->user()->id){
                    $this->message->read_status = 1;
                    $this->message->save();
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.site.message.message-info')->extends('layouts.site.base')
        ->section('content');
    }
}
