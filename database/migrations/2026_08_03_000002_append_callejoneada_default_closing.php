<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const CONTEXT = 'Acompáñanos a descubrir los rincones, personajes e historias que hacen única esta experiencia por Puebla.';
    private const CLOSING = 'Descubre todos los detalles de esta callejoneada y vive una experiencia inolvidable por las calles de Puebla.';

    public function up(): void
    {
        DB::table('callejoneadas')
            ->where('descripcion_ampliada', 'like', '%'.self::CONTEXT.'%')
            ->where('descripcion_ampliada', 'not like', '%'.self::CLOSING.'%')
            ->orderBy('id')
            ->get(['id', 'descripcion_ampliada'])
            ->each(function (object $callejoneada): void {
                DB::table('callejoneadas')
                    ->where('id', $callejoneada->id)
                    ->update([
                        'descripcion_ampliada' => trim((string) $callejoneada->descripcion_ampliada)."\n\n".self::CLOSING,
                    ]);
            });
    }

    public function down(): void
    {
        // No se revierte para preservar cualquier edición hecha en el manejador.
    }
};
