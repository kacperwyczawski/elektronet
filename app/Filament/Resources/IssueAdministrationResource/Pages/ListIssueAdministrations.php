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
            'unapproved' => Tab::make('Niezatwierdzone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', false)->orWhere('assigned_to_id', null)),
            'in_progress' => Tab::make('W trakcie')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', true)->where('is_done', false)->where('assigned_to_id', '!=', null)),
            'done' => Tab::make('Zakończone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_done', true)),
        ];
    }
}
