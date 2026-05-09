<?php

namespace App\Filament\Resources\Employees\Tables;

use App\Models\Department;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class EmployeesTable 
{
    public static function configure(Table $table): Table
    {
        return $table
        ->modifyQueryUsing(fn (Builder $query) => $query->active())
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

            Tables\Columns\ImageColumn::make('profile_picture'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('department_id')
                ->label('Department')
                ->options(fn () => Department::query()->orderBy('name')->pluck('name', 'id')->all())
                ->searchable(),
        ])
        ->recordActions([
            Action::make('archive')
                ->label('Archive')
                ->icon('heroicon-o-archive-box-arrow-down')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Archive Employee')
                ->modalDescription('Are you sure you want to archive this employee? They will be moved to the Archive Section and will no longer appear in the active employee list.')
                ->modalSubmitActionLabel('Yes, Archive')
                ->action(function ($record) {
                    $record->archive();

                    Notification::make()
                        ->title('Employee Archived')
                        ->body("{$record->name} has been moved to the archive.")
                        ->success()
                        ->send();
                }),
            DeleteAction::make(),
        ])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }
}
