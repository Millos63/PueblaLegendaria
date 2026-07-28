<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CallejoneadaResource\Pages;
use App\Models\Callejoneada;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CallejoneadaResource extends Resource
{
    protected static ?string $model = Callejoneada::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Nuestras callejoneadas';
    protected static ?string $modelLabel = 'callejoneada';
    protected static ?string $pluralModelLabel = 'callejoneadas';
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
                ->directory('uploads/callejoneadas')
                ->imageResizeMode('cover')
                ->imageResizeTargetWidth(900)
                ->imageResizeTargetHeight(1200)
                ->maxSize(6144)
                ->helperText('Foto vertical para la tarjeta.'),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Select::make('estilo')
                    ->label('Color de la tarjeta')
                    ->options([
                        'red' => 'Rojo',
                        'gold' => 'Dorado',
                        'green' => 'Verde',
                        'purple' => 'Morado',
                    ])
                    ->required()
                    ->default('red')
                    ->native(false),
                Forms\Components\Select::make('icono')
                    ->label('Ícono principal')
                    ->options(config('iconos'))
                    ->searchable()
                    ->native(false),
            ]),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('badge')
                    ->label('Etiqueta')
                    ->maxLength(40)
                    ->helperText('Ej. “Nocturno”, “Familiar” o “Histórico”.'),
                Forms\Components\Select::make('badge_icono')
                    ->label('Ícono de la etiqueta')
                    ->options(config('iconos'))
                    ->searchable()
                    ->native(false),
            ]),

            Forms\Components\TextInput::make('titulo')->label('Título')->required()->maxLength(80),
            Forms\Components\Textarea::make('texto')->label('Descripción')->rows(3)->maxLength(300),
            Forms\Components\TextInput::make('cta_url')
                ->label('Enlace del botón')
                ->default('#contacto')
                ->maxLength(255),
            Forms\Components\Toggle::make('activo')->label('Activa (visible en el sitio)')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->reorderable('orden')->defaultSort('orden')->columns([
            Tables\Columns\ImageColumn::make('imagen')->label('Imagen')->disk('public_root'),
            Tables\Columns\TextColumn::make('titulo')->label('Título')->searchable(),
            Tables\Columns\TextColumn::make('badge')->label('Etiqueta'),
            Tables\Columns\TextColumn::make('estilo')->label('Color'),
            Tables\Columns\ToggleColumn::make('activo')->label('Activa'),
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
            'index' => Pages\ListCallejoneadas::route('/'),
            'create' => Pages\CreateCallejoneada::route('/create'),
            'edit' => Pages\EditCallejoneada::route('/{record}/edit'),
        ];
    }
}
