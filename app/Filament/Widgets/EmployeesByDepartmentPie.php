<?php

namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeesByDepartmentPie extends PieChartWidget
{
    protected ?string $heading = 'Employees by Department (Pie)';

    protected ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $rows = Employee::select('departments.name as department', DB::raw('count(*) as total'))
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->groupBy('departments.name')
            ->orderByDesc('total')
            ->get();

        $labels = $rows->pluck('department')->map(fn ($d) => $d ?? 'Unassigned')->toArray();
        $data = $rows->pluck('total')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Employees',
                    'data' => $data,
                    'backgroundColor' => $this->generateColors(count($labels)),
                ],
            ],
        ];
    }

    protected function generateColors(int $n): array
    {
        $palette = [
            '#3b82f6',
            '#6366f1',
            '#8b5cf6',
            '#ec4899',
            '#ef4444',
            '#f59e0b',
            '#10b981',
            '#06b6d4',
            '#64748b',
            '#f97316',
        ];

        if ($n <= count($palette)) {
            return array_slice($palette, 0, $n);
        }

        $colors = [];
        for ($i = 0; $i < $n; $i++) {
            $colors[] = $palette[$i % count($palette)];
        }

        return $colors;
    }
}
