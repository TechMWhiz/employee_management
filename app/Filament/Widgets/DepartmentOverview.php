<?php

namespace App\Filament\Resources\Departments\Widgets;

use Filament\Widgets\Widget;
use App\Models\Department;

class DepartmentOverview extends Widget
{
    protected string $view = 'filament.resources.departments.widgets.department-overview';
    
    public Department $record;
}