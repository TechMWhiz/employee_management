<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'category',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function employees()
    {
        return $this->hasMany(\App\Models\Employee::class, 'department_id');
    }
}
