<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Action;
use Filament\Actions\EditAction;

use Illuminate\Database\Eloquent\Model;

class EmployeesTable 
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->searchable(),

            Tables\Columns\TextColumn::make('department'),

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
            SelectFilter::make('employment_type')
                ->label('Employment type')
                ->options([
                    'full_time' => 'Full-Time',
                    'part_time' => 'Part-Time',
                    'contract' => 'Contract',
                    'intern' => 'Intern',
                ]),
        ])
        ->recordActions([
            EditAction::make(),

            Action::make('archive')
                ->label('Archive')
                ->action(function (Model $record) {
                    $record->update(['archived' => true]);
                })
                ->requiresConfirmation()
                ->color('warning')
                ->visible(fn (Model $record): bool => ! $record->archived),
            Action::make('restore')
                ->label('Restore')
                ->action(function (Model $record) {
                    $record->update(['archived' => false]);
                })
                ->requiresConfirmation()
                ->color('success')
                ->visible(fn (Model $record): bool => (bool) $record->archived),
            Action::make('delete_permanently')
                ->label('Delete permanently')
                ->action(function (Model $record) {
                    $record->delete();
                })
                ->requiresConfirmation()
                ->color('danger')
                ->visible(fn (Model $record): bool => (bool) $record->archived),
        ])
        ->defaultSort('name');
    }
}
