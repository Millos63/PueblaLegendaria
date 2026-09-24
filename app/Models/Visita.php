<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Visita extends Model
{
    protected $table = 'visitas';

    public $timestamps = false;

    protected $fillable = ['fecha', 'visitante', 'created_at'];

    /**
     * Registra una visita ÚNICA POR DÍA: la misma persona cuenta 1 sola vez al día.
     *
     * No se guarda la IP. Se guarda una huella hasheada (IP + navegador + fecha)
     * que además cambia cada día, así que no permite rastrear a nadie.
     * El índice único (fecha, visitante) + insertOrIgnore impide duplicados.
     */
    public static function registrar(Request $request): void
    {
        $fecha = now()->toDateString();

        $huella = hash('sha256', $fecha.'|'.$request->ip().'|'.(string) $request->userAgent());

        static::query()->insertOrIgnore([
            'fecha' => $fecha,
            'visitante' => $huella,
            'created_at' => now(),
        ]);
    }
}
