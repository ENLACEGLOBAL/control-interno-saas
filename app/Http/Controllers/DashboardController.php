<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Control;
use App\Models\Process;
use App\Models\Risk;
use App\Services\TenantContext;

class DashboardController extends Controller
{
    public function __invoke(TenantContext $context)
    {
        if (! $context->hasTenant()) {
            return view('dashboard', ['tenant' => null]);
        }

        // Mismas consultas que usan los módulos, para que los totales coincidan con cada listado.
        $risks = Risk::with('process.area', 'controls')->get();
        $controls = Control::all();

        $zones = ['Extremo' => 0, 'Alto' => 0, 'Moderado' => 0, 'Bajo' => 0];
        foreach ($risks as $risk) {
            $zones[$risk->zone]++;
        }

        $classifications = ['Óptimo' => 0, 'Bueno' => 0, 'Débil' => 0, 'Inaceptable' => 0];
        foreach ($controls as $control) {
            $classifications[$control->classification]++;
        }

        return view('dashboard', [
            'tenant'          => $context->getTenant(),
            'stats'           => [
                'areas'     => Area::count(),
                'processes' => Process::count(),
                'risks'     => $risks->count(),
                'controls'  => $controls->count(),
            ],
            'zones'           => $zones,
            'classifications' => $classifications,
            'topRisks'        => $risks->sortByDesc('inherent_score')->take(5)->values(),
            'uncontrolled'    => $risks->filter(fn ($r) => $r->controls->isEmpty())->count(),
        ]);
    }
}
