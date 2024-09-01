<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        'phone',
        'token',
        'created_at',
    ];

    public function expired()
    {
        return Carbon::parse($this->created_at)->isPast();
    }
}
