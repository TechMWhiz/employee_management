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
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('department')
                ->maxLength(255),

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
