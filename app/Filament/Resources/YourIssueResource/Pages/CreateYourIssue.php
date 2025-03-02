<?php

namespace App\Filament\Resources\YourIssueResource\Pages;

use App\Filament\Resources\YourIssueResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateYourIssue extends CreateRecord
{
    protected static string $resource = YourIssueResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }
}
