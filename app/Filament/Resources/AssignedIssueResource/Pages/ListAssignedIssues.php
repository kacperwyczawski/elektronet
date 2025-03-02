<?php

namespace App\Filament\Resources\AssignedIssueResource\Pages;

use App\Filament\Resources\AssignedIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssignedIssues extends ListRecords
{
    protected static string $resource = AssignedIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
