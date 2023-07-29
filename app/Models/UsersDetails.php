<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'activity',
        'form',
    ];
}
