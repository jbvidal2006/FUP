<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = [
        'peo_name',
        'peo_lastName',
        'peo_adress',
        'peo_phone',
        'peo_dateBirth',
        'peo_image',
        'peo_status'

    ];
}
