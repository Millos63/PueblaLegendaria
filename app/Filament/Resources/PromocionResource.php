<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromocionResource\Pages;
use App\Models\Promocion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromocionResource extends Resource
{
    protected static ?string $model = Promocion::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationLabel = 'Promociones';
    protected static ?string $modelLabel = 'promoción';
    protected static ?string $pluralModelLabel = 'promociones';
    protected static ?string $navigationGroup = 'Contenido del sitio';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('imagen')
                ->label('Imagen')
                ->image()
                ->imageEditor()
                ->disk('public_root')
                ->directory('uploads/promociones')
                ->imageResizeMode('cover')
                ->imageResizeTargetWidth(1000)
                ->imageResizeTargetHeight(625)
                ->maxSize(6144)
                ->helperText('Foto de la promoción. Se recorta a formato horizontal.'),

            Forms\Components\TextInput::make('badge')
                ->label('Etiqueta destacada')
                ->maxLength(40)
                ->helperText('Texto corto de la píldora dorada (ej. "Mamá gratis").'),

            Forms\Components\TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(80),

            Forms\Components\Textarea::make('texto')
                ->label('Descripción')
                ->rows(3)
                ->maxLength(300),

            Forms\Components\TextInput::make('vigencia_texto')
                ->label('Vigencia (texto visible)')
                ->maxLength(60)
                ->helperText('Ej. "10 de mayo" o "Todo el año".'),

            Forms\Components\TextInput::make('cta_url')
                ->label('Enlace del botón')
                ->url()
                ->default('https://wa.me/522222650024')
                ->maxLength(255)
                ->helperText('A dónde lleva el botón "Reservar por WhatsApp".'),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\DatePicker::make('fecha_inicio')
                    ->label('Mostrar desde')
                    ->helperText('Opcional. Si se deja vacío, se muestra siempre.'),
                Forms\Components\DatePicker::make('fecha_fin')
                    ->label('Ocultar después de')
                    ->helperText('Opcional. Después de esta fecha se oculta sola.'),
            ]),

            Forms\Components\Toggle::make('activo')
                ->label('Activa (visible en el sitio)')
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
                Tables\Columns\TextColumn::make('badge')
                    ->label('Etiqueta'),
                Tables\Columns\TextColumn::make('vigencia_texto')
                    ->label('Vigencia'),
                Tables\Columns\ToggleColumn::make('activo')
                    ->label('Activa'),
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
            'index' => Pages\ListPromocions::route('/'),
            'create' => Pages\CreatePromocion::route('/create'),
            'edit' => Pages\EditPromocion::route('/{record}/edit'),
        ];
    }
}
