<?php

namespace App\Filament\Widgets;

use App\Models\Achievement;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AchievementsChart extends ChartWidget
{
    protected static ?string $heading = 'Osiągnięcia na miesiąc';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = null;

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $now = now();

        if ($now->month >= 9) {
            $start = Carbon::create($now->year, 9, 1);
            $end = Carbon::create($now->year + 1, 6, 30);
        } else {
            $start = Carbon::create($now->year - 1, 9, 1);
            $end = Carbon::create($now->year, 6, 30);
        }

        $data = Trend::model(Achievement::class)
            ->dateColumn('achieved_at')
            ->between(
                start: $start,
                end: $end,
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
