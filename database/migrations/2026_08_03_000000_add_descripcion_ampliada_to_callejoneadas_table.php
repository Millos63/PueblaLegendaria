<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const DEFAULT_DESCRIPTION = 'Descubre todos los detalles de esta callejoneada y vive una experiencia inolvidable por las calles de Puebla.';

    public function up(): void
    {
        Schema::table('callejoneadas', function (Blueprint $table) {
            $table->text('descripcion_ampliada')->nullable()->after('texto');
        });

        DB::table('callejoneadas')
            ->whereNull('descripcion_ampliada')
            ->update(['descripcion_ampliada' => self::DEFAULT_DESCRIPTION]);
    }

    public function down(): void
    {
        Schema::table('callejoneadas', function (Blueprint $table) {
            $table->dropColumn('descripcion_ampliada');
        });
    }
};
