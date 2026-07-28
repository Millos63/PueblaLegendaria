<?php

namespace Database\Seeders;

use App\Models\Callejoneada;
use Illuminate\Database\Seeder;

class CallejoneadaSeeder extends Seeder
{
    public function run(): void
    {
        $callejoneadas = [
            ['imagen' => 'Images/leyendas_clasico.png', 'estilo' => 'red', 'badge_icono' => 'ic-moon', 'badge' => 'Nocturno', 'icono' => 'ic-candle', 'titulo' => 'Tour de Leyendas Clásico', 'texto' => 'Las leyendas más emblemáticas de Puebla cobran vida en el Centro Histórico.'],
            ['imagen' => 'image/tour-marquesa-selva-nevada.webp', 'estilo' => 'gold', 'badge_icono' => 'ic-sun', 'badge' => 'Diurno', 'icono' => 'ic-crown', 'titulo' => 'La Marquesa de la Selva Nevada', 'texto' => 'La Marquesa y su séquito harán de tu estancia una experiencia inolvidable.'],
            ['imagen' => 'image/tour-fundacion-cholula.webp', 'estilo' => 'green', 'badge_icono' => 'ic-family', 'badge' => 'Familiar', 'icono' => 'ic-church', 'titulo' => 'Fundación de Cholula', 'texto' => 'Un paseo de la época colonial a la actualidad con personajes históricos.'],
            ['imagen' => 'image/tour-hermanos-serdan.webp', 'estilo' => 'purple', 'badge_icono' => 'ic-scroll', 'badge' => 'Histórico', 'icono' => 'ic-swords', 'titulo' => 'Los Hermanos Serdán', 'texto' => 'Descubre la verdad detrás del inicio de la Revolución Mexicana en Puebla.'],
            ['imagen' => 'image/tour-santa-inquisicion.webp', 'estilo' => 'red', 'badge_icono' => 'ic-moon', 'badge' => 'Nocturno', 'icono' => 'ic-fire', 'titulo' => 'La Santa Inquisición', 'texto' => 'EL INQUISIDOR será tu guía nocturno. Camina con cuidado entre pecados.'],
            ['imagen' => 'image/tour-divertido-leyendas.webp', 'estilo' => 'gold', 'badge_icono' => 'ic-family', 'badge' => 'Familiar', 'icono' => 'ic-masks', 'titulo' => 'Tour Divertido de Leyendas', 'texto' => 'Historias locas y divertidas donde tú también serás parte de la leyenda.'],
            ['imagen' => 'image/tour-angeles-demonios.webp', 'estilo' => 'purple', 'badge_icono' => 'ic-moon', 'badge' => 'Nocturno', 'icono' => 'ic-ghost', 'titulo' => 'Ángeles y Demonios', 'texto' => 'Poseídos y muertos vivientes en historias verdaderas de la Ciudad de los Ángeles.'],
            ['imagen' => 'image/tour-batalla-5-mayo.webp', 'estilo' => 'green', 'badge_icono' => 'ic-scroll', 'badge' => 'Histórico', 'icono' => 'ic-building', 'titulo' => 'Batalla del 5 de Mayo', 'texto' => 'Un relato distinto de la batalla más importante de Puebla.'],
            ['imagen' => 'image/tour-leyendas-estado.webp', 'estilo' => 'red', 'badge_icono' => 'ic-moon', 'badge' => 'Nocturno', 'icono' => 'ic-skull', 'titulo' => 'Leyendas del Estado', 'texto' => 'La Parca guía las leyendas más oscuras de distintos municipios poblanos.'],
            ['imagen' => 'image/tour-ex-hacienda-chautla.webp', 'estilo' => 'gold', 'badge_icono' => 'ic-family', 'badge' => 'Familiar', 'icono' => 'ic-castle', 'titulo' => 'Ex Hacienda de Chautla', 'texto' => 'Fogata, búsqueda del tesoro y sorpresas en un entorno histórico inolvidable.'],
            ['imagen' => 'image/tour-verdadera-fundacion.webp', 'estilo' => 'green', 'badge_icono' => 'ic-scroll', 'badge' => 'Histórico', 'icono' => 'ic-scroll', 'titulo' => 'La Verdadera Fundación', 'texto' => 'Fray Toribio revela dónde nació realmente Puebla. La historia oficial te sorprenderá.'],
            ['imagen' => 'image/tour-callejones-centro.webp', 'estilo' => 'purple', 'badge_icono' => 'ic-moon', 'badge' => 'Nocturno', 'icono' => 'ic-dagger', 'titulo' => 'Callejones del Centro', 'texto' => 'Una bella dama te guía por callejones oscuros llenos de personajes históricos.'],
        ];

        foreach ($callejoneadas as $orden => $callejoneada) {
            Callejoneada::firstOrCreate(
                ['titulo' => $callejoneada['titulo']],
                $callejoneada + ['cta_url' => '#contacto', 'activo' => true, 'orden' => $orden],
            );
        }
    }
}
