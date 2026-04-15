<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'category',
        'active',
        'notes',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function employees()
    {
        // employees store department as a string (name), so use hasMany with custom keys
        return $this->hasMany(\App\Models\Employee::class, 'department', 'name');
    }
}
