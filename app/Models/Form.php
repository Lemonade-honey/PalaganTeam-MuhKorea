<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'desc',
        'details',
        'form',
        'status',
        'img',
        'password',
        'register',
        'id_massage',
        'created_by'
    ];
}
