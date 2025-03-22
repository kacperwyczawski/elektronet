<?php

namespace App\Filament\Resources\IssueResource\Pages;

use App\Filament\Resources\IssueResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListIssues extends ListRecords
{
    protected static string $resource = IssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabls = [
            'room' => Tab::make('W Twojej sali')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('room', Auth::user()->room)),
            'your' => Tab::make('Twoje zgłoszenia')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', Auth::id())),
        ];

        if (Auth::user()->isExecutor) {
            $tabls['todo'] = Tab::make('Do wykonania')
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->join('issue_assignments', 'issue_assignments.issue_id', '=', 'issues.id')
                    ->where('issue_assignments.user_id', Auth::id())
                    ->select('issues.*'));
        }

        if (Auth::user()->role === 'Dyrektor' || Auth::user()->role === 'Kierownik' || Auth::user()->isExecutor) {
            $tabls['all'] = Tab::make('Wszystkie');
        }

        return $tabls;
    }
}
