<?php

namespace App\Filament\Resources\PreguntaFrecuenteResource\Pages;

use App\Filament\Resources\PreguntaFrecuenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreguntaFrecuente extends EditRecord
{
    protected static string $resource = PreguntaFrecuenteResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
