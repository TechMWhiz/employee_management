<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'department',
        'start_date',
        'end_date',
        'archived',
        'assigned_employee_ids',
    ];

    protected $casts = [
        'archived' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'assigned_employee_ids' => 'array',
    ];
}
