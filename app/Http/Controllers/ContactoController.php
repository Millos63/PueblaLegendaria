<?php

namespace App\Http\Controllers;

use App\Mail\SolicitudRecibida;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'telefono' => 'required|string|max:40',
            'recorrido' => 'nullable|string|max:120',
            'personas' => 'nullable|string|max:40',
            'mensaje' => 'required|string|max:2000',
        ], [], [
            'nombre' => 'nombre',
            'email' => 'correo',
            'telefono' => 'teléfono',
            'mensaje' => 'mensaje',
        ]);

        // 1) Guardar siempre en la base de datos (bandeja del panel)
        $solicitud = Solicitud::create($datos);

        // 2) Enviar aviso por correo (si falla, la solicitud igual quedó guardada)
        try {
            Mail::to(config('mail.contacto_destino'))->send(new SolicitudRecibida($solicitud));
        } catch (\Throwable $e) {
            Log::error('No se pudo enviar el correo de contacto: '.$e->getMessage());
        }

        // 3) Preparar el envío por WhatsApp al negocio con los datos de la solicitud
        $whatsappUrl = $this->urlWhatsApp($solicitud);

        return back()
            ->with('contacto_ok', true)
            ->with('whatsapp_url', $whatsappUrl)
            ->withFragment('contacto');
    }

    /**
     * Arma el enlace wa.me con el mensaje de la solicitud ya escrito,
     * listo para enviarse al WhatsApp del negocio.
     */
    private function urlWhatsApp(Solicitud $s): string
    {
        $numero = preg_replace('/\D+/', '', (string) config('mail.contacto_whatsapp'));

        $lineas = [
            '*Nueva solicitud desde la página*',
            'Nombre: '.$s->nombre,
            'Teléfono: '.$s->telefono,
            'Email: '.$s->email,
        ];

        if (! empty($s->recorrido)) {
            $lineas[] = 'Recorrido: '.$s->recorrido;
        }
        if (! empty($s->personas)) {
            $lineas[] = 'Personas: '.$s->personas;
        }

        $lineas[] = 'Mensaje: '.$s->mensaje;

        $texto = implode("\n", $lineas);

        return 'https://wa.me/'.$numero.'?text='.rawurlencode($texto);
    }
}
