<?php

namespace App\Filament\Resources\Departments\Pages;

use App\Filament\Resources\Departments\DepartmentResource;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Departments\Widgets\DepartmentOverview;

class ViewDepartment extends ViewRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            DepartmentOverview::class,
        ];
    }
}

