<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $guarded = [];

    protected $casts = [
        'leido' => 'boolean',
    ];

    /** Enlace de WhatsApp al visitante, con mensaje ya escrito. */
    public function whatsappUrl(): ?string
    {
        $num = preg_replace('/\D+/', '', (string) $this->telefono);

        if ($num === '') {
            return null;
        }

        // Número de 10 dígitos (México sin lada país) → anteponer 52.
        if (strlen($num) === 10) {
            $num = '52'.$num;
        }

        $texto = '¡Hola '.$this->nombre.'! Te contactamos de Puebla Legendaria por tu solicitud'
            .($this->recorrido ? ' del recorrido "'.$this->recorrido.'"' : '').'. ';

        return 'https://wa.me/'.$num.'?text='.rawurlencode($texto);
    }
}
