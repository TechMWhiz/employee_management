<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action as HeaderAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            HeaderAction::make('archived')
                ->label('Archived')
                ->url(route('filament.admin.resources.projects.archived')),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Project::query()->where('archived', '=', false);
    }

    protected function getEmptyStateHeading(): ?string
    {
        return 'No projects yet';
    }

    protected function getEmptyStateDescription(): ?string
    {
        return 'Add a project to track progress, status, and ownership.';
    }

    protected function getEmptyStateActions(): array
    {
        return [
            CreateAction::make()->label('Create project'),
        ];
    }
}
