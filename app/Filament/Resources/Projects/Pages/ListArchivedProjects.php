<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;

class ListArchivedProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getTableQuery(): Builder
    {
        return Project::query()->where('archived', '=', true);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
