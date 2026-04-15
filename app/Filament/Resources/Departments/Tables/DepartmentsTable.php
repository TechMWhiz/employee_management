<?php

namespace App\Filament\Resources\Departments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Facades\DB;

class DepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(function () {
                // Only show departments that have at least one employee assigned to them
                return \App\Models\Department::whereExists(function ($q) {
                    $q->select(DB::raw(1))
                        ->from('employees')
                        ->whereColumn('employees.department', 'departments.name');
                });
            })
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

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // design-only filters (no DB assumptions)
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
