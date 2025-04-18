<?php

namespace App\Filament\Resources\IssueResource\Pages;

use App\Filament\Resources\IssueResource;
use Filament\Actions;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditIssue extends EditRecord
{
    protected static string $resource = IssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
