<?php

namespace App\Filament\Resources\IssueResource\Pages;

use App\Filament\Resources\IssueResource;
use App\Models\IssueAssignment;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateIssue extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $assignment = new IssueAssignment;
        $issue = static::getModel()::create($data);
        $assignment->issue_id = $issue->id;
        $assignment->save();

        return $issue;
    }

    protected static string $resource = IssueResource::class;
}
