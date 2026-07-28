<?php

namespace Database\Seeders;

use App\Models\Promocion;
use App\Models\Evento;
use App\Models\Producto;
use App\Models\PreguntaFrecuente;
use Illuminate\Database\Seeder;

class ContenidoInicialSeeder extends Seeder
{
    public function run(): void
    {
        $wa = 'https://wa.me/522222650024';

        // Evita duplicar si se corre más de una vez
        Promocion::truncate();
        Evento::truncate();
        Producto::truncate();
        PreguntaFrecuente::truncate();

        // ---- PROMOCIONES ----
        $promos = [
            ['imagen' => 'image/tour-fundacion-cholula.webp', 'badge' => 'Mamá gratis', 'titulo' => 'Día de las Madres', 'texto' => 'Mamá entra gratis acompañada de su hijo, con boleto pagado.', 'vigencia_texto' => '10 de mayo'],
            ['imagen' => 'image/tour-ex-hacienda-chautla.webp', 'badge' => 'Papá gratis', 'titulo' => 'Día del Padre', 'texto' => 'Papá entra gratis acompañado de un hijo que pague su boleto.', 'vigencia_texto' => 'Tercer domingo de junio'],
            ['imagen' => 'image/tour-divertido-leyendas.webp', 'badge' => 'Niños gratis', 'titulo' => 'Menores de 7 años', 'texto' => 'Los niños menores de 7 años entran gratis a nuestros recorridos.', 'vigencia_texto' => 'Todo el año'],
        ];
        foreach ($promos as $i => $p) {
            Promocion::create($p + ['cta_url' => $wa, 'activo' => true, 'orden' => $i]);
        }

        // ---- EVENTOS DE TEMPORADA ----
        $eventos = [
            ['imagen' => 'image/tour-santa-inquisicion.webp', 'fecha_icono' => 'ic-pumpkin', 'fecha_texto' => '31 Oct', 'icono' => 'ic-ghost', 'titulo' => 'Especial de Halloween', 'texto' => 'Una noche de terror actuado por las calles más oscuras del Centro Histórico.'],
            ['imagen' => 'image/tour-leyendas-estado.webp', 'fecha_icono' => 'ic-skull', 'fecha_texto' => '1-2 Nov', 'icono' => 'ic-flower', 'titulo' => 'Ruta de Día de Muertos', 'texto' => 'La Parca te guía entre ofrendas, leyendas y tradiciones poblanas en una experiencia única.'],
            ['imagen' => 'image/tour-angeles-demonios.webp', 'fecha_icono' => 'ic-calendar', 'fecha_texto' => 'Todo el año', 'icono' => 'ic-masks', 'titulo' => 'Eventos Privados', 'texto' => 'Recorridos exclusivos para empresas, escuelas y grupos cerrados con fecha a tu medida.'],
        ];
        foreach ($eventos as $i => $e) {
            Evento::create($e + ['cta_url' => $wa, 'activo' => true, 'orden' => $i]);
        }

        // ---- TIENDA ----
        $productos = [
            ['imagen' => 'image/tour-leyendas-clasico.webp', 'icono' => 'ic-cap', 'titulo' => 'Gorras', 'texto' => 'Gorras bordadas con la marca Puebla Legendaria.'],
            ['imagen' => 'image/tour-divertido-leyendas.webp', 'icono' => 'ic-shirt', 'titulo' => 'Playeras', 'texto' => 'Playeras con diseños de nuestras leyendas y personajes.'],
            ['imagen' => 'image/tour-marquesa-selva-nevada.webp', 'icono' => 'ic-gift', 'titulo' => 'Accesorios', 'texto' => 'Llaveros, recuerdos y detalles inspirados en Puebla.'],
        ];
        foreach ($productos as $i => $pr) {
            Producto::create($pr + ['cta_url' => $wa, 'activo' => true, 'orden' => $i]);
        }

        // ---- PREGUNTAS FRECUENTES ----
        $preguntas = [
            ['pregunta' => '¿La callejoneada es caminando?', 'respuesta' => 'Sí. Es un recorrido a pie, al aire libre, por las calles y callejones del Centro Histórico. No es un espectáculo en un lugar cerrado.'],
            ['pregunta' => '¿Cuánto dura el recorrido?', 'respuesta' => 'La mayoría de los recorridos dura aproximadamente entre 1.5 y 2 horas, dependiendo del tema elegido.'],
            ['pregunta' => '¿Es apto para niños?', 'respuesta' => 'Tenemos recorridos familiares pensados para todas las edades. Los recorridos nocturnos de terror se recomiendan para público mayor.'],
            ['pregunta' => '¿Qué pasa si llueve?', 'respuesta' => 'En caso de lluvia te contactamos para reprogramar tu recorrido a otra fecha sin costo adicional.'],
            ['pregunta' => '¿Dónde es el punto de reunión?', 'respuesta' => 'El punto de reunión se confirma al reservar, generalmente en el Centro Histórico de Puebla. Te enviamos la ubicación exacta por WhatsApp.'],
            ['pregunta' => '¿Cómo reservo?', 'respuesta' => 'Puedes reservar por WhatsApp, llamada telefónica o el formulario de contacto de esta página. Elige recorrido, fecha y número de personas.'],
        ];
        foreach ($preguntas as $i => $pregunta) {
            PreguntaFrecuente::create($pregunta + ['activo' => true, 'orden' => $i]);
        }
    }
}
