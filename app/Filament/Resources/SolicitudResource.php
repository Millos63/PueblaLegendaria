<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolicitudResource\Pages;
use App\Models\Solicitud;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SolicitudResource extends Resource
{
    protected static ?string $model = Solicitud::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Solicitudes';
    protected static ?string $navigationGroup = 'Bandeja de entrada';
    protected static ?string $modelLabel = 'solicitud';
    protected static ?string $pluralModelLabel = 'solicitudes';

    // El formulario de contacto es quien crea las solicitudes, no el panel.
    public static function canCreate(): bool
    {
        return false;
    }

    // Número de solicitudes sin leer, como globo en el menú.
    public static function getNavigationBadge(): ?string
    {
        $sinLeer = static::getModel()::where('leido', false)->count();

        return $sinLeer > 0 ? (string) $sinLeer : null;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Solicitud de reservación')->schema([
                Infolists\Components\TextEntry::make('nombre')->label('Nombre'),
                Infolists\Components\TextEntry::make('email')->label('Correo')->copyable(),
                Infolists\Components\TextEntry::make('telefono')->label('Teléfono')->copyable(),
                Infolists\Components\TextEntry::make('recorrido')->label('Recorrido de interés'),
                Infolists\Components\TextEntry::make('personas')->label('Número de personas'),
                Infolists\Components\TextEntry::make('created_at')->label('Recibida')->dateTime('d/m/Y H:i'),
                Infolists\Components\TextEntry::make('mensaje')->label('Mensaje')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\IconColumn::make('leido')
                    ->label('Leída')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Recibida')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono'),
                Tables\Columns\TextColumn::make('recorrido')
                    ->label('Recorrido')
                    ->limit(24),
                Tables\Columns\TextColumn::make('personas')
                    ->label('Personas'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('leido')->label('Leídas'),
            ])
            ->actions([
                Tables\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn (Solicitud $r) => $r->whatsappUrl())
                    ->openUrlInNewTab()
                    ->visible(fn (Solicitud $r) => filled($r->whatsappUrl())),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('toggleLeido')
                    ->label(fn (Solicitud $r) => $r->leido ? 'Marcar no leída' : 'Marcar leída')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (Solicitud $r) => $r->update(['leido' => ! $r->leido])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolicituds::route('/'),
            'view' => Pages\ViewSolicitud::route('/{record}'),
        ];
    }
}
