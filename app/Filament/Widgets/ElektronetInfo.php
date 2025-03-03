<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ElektronetInfo extends Widget
{
    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.elektronet-info';

    protected static ?int $sort = 2;
}
