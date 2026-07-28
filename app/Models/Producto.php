<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $guarded = [];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function scopeVisibles($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
