<?php

namespace App\Filament\Widgets;

use App\Models\Visita;
use Filament\Widgets\ChartWidget;

class VisitasChart extends ChartWidget
{
    protected static ?string $heading = 'Visitas por día (últimos 30 días)';

    // Debajo de los recuadros de resumen.
    protected static ?int $sort = -2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $dias = collect(range(29, 0))->map(fn ($i) => today()->subDays($i));

        $porDia = Visita::query()
            ->selectRaw('fecha, COUNT(*) as c')
            ->where('fecha', '>=', today()->subDays(29)->toDateString())
            ->groupBy('fecha')
            ->pluck('c', 'fecha');

        $data = $dias->map(fn ($d) => (int) ($porDia[$d->toDateString()] ?? 0));
        $labels = $dias->map(fn ($d) => $d->format('d/m'));

        return [
            'datasets' => [
                [
                    'label' => 'Visitas únicas',
                    'data' => $data->all(),
                    'borderColor' => '#d9971f',
                    'backgroundColor' => 'rgba(217, 151, 31, 0.15)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
