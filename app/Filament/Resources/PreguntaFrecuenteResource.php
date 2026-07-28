<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreguntaFrecuenteResource\Pages;
use App\Models\PreguntaFrecuente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PreguntaFrecuenteResource extends Resource
{
    protected static ?string $model = PreguntaFrecuente::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Preguntas frecuentes';
    protected static ?string $modelLabel = 'pregunta frecuente';
    protected static ?string $pluralModelLabel = 'preguntas frecuentes';
    protected static ?string $navigationGroup = 'Contenido del sitio';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('pregunta')->label('Pregunta')->required()->maxLength(255),
            Forms\Components\Textarea::make('respuesta')->label('Respuesta')->required()->rows(5),
            Forms\Components\Toggle::make('activo')->label('Activo (visible en el sitio)')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->reorderable('orden')->defaultSort('orden')->columns([
            Tables\Columns\TextColumn::make('pregunta')->label('Pregunta')->searchable()->limit(80),
            Tables\Columns\TextColumn::make('respuesta')->label('Respuesta')->limit(100),
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
            'index' => Pages\ListPreguntaFrecuentes::route('/'),
            'create' => Pages\CreatePreguntaFrecuente::route('/create'),
            'edit' => Pages\EditPreguntaFrecuente::route('/{record}/edit'),
        ];
    }
}
