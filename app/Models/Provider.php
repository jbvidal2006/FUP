<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;


    protected $fillable =[
        'prov_ranking',
        'prov_imageRanking',
        'prov_email',
        'prov_group',
        'prov_description',
        'prov_status',
        'people_id'
    ];
}
