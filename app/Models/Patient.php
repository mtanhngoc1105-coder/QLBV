<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'dob',
        'gender',
        'phone',
        'email',
        'address'
    ];
}
