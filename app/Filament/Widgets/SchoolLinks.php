<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class SchoolLinks extends Widget
{
    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.school-links';

    protected static ?int $sort = 3;
}
