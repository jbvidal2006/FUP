<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable  = [
        'con_shippingDate',
        'providers_prov_id',
        'products_pro_id'

    ];
}
