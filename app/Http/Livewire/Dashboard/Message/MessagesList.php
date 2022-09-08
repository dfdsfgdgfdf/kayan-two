<?php

namespace App\Http\Livewire\Dashboard\Message;

use App\Models\Message;
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
                ->where(['receiver_type' => Message::TYPE_ADMIN])->latest()->paginate(15);
            }else{
                $list = Message::where(['receiver_type' => Message::TYPE_ADMIN])->latest()->paginate(15);
            }
        }else{
            if($this->searchItem != ''){
                $list = Message::whereLike(['created_at','title'], $this->searchItem)
                ->where(['sender_type' => Message::TYPE_ADMIN])->latest()->paginate(15);
            }else{
                $list = Message::where(['sender_type' => Message::TYPE_ADMIN])->latest()->paginate(15);
            }
        }
        $data = [
            'list' => $list,
        ];
        return view('livewire.dashboard.message.messages-list', $data)->extends('layouts.dashboard.base')
        ->section('content');
    }

}
