<?php

namespace App\Filament\Resources\IssueResource\Pages;

use App\Filament\Resources\IssueResource;
use App\Models\Issue;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListIssues extends ListRecords
{
    protected static string $resource = IssueResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Wszystkie'),
            'not_approved' => Tab::make('Do Zatwierdzenia')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', false))
                ->badge(Issue::query()->where('is_approved', false)->count()),
            'approved' => Tab::make('Zatwierdzone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', true)),
        ];
    }
}
