<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'sender_type', 'sender_id', 'receiver_type', 'receiver_id'
    ];

    public const TYPE_ADMIN = 1;
    public const TYPE_DOCTOR = 2;

    public function sender_doctor(){
        return $this->hasOne(Doctor::class, 'id', 'sender_id');
    }

    public function sender_admin(){
        return $this->hasOne(Admin::class, 'id', 'sender_id');
    }
    
    public function receiver_doctor(){
        return $this->hasOne(Doctor::class, 'id', 'receiver_id');
    }

    public function receiver_admin(){
        return $this->hasOne(Admin::class, 'id', 'receiver_id');
    }
}
