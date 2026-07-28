<?php

namespace App\Filament\Resources\SolicitudResource\Pages;

use App\Filament\Resources\SolicitudResource;
use App\Models\Solicitud;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSolicitud extends ViewRecord
{
    protected static string $resource = SolicitudResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('whatsapp')
                ->label('Responder por WhatsApp')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('success')
                ->url(fn (Solicitud $record) => $record->whatsappUrl())
                ->openUrlInNewTab()
                ->visible(fn (Solicitud $record) => filled($record->whatsappUrl())),
            Actions\Action::make('toggleLeido')
                ->label(fn (Solicitud $record) => $record->leido ? 'Marcar no leída' : 'Marcar leída')
                ->icon('heroicon-o-check-circle')
                ->action(fn (Solicitud $record) => $record->update(['leido' => ! $record->leido])),
        ];
    }
}
