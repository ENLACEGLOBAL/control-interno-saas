<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Controles mitigantes" subtitle="Controles vinculados a riesgos y su calificación SCI" icon="shield">
            <x-slot name="actions">
                <x-btn :href="route('controls.create')" icon="plus">Vincular control</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    @php
        $badge = [
            'Óptimo'      => ['pill' => 'bg-emerald-100 text-emerald-800', 'bar' => 'bg-emerald-500'],
            'Bueno'       => ['pill' => 'bg-cyan-100 text-cyan-800',       'bar' => 'bg-cyan-500'],
            'Débil'       => ['pill' => 'bg-orange-100 text-orange-800',   'bar' => 'bg-orange-400'],
            'Inaceptable' => ['pill' => 'bg-red-100 text-red-800',         'bar' => 'bg-red-500'],
        ];
        $typeIcon = ['Preventivo' => 'shield', 'Detectivo' => 'search', 'Correctivo' => 'check'];
    @endphp

    <div class="mx-auto max-w-7xl px-4 pb-12 pt-6 sm:px-6 lg:px-8" x-data="{ q: '' }">
        <x-card padding="p-0">
            @if ($controls->isEmpty())
                <x-empty-state icon="shield" title="Aún no hay controles registrados"
                               description="Vincula controles a tus riesgos para calcular el riesgo residual.">
                    <x-btn :href="route('controls.create')" icon="plus">Vincular primer control</x-btn>
                </x-empty-state>
            @else
                <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="relative w-full sm:max-w-xs">
                        <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />
                        <input type="search" x-model="q" placeholder="Buscar control o riesgo…" aria-label="Buscar controles"
                               class="block w-full rounded-lg border-slate-300 py-2 pl-9 text-sm placeholder-slate-400 shadow-sm focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">
                    </div>
                    <span class="text-xs text-slate-500"><strong class="text-slate-900">{{ $controls->count() }}</strong> controles</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Control</th>
                                <th>Tipo</th>
                                <th>Riesgo</th>
                                <th class="w-48">Puntaje</th>
                                <th class="!text-center">Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($controls as $control)
                                @php $b = $badge[$control->classification] ?? ['pill' => 'bg-slate-100 text-slate-700', 'bar' => 'bg-slate-400']; @endphp
                                <tr x-show="$el.dataset.search.includes(q.toLowerCase())"
                                    data-search="{{ mb_strtolower($control->name.' '.$control->type.' '.optional($control->risk)->code) }}">
                                    <td>
                                        <div class="font-semibold text-slate-900">{{ $control->name }}</div>
                                        @if ($control->area)
                                            <div class="text-xs text-slate-400">{{ $control->area->name }}</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 text-slate-600">
                                            <x-icon :name="$typeIcon[$control->type] ?? 'shield'" class="h-4 w-4 text-slate-400" /> {{ $control->type }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <span class="rounded-md bg-slate-100 px-2 py-1 font-mono text-xs font-bold text-slate-800">{{ optional($control->risk)->code ?? '—' }}</span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-slate-100">
                                                <div class="h-full rounded-full {{ $b['bar'] }}" style="width: {{ $control->total_score }}%"></div>
                                            </div>
                                            <span class="w-12 text-right text-xs font-bold text-slate-900">{{ $control->total_score }}<span class="font-normal text-slate-400">/100</span></span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap text-center">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-bold {{ $b['pill'] }}">{{ $control->classification }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap items-center justify-end gap-2 border-t border-slate-100 px-5 py-3 text-xs">
                    <a href="{{ route('matrix.dashboard') }}" class="inline-flex items-center gap-1 font-semibold text-cyan-700 hover:text-cyan-900">
                        Siguiente paso: analizar riesgo residual en la matriz <x-icon name="chevron" class="h-3.5 w-3.5" stroke="2" />
                    </a>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
