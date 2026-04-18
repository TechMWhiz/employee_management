<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    // Mass-assignable fields
    protected $fillable = [
        'name',
        'email',
        'department_id',
        'job_title',
        'employment_type',
        'hire_date',
        'active',
        'inactive',
        'archived',
        'profile_picture',

    ];

    protected $casts = [
        'hire_date' => 'date',
        'active' => 'boolean',
        'inactive' => 'boolean',
        'archived' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class);
    }
}
