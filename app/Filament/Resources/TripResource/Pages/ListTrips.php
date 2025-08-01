<?php

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Resources\TripResource;
use Filament\Actions;
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

    // временно отключил. код рабочий
    /*protected function getHeaderWidgets(): array
    {
        return [
            TripResource\Widgets\TripStats::class,
        ];
    }*/

}
