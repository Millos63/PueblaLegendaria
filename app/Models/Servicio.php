<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';

    protected $guarded = [];

    protected $casts = ['activo' => 'boolean'];

    public function scopeVisibles($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
