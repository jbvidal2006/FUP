<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'pro_name',
        'pro_type',
        'pro_price',
        'pro_certs',
        'pro_image',
        'pro_unit',
        'pro_status',
        'providers_id',
        'categories_id'

    ];
}
