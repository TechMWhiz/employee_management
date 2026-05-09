<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

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
        'archived_at',
        'profile_picture',

    ];

    protected $casts = [
        'hire_date' => 'date',
        'active' => 'boolean',
        'inactive' => 'boolean',
        'archived' => 'boolean',
        'archived_at' => 'datetime',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Scope to only include active (non-archived) employees.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('archived', false);
    }

    /**
     * Scope to only include archived employees.
     */
    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('archived', true);
    }

    /**
     * Archive this employee.
     */
    public function archive(): void
    {
        $this->update([
            'archived' => true,
            'archived_at' => now(),
            'active' => false,
            'inactive' => true,
        ]);
    }

    /**
     * Retrieve (restore) this employee from the archive.
     */
    public function retrieve(): void
    {
        $this->update([
            'archived' => false,
            'archived_at' => null,
            'active' => true,
            'inactive' => false,
        ]);
    }
}
