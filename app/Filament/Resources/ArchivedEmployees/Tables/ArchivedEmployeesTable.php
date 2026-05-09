<?php

namespace App\Filament\Resources\ArchivedEmployees\Tables;

use App\Models\Department;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ArchivedEmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->archived())
            ->columns([
                Tables\Columns\ImageColumn::make('profile_picture')
                    ->label('Photo')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),

                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->getStateUsing(fn ($record) => $record->department?->name ?? $record->getAttribute('department') ?? '—')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job Title')
                    ->searchable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('employment_type')
                    ->label('Type')
                    ->badge(),

                Tables\Columns\TextColumn::make('hire_date')
                    ->label('Hire Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('archived_at')
                    ->label('Archived On')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->color('danger')
                    ->icon('heroicon-o-archive-box'),
            ])
            ->defaultSort('archived_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('department_id')
                    ->label('Department')
                    ->options(fn () => Department::query()->orderBy('name')->pluck('name', 'id')->all())
                    ->searchable(),

                Tables\Filters\SelectFilter::make('employment_type')
                    ->label('Employment Type')
                    ->options([
                        'full_time' => 'Full-Time',
                        'part_time' => 'Part-Time',
                        'contract' => 'Contract',
                        'intern' => 'Intern',
                    ]),
            ])
            ->recordActions([
                Action::make('retrieve')
                    ->label('Retrieve')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Retrieve Employee')
                    ->modalDescription('Are you sure you want to retrieve this employee? They will be restored to the active employee list with all their original information.')
                    ->modalSubmitActionLabel('Yes, Retrieve')
                    ->action(function ($record) {
                        $record->retrieve();

                        Notification::make()
                            ->title('Employee Retrieved')
                            ->body("{$record->name} has been restored to the active employee list.")
                            ->success()
                            ->send();
                    }),

                Action::make('delete_permanently')
                    ->label('Delete Permanently')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Permanently Delete Employee')
                    ->modalDescription('⚠️ This action cannot be undone. The employee record will be completely removed from the system database. Are you absolutely sure?')
                    ->modalSubmitActionLabel('Yes, Delete Permanently')
                    ->action(function ($record) {
                        $employeeName = $record->name;
                        $record->forceDelete();

                        Notification::make()
                            ->title('Employee Permanently Deleted')
                            ->body("{$employeeName} has been permanently removed from the system.")
                            ->danger()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulk_retrieve')
                        ->label('Retrieve Selected')
                        ->icon('heroicon-o-arrow-uturn-left')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Retrieve Selected Employees')
                        ->modalDescription('Are you sure you want to retrieve all selected employees back to the active list?')
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            $records->each(fn ($record) => $record->retrieve());

                            Notification::make()
                                ->title('Employees Retrieved')
                                ->body($records->count() . ' employee(s) have been restored to the active list.')
                                ->success()
                                ->send();
                        }),

                    BulkAction::make('bulk_delete_permanently')
                        ->label('Delete Selected Permanently')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Permanently Delete Selected Employees')
                        ->modalDescription('⚠️ This action cannot be undone. All selected employee records will be permanently removed from the system.')
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            $count = $records->count();
                            $records->each(fn ($record) => $record->forceDelete());

                            Notification::make()
                                ->title('Employees Permanently Deleted')
                                ->body("{$count} employee(s) have been permanently removed from the system.")
                                ->danger()
                                ->send();
                        }),
                ]),
            ]);
    }
}
