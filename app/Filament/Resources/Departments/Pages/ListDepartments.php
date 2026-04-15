<?php

namespace App\Filament\Resources\Departments\Pages;

use App\Filament\Resources\Departments\DepartmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDepartments extends ListRecords
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getEmptyStateHeading(): ?string
    {
        return 'No departments yet';
    }

    protected function getEmptyStateDescription(): ?string
    {
        return 'Create your first department to organize teams and projects.';
    }

    protected function getEmptyStateActions(): array
    {
        return [];
    }
}
