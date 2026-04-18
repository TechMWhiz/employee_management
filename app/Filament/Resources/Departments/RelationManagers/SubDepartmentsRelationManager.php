<?php

namespace App\Filament\Resources\Departments\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;

class SubDepartmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'SubDepartments';

    public function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Sub-Department')
                ->sortable(),

            Tables\Columns\TextColumn::make('employees_count')
                ->counts('employees')
                ->label('Employees')
                ->sortable(),
        ])
        ->filters([])
        ->headerActions([]) // disable create
        ->recordActions([]); // disable edit/delete
    }

}
