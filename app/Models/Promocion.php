<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promociones';

    protected $guarded = [];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    /** Solo las vigentes: activas y dentro de sus fechas (si las tienen). */
    public function scopeVigentes($query)
    {
        $hoy = now()->toDateString();

        return $query->where('activo', true)
            ->where(fn ($q) => $q->whereNull('fecha_inicio')->orWhereDate('fecha_inicio', '<=', $hoy))
            ->where(fn ($q) => $q->whereNull('fecha_fin')->orWhereDate('fecha_fin', '>=', $hoy))
            ->orderBy('orden');
    }
}
