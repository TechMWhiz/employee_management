<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
<<<<<<< Updated upstream
        return $schema
            ->components([
                //
            ]);
=======
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->label('Department Name')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('category')
                ->label('Category')
                ->options([
                    'engineering' => 'Engineering',
                    'hr' => 'Human Resources',
                    'marketing' => 'Marketing',
                    'finance' => 'Finance',
                ])
                ->searchable()
                ->placeholder('Select a category'),

            Forms\Components\Toggle::make('active')
                ->label('Active')
                ->default(true),
        ]);
>>>>>>> Stashed changes
    }
}
