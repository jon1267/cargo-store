<?php

namespace App\Filament\Resources\TripResource\Widgets;

use App\Models\Trip;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TripStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Passengers', Trip::query()->count()),
        ];
    }
}
