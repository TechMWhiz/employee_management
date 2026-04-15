<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Employee;
use App\Models\Department;

class EmployeeStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Employee Overview';

    /**
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $active = Employee::where('active', true)->count();
        $inactive = Employee::where('inactive', true)->count();

        return [
            Stat::make('Total employees', $totalEmployees),

            Stat::make('Total departments', $totalDepartments),

            Stat::make('Active employees', $active)
                ->color('success'),

            Stat::make('Inactive employees', $inactive)
                ->color('danger'),
        ];
    }
}
