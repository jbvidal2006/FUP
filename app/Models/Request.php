<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable =[
        'req_dateRequest',
        'rep_type',
        'req_status',
        'people_id',
    ];
}
