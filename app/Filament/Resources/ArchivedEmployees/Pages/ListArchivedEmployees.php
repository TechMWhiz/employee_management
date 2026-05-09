<?php

namespace App\Filament\Resources\ArchivedEmployees\Pages;

use App\Filament\Resources\ArchivedEmployees\ArchivedEmployeeResource;
use Filament\Resources\Pages\ListRecords;

class ListArchivedEmployees extends ListRecords
{
    protected static string $resource = ArchivedEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
