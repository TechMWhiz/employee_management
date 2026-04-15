<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;
use Illuminate\Support\Facades\Schema;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    // Mass-assignable fields
    protected $fillable = [
        'name',
        'email',
        'department',
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

    protected static function booted()
    {
        static::saved(function (Employee $employee) {
            $new = $employee->department;

            if (!empty($new)) {
                Department::firstOrCreate([
                    'name' => $new,
                ], [
                    'category' => null,
                    'active' => true,
                ]);
            }

            // If department changed, remove the old department record when it has no employees.
            if ($employee->wasChanged('department')) {
                $original = $employee->getOriginal('department');

                if (!empty($original) && $original !== $new) {
                    $count = Employee::where('department', $original)->count();
                    if ($count === 0) {
                        Department::where('name', $original)->delete();
                    }
                }
            }
        });
    }
}
