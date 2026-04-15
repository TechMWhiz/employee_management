<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Employee;

class ListArchivedEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getTableQuery(): Builder
    {
        return Employee::query()->where('archived', '=', true);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
