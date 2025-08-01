<?php

namespace App\Filament\Resources\TripResource\Widgets;

use App\Models\Auto;
use App\Models\Driver;
use App\Models\Trip;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TripStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Trips', Trip::query()->count())
                ->description('Passengers Trips')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Garage', Auto::query()->count())
                ->description('All Autos')
                ->descriptionIcon('heroicon-o-truck')
                ->color('info'),

            Stat::make('Drivers', Driver::query()->count())
                ->description('Auto Drivers')
                ->descriptionIcon('heroicon-o-user-circle')
                ->color('info'),
        ];
    }
}
