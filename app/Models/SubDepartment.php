<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    protected $fillable = ['department_id', 'name'];

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }

    public function employees()
    {
        return $this->hasMany(\App\Models\Employee::class);
    }
}
