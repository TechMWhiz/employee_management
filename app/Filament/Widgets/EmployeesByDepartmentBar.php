<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeesByDepartmentBar extends BarChartWidget
{
    protected ?string $heading = 'Employees by Department (Bar)';

    protected ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $rows = Employee::select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
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
            '#3b82f6', // blue
            '#6366f1', // indigo
            '#8b5cf6', // violet
            '#ec4899', // pink
            '#ef4444', // red
            '#f59e0b', // amber
            '#10b981', // emerald
            '#06b6d4', // teal
            '#64748b', // gray
            '#f97316', // orange
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
