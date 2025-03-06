<?php

namespace App\Filament\Resources\IssueAssignmentResource\Pages;

use App\Filament\Resources\IssueAssignmentResource;
use Filament\Resources\Pages\ViewRecord;

class ViewIssueAssignment extends ViewRecord
{
    protected static string $resource = IssueAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
