<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select; 
use Filament\Forms\Components\Toggle;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Department Name')
                ->required()
                ->maxLength(255),

            Select::make('category')
                ->label('Category')
                ->options([
                    'engineering' => 'Engineering',
                    'hr' => 'Human Resources',
                    'marketing' => 'Marketing',
                    'finance' => 'Finance',
                ])
                ->searchable()
                ->placeholder('Select a category'),

            Toggle::make('active')
                ->label('Active')
                ->default(true),
        ]);
    }
}
