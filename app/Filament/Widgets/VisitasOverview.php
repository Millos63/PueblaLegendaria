<?php

namespace App\Filament\Widgets;

use App\Models\Visita;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitasOverview extends BaseWidget
{
    // Aparece hasta arriba del panel.
    protected static ?int $sort = -3;

    protected function getStats(): array
    {
        $hoy = today()->toDateString();

        // Conteo por día de los últimos 7 días (para hoy, la semana y la mini gráfica).
        $dias = collect(range(6, 0))->map(fn ($i) => today()->subDays($i)->toDateString());

        $porDia = Visita::query()
            ->selectRaw('fecha, COUNT(*) as c')
            ->whereIn('fecha', $dias)
            ->groupBy('fecha')
            ->pluck('c', 'fecha');

        $serie = $dias->map(fn ($d) => (int) ($porDia[$d] ?? 0))->all();

        $visitasHoy = (int) ($porDia[$hoy] ?? 0);
        $visitasSemana = array_sum($serie);
        $visitasTotales = Visita::count();

        return [
            Stat::make('Visitas hoy', $visitasHoy)
                ->description('Visitantes únicos de hoy')
                ->descriptionIcon('heroicon-m-user')
                ->color('success')
                ->chart($serie),

            Stat::make('Últimos 7 días', $visitasSemana)
                ->description('Únicos por día, sumados')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),

            Stat::make('Visitas totales', $visitasTotales)
                ->description('Total desde el inicio (todas las fechas)')
                ->descriptionIcon('heroicon-m-chart-bar'),
        ];
    }
}
