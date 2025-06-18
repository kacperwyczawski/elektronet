<?php

namespace App\Filament\Resources\IssueAdministrationResource\Pages;

use App\Filament\Resources\IssueAdministrationResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListIssueAdministrations extends ListRecords
{
    protected static string $resource = IssueAdministrationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'unassigned' => Tab::make('Nieprzypisane')->modifyQueryUsing(
                fn (Builder $query) => $query->whereNull('assigned_to_id')
            ),
            'in_progress' => Tab::make('W trakcie')->modifyQueryUsing(
                fn (Builder $query) => $query
                    ->where('is_done', false)
                    ->whereNotNull('assigned_to_id')
            ),
            'done' => Tab::make('Wykonane (do potwierdzenia)')->modifyQueryUsing(
                fn (Builder $query) => $query->where('is_done', true)
            ),
        ];
    }
}
