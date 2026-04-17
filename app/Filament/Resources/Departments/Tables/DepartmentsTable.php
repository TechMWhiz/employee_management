<?php

namespace App\Filament\Resources\Departments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Tables\Table;
<<<<<<< Updated upstream
=======
use Filament\Tables;
>>>>>>> Stashed changes

class DepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
<<<<<<< Updated upstream
            ->columns([
                //
=======
            ->query(fn () => \App\Models\Department::whereHas('employees'))
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Department')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->placeholder('General'),

                Tables\Columns\IconColumn::make('active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('employees_count')
                    ->counts('employees')
                    ->label('Employees')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
>>>>>>> Stashed changes
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                CreateAction::make(),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
