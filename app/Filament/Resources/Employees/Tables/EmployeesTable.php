<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Tables\Table;
use Filament\Tables;

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

            Tables\Columns\TextColumn::make('department.name') // show department name
                ->label('Department')
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
        ]);
    }
}
