<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class TodoIssues extends Page
{
    protected static string $view = 'filament.pages.todo-issues';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    protected static ?string $navigationGroup = 'Zgłoszenia';
}
