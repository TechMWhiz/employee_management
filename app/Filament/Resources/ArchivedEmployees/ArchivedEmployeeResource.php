<?php

namespace App\Filament\Resources\ArchivedEmployees;

use App\Filament\Resources\ArchivedEmployees\Pages\ListArchivedEmployees;
use App\Filament\Resources\ArchivedEmployees\Tables\ArchivedEmployeesTable;
use App\Models\Employee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ArchivedEmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    // Sidebar label
    protected static ?string $navigationLabel = 'Archive';

    // Sidebar icon
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';

    // Sidebar sort order
    protected static ?int $navigationSort = 3;

    // Slug for URL
    protected static ?string $slug = 'archived-employees';

    // Plural model label (used in breadcrumbs, page titles, etc.)
    protected static ?string $pluralModelLabel = 'Archived Employees';

    // Singular model label
    protected static ?string $modelLabel = 'Archived Employee';

    public static function table(Table $table): Table
    {
        return ArchivedEmployeesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArchivedEmployees::route('/'),
        ];
    }

    /**
     * Disable the create button - archived employees can't be created directly.
     */
    public static function canCreate(): bool
    {
        return false;
    }
}
