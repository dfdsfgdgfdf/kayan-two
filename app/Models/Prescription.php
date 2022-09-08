<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
