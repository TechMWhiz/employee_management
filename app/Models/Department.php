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
        return $this->hasMany(Employee::class);
    }

    public function subDepartments()
    {
        return $this->hasMany(SubDepartment::class);
    }

}
