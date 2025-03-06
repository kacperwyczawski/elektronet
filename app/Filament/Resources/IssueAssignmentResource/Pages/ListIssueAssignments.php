<?php

namespace App\Filament\Resources\IssueAssignmentResource\Pages;

use App\Filament\Resources\IssueAssignmentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListIssueAssignments extends ListRecords
{
    protected static string $resource = IssueAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'unapproved' => Tab::make('Niezatwierdzone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', false)),
            'approved' => Tab::make('Zatwierdzone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', true)),
        ];
    }
}
