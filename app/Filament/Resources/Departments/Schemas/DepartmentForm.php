<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->label('Department Name')
                ->required()
                ->maxLength(255)
                ->dehydrated(false),

            Forms\Components\Select::make('category')
                ->label('Category')
                ->options([
                    'engineering' => 'Engineering',
                    'hr' => 'Human Resources',
                    'marketing' => 'Marketing',
                    'finance' => 'Finance',
                ])
                ->searchable()
                ->placeholder('Select a category')
                ->dehydrated(false),

            Forms\Components\Toggle::make('active')
                ->label('Active')
                ->default(true)
                ->dehydrated(false),

            Forms\Components\Textarea::make('notes')
                ->label('Notes')
                ->rows(3)
                ->dehydrated(false),
        ]);
    }
}
