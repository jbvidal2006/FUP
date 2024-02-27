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
        'pro_amount',
        'pro_price',
        'pro_image',
        'pro_certs',
        'categories_cat_id'

    ];
}
