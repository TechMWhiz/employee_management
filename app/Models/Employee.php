<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
