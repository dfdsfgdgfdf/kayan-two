<?php

namespace App\Http\Livewire\Site\Message;

use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MessagesList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchItem, $type;

    public function mount($type){
        $this->type = $type;  // type = 1 => recevie , type = 2 => send
    }

    public function render()
    {
        if($this->type == 1 ){
            if($this->searchItem != ''){
                $list = Message::whereLike(['created_at','title'], $this->searchItem)
                ->where(['receiver_type' => Message::TYPE_DOCTOR, 'receiver_id' => Auth::user()->id])->latest()->paginate(15);
            }else{
                $list = Message::where(['receiver_type' => Message::TYPE_DOCTOR, 'receiver_id' => Auth::user()->id])->latest()->paginate(15);
            }
        }else{
            if($this->searchItem != ''){
                $list = Message::whereLike(['created_at','title'], $this->searchItem)
                ->where(['sender_type' => Message::TYPE_DOCTOR, 'sender_id' => Auth::user()->id])->latest()->paginate(15);
            }else{
                $list = Message::where(['sender_type' => Message::TYPE_DOCTOR, 'sender_id' => Auth::user()->id])->latest()->paginate(15);
            }
        }
        $data = [
            'list' => $list,
        ];
        return view('livewire.site.message.messages-list', $data)->extends('layouts.site.base')
        ->section('content');
    }
}
