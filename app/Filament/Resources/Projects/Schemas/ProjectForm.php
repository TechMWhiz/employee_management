<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('title')
                ->label('Project title')
                ->placeholder('e.g. Website Redesign'),

            Forms\Components\Textarea::make('description')
                ->label('Summary')
                ->rows(4),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'planned' => 'Planned',
                    'active' => 'Active',
                    'paused' => 'Paused',
                    'completed' => 'Completed',
                ])
                ->placeholder('Select status')
                ->default('planned'),

            Forms\Components\Select::make('department')
                ->label('Department')
                ->options([
                    'engineering' => 'Engineering',
                    'hr' => 'Human Resources',
                    'marketing' => 'Marketing',
                    'finance' => 'Finance',
                ])
                ->searchable()
                ->nullable(),


            Forms\Components\DatePicker::make('start_date')
                ->label('Start date')
                ->nullable(),

            Forms\Components\DatePicker::make('end_date')
                ->label('End date')
                ->nullable(),

            // Assigned employees (store as array of ids)
            Forms\Components\Select::make('assigned_employee_ids')
                ->label('Assign employees')
                ->multiple()
                ->searchable()
                ->options(fn () => \App\Models\Employee::orderBy('name')->pluck('name', 'id')->toArray())
                ->helperText('Select one or more employees to assign to this project'),

            Forms\Components\Toggle::make('archived')
                ->label('Archived'),
        ]);
    }
}
