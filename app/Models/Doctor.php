<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Doctor extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'phone', 'email', 'password' , 'image', 'curriculum', 'specialization_id', 'diagnosis_availability',
        'dashboard_availability', 'online_check_ups', 'online_chat', 'status', 'new_cost', 'resumption_cost'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function pricing(){
        return $this->hasMany(DoctorPrice::class);
    }

    public function schedules(){
        return $this->hasMany(DoctorSchedule::class);
    }

    public function prescription_setting(){
        return $this->hasOne(PrescriptionSetting::class);
    }
}
