<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Const_;

class City extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const STATE=[
        'Alexandria',
        'Aswan',
        'Asyut',
        'Beheira',
        'Beni Suef',
        'Cairo',
        'Dakahlia',
        'Damietta',
        'Faiyum',
        'Gharbia',
        'Giza',
        'Ismailia',
        'Kafr ElSheikh',
        'Luxor',
        'Matruh',
        'Minya',
        'Monufia',
        'New Valley',
        'North Sinai',
        'Qalyubia',
        'Qena',
        'Red Sea',
        'Sharqia',
        'Sohag',
        'South Sinai',
        'Suez'
    ];

    public function patients()
    {
        return $this->hasMany(Address::class);
    }

}
