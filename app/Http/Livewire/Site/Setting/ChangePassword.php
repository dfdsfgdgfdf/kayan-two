<?php

namespace App\Http\Livewire\Site\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangePassword extends Component
{
    public $password;

    public function render()
    {
        return view('livewire.site.setting.change-password')->extends('layouts.site.base')
        ->section('content');
    }

    public function changePassword(){
        $this->validate([
            'password' => 'required|min:8',
        ]);
        $user= Auth::user();
        $user->update(['password' => $this->password]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Password Changed Successfully!',
        ]);
        $this->password = null ;
    }
}

