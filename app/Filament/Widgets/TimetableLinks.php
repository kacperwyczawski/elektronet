<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TimetableLinks extends Widget
{
    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.timetable-links';

    protected static ?int $sort = 4;
}
