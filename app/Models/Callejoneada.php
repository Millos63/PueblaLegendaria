<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callejoneada extends Model
{
    protected $table = 'callejoneadas';

    protected $guarded = [];

    protected $casts = ['activo' => 'boolean'];

    public function scopeVisibles($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
