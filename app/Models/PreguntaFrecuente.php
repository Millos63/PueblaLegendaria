<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaFrecuente extends Model
{
    protected $table = 'preguntas_frecuentes';

    protected $guarded = [];

    protected $casts = ['activo' => 'boolean'];

    public function scopeVisibles($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
