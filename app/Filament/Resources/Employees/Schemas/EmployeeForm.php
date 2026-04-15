<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->label('Full name')
                ->placeholder('e.g. Jane Doe')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->label('Work email')
                ->placeholder('name@company.com')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

                Forms\Components\Select::make('department')
                    ->label('Department')
                    ->placeholder('Select department')
                    ->options(function () {
                        return \App\Models\Department::orderBy('name')->pluck('name', 'name')->toArray();
                    })
                    ->searchable()
                    ->required(),

            Forms\Components\TextInput::make('job_title')
                ->label('Job title')
                ->placeholder('e.g. Product Designer')
                ->maxLength(255),

            Forms\Components\Select::make('employment_type')
                ->label('Employment type')
                ->options([
                    'full_time' => 'Full-Time',
                    'part_time' => 'Part-Time',
                    'contract' => 'Contract',
                    'intern' => 'Intern',
                ])
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('hire_date')
                ->label('Hire date')
                ->required(),

            Forms\Components\Toggle::make('active')
                ->label('Active')
                ->helperText('If off, the employee is not currently active')
                ->default(true),

            Forms\Components\Toggle::make('archived')
                ->label('Archived')
                ->helperText('Archive instead of delete to preserve history')
                ->default(false),

            Forms\Components\FileUpload::make('profile_picture')
                ->label('Profile picture')
                ->image()
                ->imagePreviewHeight(60)
                ->directory('employees')
                ->hint('PNG or JPG, max 2MB'),
        ]);
    }
}
