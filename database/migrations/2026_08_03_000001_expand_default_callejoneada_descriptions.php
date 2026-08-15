<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const PREVIOUS_DEFAULT = 'Descubre todos los detalles de esta callejoneada y vive una experiencia inolvidable por las calles de Puebla.';

    public function up(): void
    {
        DB::table('callejoneadas')
            ->where('descripcion_ampliada', self::PREVIOUS_DEFAULT)
            ->orderBy('id')
            ->get(['id', 'texto'])
            ->each(function (object $callejoneada): void {
                $descripcion = trim((string) $callejoneada->texto)
                    ."\n\nAcompáñanos a descubrir los rincones, personajes e historias que hacen única esta experiencia por Puebla.";

                DB::table('callejoneadas')
                    ->where('id', $callejoneada->id)
                    ->update(['descripcion_ampliada' => $descripcion]);
            });
    }

    public function down(): void
    {
        // Las descripciones pueden haberse personalizado desde el manejador;
        // no se sobrescriben al revertir esta migración.
    }
};
