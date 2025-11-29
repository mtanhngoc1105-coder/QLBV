<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'code',
        'specialty',
        'department_id',
        'phone',
        'email',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
