<?php

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Resources\TripResource;
use App\Models\Trip;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTrips extends ListRecords
{
    protected static string $resource = TripResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'bus' => Tab::make('Bus')
                ->query(fn() => Trip::whereHas('auto', function ($query) {
                    $query->where('type', 'bus');
                })),
            'truck' => Tab::make('Truck')
                ->query(fn() => Trip::whereHas('auto', function ($query) {
                    $query->where('type', 'truck');
                })),
            'long' => Tab::make('Long')
                ->query(fn() => Trip::whereHas('auto', function ($query) {
                    $query->where('type', 'long_vehicle');
                })),

            //'bus' => Tab::make('Bus')->query(fn ($query) => $query->where('auto_id', 1)->orWhere('auto_id', 2)),
            //'truck' => Tab::make('Truck')->query(fn ($query) => $query->where('status', 'truck')),
            //'long' => Tab::make('Long')->query(fn ($query) => $query->where('status', 'shipped')),
        ];
    }

    // временно отключил. код рабочий
    /*protected function getHeaderWidgets(): array
    {
        return [
            TripResource\Widgets\TripStats::class,
        ];
    }*/

}
