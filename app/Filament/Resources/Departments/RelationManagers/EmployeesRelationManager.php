<?php

namespace App\Filament\Resources\Departments\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employment_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }
}
