<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Tienda';
    protected static ?string $modelLabel = 'producto';
    protected static ?string $pluralModelLabel = 'productos';
    protected static ?string $navigationGroup = 'Contenido del sitio';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('imagen')
                ->label('Imagen')
                ->image()
                ->imageEditor()
                ->disk('public_root')
                ->directory('uploads/tienda')
                ->imageResizeMode('cover')
                ->imageResizeTargetWidth(1000)
                ->imageResizeTargetHeight(750)
                ->maxSize(6144)
                ->helperText('Foto del producto.'),

            Forms\Components\Select::make('icono')
                ->label('Ícono')
                ->options(config('iconos'))
                ->searchable()
                ->native(false),

            Forms\Components\TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(80),

            Forms\Components\Textarea::make('texto')
                ->label('Descripción')
                ->rows(3)
                ->maxLength(300),

            Forms\Components\TextInput::make('cta_url')
                ->label('Enlace del botón')
                ->url()
                ->default('https://wa.me/522222650024')
                ->maxLength(255),

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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
