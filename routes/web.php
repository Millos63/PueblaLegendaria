<?php

use App\Http\Controllers\ContactoController;
use App\Models\Promocion;
use App\Models\Evento;
use App\Models\Producto;
use App\Models\PreguntaFrecuente;
use App\Models\Callejoneada;
use App\Models\Servicio;
use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    // Contador de visitas: cuenta 1 vez por visitante al día.
    // Va en try/catch para que nunca tumbe la página si algo falla.
    try {
        Visita::registrar($request);
    } catch (\Throwable $e) {
        // Silencioso: el contador nunca debe romper el sitio.
    }

    return response()
        ->view('home', [
            'promociones' => Promocion::vigentes()->get(),
            'eventos' => Evento::vigentes()->get(),
            'productos' => Producto::visibles()->get(),
            'preguntasFrecuentes' => PreguntaFrecuente::visibles()->get(),
            'callejoneadas' => Callejoneada::visibles()->get(),
            'servicios' => Servicio::visibles()->get(),
        ])
        // Evita que el navegador sirva una copia vieja (con token CSRF vencido)
        // al regresar con el botón "atrás" después de ir a WhatsApp → evita el error 419.
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
});

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto');
