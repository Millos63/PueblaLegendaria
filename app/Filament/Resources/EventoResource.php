<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventoResource\Pages;
use App\Models\Evento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventoResource extends Resource
{
    protected static ?string $model = Evento::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Eventos de temporada';
    protected static ?string $modelLabel = 'evento';
    protected static ?string $pluralModelLabel = 'eventos';
    protected static ?string $navigationGroup = 'Contenido del sitio';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('imagen')
                ->label('Imagen')
                ->image()
                ->imageEditor()
                ->disk('public_root')
                ->directory('uploads/eventos')
                ->imageResizeMode('cover')
                ->imageResizeTargetWidth(900)
                ->imageResizeTargetHeight(1200)
                ->maxSize(6144)
                ->helperText('Foto del evento (formato vertical).'),

            Forms\Components\TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(80),

            Forms\Components\Textarea::make('texto')
                ->label('Descripción')
                ->rows(3)
                ->maxLength(300),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Select::make('fecha_icono')
                    ->label('Ícono de la fecha')
                    ->options(config('iconos'))
                    ->searchable()
                    ->native(false),
                Forms\Components\TextInput::make('fecha_texto')
                    ->label('Fecha (texto)')
                    ->maxLength(40)
                    ->helperText('Ej. "31 Oct" o "Todo el año".'),
            ]),

            Forms\Components\Select::make('icono')
                ->label('Ícono principal')
                ->options(config('iconos'))
                ->searchable()
                ->native(false),

            Forms\Components\TextInput::make('cta_url')
                ->label('Enlace del botón')
                ->url()
                ->default('https://wa.me/522222650024')
                ->maxLength(255),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\DatePicker::make('fecha_inicio')
                    ->label('Mostrar desde')
                    ->helperText('Opcional.'),
                Forms\Components\DatePicker::make('fecha_fin')
                    ->label('Ocultar después de')
                    ->helperText('Opcional. Se oculta solo tras esta fecha.'),
            ]),

            Forms\Components\Toggle::make('activo')
                ->label('Activo (visible en el sitio)')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('orden')
            ->defaultSort('orden')
            ->columns([
                Tables\Columns\ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->disk('public_root'),
                Tables\Columns\TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_texto')
                    ->label('Fecha'),
                Tables\Columns\ToggleColumn::make('activo')
                    ->label('Activo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEventos::route('/'),
            'create' => Pages\CreateEvento::route('/create'),
            'edit' => Pages\EditEvento::route('/{record}/edit'),
        ];
    }
}
