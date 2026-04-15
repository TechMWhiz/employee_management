<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action as HeaderAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Employee;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            HeaderAction::make('archived')
                ->label('Archived')
                ->url(route('filament.admin.resources.employees.archived')),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Employee::query()->where('archived', '=', false);
    }

    protected function getEmptyStateHeading(): ?string
    {
        return 'No employees found';
    }

    protected function getEmptyStateDescription(): ?string
    {
        return 'Invite or add employees to begin managing teams and assignments.';
    }

    protected function getEmptyStateActions(): array
    {
        return [
            CreateAction::make()->label('Add employee'),
        ];
    }
}
