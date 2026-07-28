<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            ['icono' => 'ic-dress', 'titulo' => 'Venta y renta de vestuario', 'texto' => 'Trajes de época y personajes listos para tu evento o producción.'],
            ['icono' => 'ic-toast', 'titulo' => 'Eventos privados', 'texto' => 'Recorridos y experiencias exclusivas para tu grupo, empresa o escuela.'],
            ['icono' => 'ic-dance', 'titulo' => 'Edecanes y chinas poblanas', 'texto' => 'Personal caracterizado para recibir y acompañar a tus invitados.'],
            ['icono' => 'ic-masks', 'titulo' => 'Caracterizaciones y fiestas temáticas', 'texto' => 'Ambientamos tu fiesta con personajes y la época que elijas.'],
            ['icono' => 'ic-ring', 'titulo' => 'Pedida de mano', 'texto' => 'Convierte tu propuesta en una leyenda que nadie olvidará.'],
            ['icono' => 'ic-scroll', 'titulo' => 'Recorridos con guías certificados', 'texto' => 'Recorridos culturales guiados por profesionales certificados.'],
            ['icono' => 'ic-trumpet', 'titulo' => 'Pasacalles con música', 'texto' => 'Música en vivo y color recorriendo las calles con tu celebración.'],
            ['icono' => 'ic-bride', 'titulo' => 'Mojigangas para boda', 'texto' => 'Los gigantes tradicionales que hacen inolvidable tu boda.'],
            ['icono' => 'ic-bus', 'titulo' => 'Servicio en Turibus', 'texto' => 'Lleva la experiencia legendaria a bordo del Turibus.'],
        ];

        foreach ($servicios as $orden => $servicio) {
            Servicio::firstOrCreate(
                ['titulo' => $servicio['titulo']],
                $servicio + ['activo' => true, 'orden' => $orden],
            );
        }
    }
}
