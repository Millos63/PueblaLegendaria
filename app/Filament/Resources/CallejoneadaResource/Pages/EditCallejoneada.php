<?php

namespace App\Filament\Resources\CallejoneadaResource\Pages;

use App\Filament\Resources\CallejoneadaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCallejoneada extends EditRecord
{
    protected static string $resource = CallejoneadaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
