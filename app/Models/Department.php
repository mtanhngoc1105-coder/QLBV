<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'code', 'parent_id', 'description'];

    public function doctors()
    {
       return $this->hasMany(Doctor::class);
    }
}
