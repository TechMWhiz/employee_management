<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use App\Models\Department;
use App\Models\SubDepartment;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('department_id')
                ->label('Department')
                ->relationship('department', 'name') // links to Department model
                ->required()
                ->reactive(),

            
            Forms\Components\Select::make('sub_department_id')
                ->label('Category')
                ->options(function (callable $get) {
                    $departmentId = $get('department_id');
                    if (!$departmentId) {
                        return [];
                    }

                    return SubDepartment::where('department_id', $departmentId)
                        ->pluck('name', 'id');
                })
                ->required()
                ->reactive()
                ->disabled(fn (callable $get) => !$get('department_id'))
                ->placeholder('Select a category'),

            Forms\Components\TextInput::make('job_title')
                ->maxLength(255),

            Forms\Components\Select::make('employment_type')
                ->options([
                    'full_time' => 'Full-Time',
                    'part_time' => 'Part-Time',
                    'contract' => 'Contract',
                    'intern' => 'Intern',
                ])
                ->required(),

            Forms\Components\DatePicker::make('hire_date')
                ->required(),

            Forms\Components\Toggle::make('active')
                ->label('Active')
                ->default(true),

            Forms\Components\Toggle::make('inactive')
                ->label('Inactive')
                ->default(false),

            Forms\Components\Toggle::make('archived')
                ->label('Archived')
                ->default(false),

            Forms\Components\FileUpload::make('profile_picture')
                ->image()
                ->directory('employees'),
        ]);
    }
}
