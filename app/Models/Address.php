<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id', 'address', 'phone', 'doctor_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function prescription()
    {
        return $this->hasMany(PrescriptionSetting::class);
    }
}
