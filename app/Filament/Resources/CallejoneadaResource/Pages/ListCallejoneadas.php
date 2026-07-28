<?php

namespace App\Filament\Resources\CallejoneadaResource\Pages;

use App\Filament\Resources\CallejoneadaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCallejoneadas extends ListRecords
{
    protected static string $resource = CallejoneadaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
