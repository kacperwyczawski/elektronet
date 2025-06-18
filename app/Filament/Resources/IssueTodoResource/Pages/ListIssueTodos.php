<?php

namespace App\Filament\Resources\IssueTodoResource\Pages;

use App\Filament\Resources\IssueTodoResource;
use App\Models\Issue;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListIssueTodos extends ListRecords
{
    protected static string $resource = IssueTodoResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'to_do' => Tab::make('Do wykonania')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_done', false))
                ->badge(
                    Issue::query()
                        ->where('is_done', false)
                        ->where('assigned_to_id', Auth::id())
                        ->count()),
            'pending_confirmation' => Tab::make('Oczekujące na potwierdzenie')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_done', true))
                ->badge(
                    Issue::query()
                        ->where('is_done', true)
                        ->where('assigned_to_id', Auth::id())
                        ->count()),
        ];
    }
}
