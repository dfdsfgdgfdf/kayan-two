<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'day', 'start', 'end', 'doctor_id'
    ];

    public function getDayAttribute($day)
    {
        if($day == 0){
            return "Saturday";
        }elseif($day == 1){
            return "Sunday";
        }elseif($day == 2){
            return "Monday";
        }elseif($day == 3){
            return "Tuesday";
        }elseif($day == 4){
            return "Wednesday";
        }elseif($day == 5){
            return "Thursday";
        }else{
            return "Friday";
        }
        
    }
}
