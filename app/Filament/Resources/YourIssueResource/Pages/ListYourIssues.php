<?php

namespace App\Filament\Resources\YourIssueResource\Pages;

use App\Filament\Resources\YourIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYourIssues extends ListRecords
{
    protected static string $resource = YourIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
