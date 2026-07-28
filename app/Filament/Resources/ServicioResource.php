<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicioResource\Pages;
use App\Models\Servicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServicioResource extends Resource
{
    protected static ?string $model = Servicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Servicios extras';
    protected static ?string $modelLabel = 'servicio extra';
    protected static ?string $pluralModelLabel = 'servicios extras';
    protected static ?string $navigationGroup = 'Contenido del sitio';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('icono')
                ->label('Ícono')
                ->options(config('iconos'))
                ->searchable()
                ->native(false)
                ->helperText('Ícono que aparece arriba de la tarjeta.'),
            Forms\Components\TextInput::make('titulo')->label('Título')->required()->maxLength(80),
            Forms\Components\Textarea::make('texto')->label('Descripción')->rows(3)->maxLength(300),
            Forms\Components\Toggle::make('activo')->label('Activo (visible en el sitio)')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->reorderable('orden')->defaultSort('orden')->columns([
            Tables\Columns\TextColumn::make('titulo')->label('Título')->searchable(),
            Tables\Columns\TextColumn::make('icono')->label('Ícono'),
            Tables\Columns\ToggleColumn::make('activo')->label('Activo'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicios::route('/'),
            'create' => Pages\CreateServicio::route('/create'),
            'edit' => Pages\EditServicio::route('/{record}/edit'),
        ];
    }
}
