<?php

namespace App\Filament\Resources\CompetitionAchievementResource\Pages;

use App\Filament\Resources\CompetitionAchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompetitionAchievements extends ListRecords
{
    protected static string $resource = CompetitionAchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
