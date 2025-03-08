<?php

namespace App\Filament\Resources\CompetitionAchievementResource\Pages;

use App\Filament\Resources\CompetitionAchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompetitionAchievement extends ViewRecord
{
    protected static string $resource = CompetitionAchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
