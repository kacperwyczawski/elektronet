<?php

namespace App\Filament\Resources\IssueAssignmentResource\Pages;

use App\Filament\Resources\IssueAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIssueAssignment extends EditRecord
{
    protected static string $resource = IssueAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
