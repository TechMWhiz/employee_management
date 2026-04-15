<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Project')
                    ->searchable()
                    ->placeholder('Untitled'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->placeholder('Planned'),

                Tables\Columns\TextColumn::make('department')
                    ->label('Department')
                    ->placeholder('—'),

                Tables\Columns\ViewColumn::make('assigned')
                    ->label('Assigned')
                    ->view('filament.tables.columns.assigned-dropdown'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start')
                    ->date()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('archived')
                    ->label('Archived')
                    ->boolean(),
            ])
            ->filters([
                // design-only filters
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
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
