<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function diagonse()
    {
        return $this->hasOne(Diagonse::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function medicalTests()
    {
        return $this->hasMany(MedicalTest::class)->where('type','=', 0)->orderBy('id', 'DESC');
    }

    public function medicalRadiologies()
    {
        return $this->hasMany(MedicalTest::class)->where('type','=', 1)->orderBy('id', 'DESC');
    }

    
}
