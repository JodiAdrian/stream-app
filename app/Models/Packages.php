<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $fillable = [
        'name',
        'price',
        'max_days',
        'max_users',
        'is_download',
        'is_4k'
    ];
}
