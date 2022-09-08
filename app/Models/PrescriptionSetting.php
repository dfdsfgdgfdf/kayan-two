<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id', 'name', 'phone', 'description', 'logo', 'seal' , 'address_id', 'specialization'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
