<?php

namespace App\Filament\Resources\PreguntaFrecuenteResource\Pages;

use App\Filament\Resources\PreguntaFrecuenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreguntaFrecuentes extends ListRecords
{
    protected static string $resource = PreguntaFrecuenteResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
