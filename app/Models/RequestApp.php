<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestApp extends Model
{
    use HasFactory;

    protected $fillable =[
        'req_dateRequest',
        'req_type',
        'req_description',
        'req_status',
        'people_id',
    ];
}
