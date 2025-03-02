<?php

namespace App\Filament\Resources\YourIssueResource\Pages;

use App\Filament\Resources\YourIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYourIssue extends EditRecord
{
    protected static string $resource = YourIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
