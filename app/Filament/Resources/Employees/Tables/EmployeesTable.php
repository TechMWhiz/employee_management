<?php

namespace App\Filament\Resources\Employees\Tables;

use App\Models\Department;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables;

class EmployeesTable 
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->searchable(),

            Tables\Columns\TextColumn::make('department.name')
                ->label('Department')
                ->getStateUsing(fn ($record) => $record->department?->name ?? $record->getAttribute('department'))
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('job_title'),

            Tables\Columns\TextColumn::make('employment_type')
                ->badge(),

            Tables\Columns\TextColumn::make('hire_date')
                ->date(),

            Tables\Columns\IconColumn::make('active')
                ->boolean(),

            Tables\Columns\IconColumn::make('inactive')
                ->boolean(),

            Tables\Columns\IconColumn::make('archived')
                ->boolean(),

            Tables\Columns\ImageColumn::make('profile_picture'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('department_id')
                ->label('Department')
                ->options(fn () => Department::query()->orderBy('name')->pluck('name', 'id')->all())
                ->searchable(),
        ])
        ->recordActions([
            DeleteAction::make(),
        ])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }
}
