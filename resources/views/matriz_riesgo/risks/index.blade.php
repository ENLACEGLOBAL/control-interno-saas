<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Inventario de riesgos" subtitle="Riesgos inherentes identificados por proceso" icon="alert">
            <x-slot name="actions">
                <x-btn :href="route('matrix.dashboard')" variant="secondary" icon="grid">Matriz de calor</x-btn>
                <x-btn :href="route('risks.create')" icon="plus">Registrar riesgo</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    @php
        $zoneBadge = [
            'Extremo'  => 'bg-red-600 text-white',
            'Alto'     => 'bg-orange-500 text-white',
            'Moderado' => 'bg-amber-400 text-slate-900',
            'Bajo'     => 'bg-emerald-500 text-white',
        ];
    @endphp

    <div class="mx-auto max-w-7xl px-4 pb-12 pt-6 sm:px-6 lg:px-8"
         x-data="{ q: '', zone: '' }">
        <x-card padding="p-0">
            @if ($risks->isEmpty())
                <x-empty-state icon="alert" title="Aún no hay riesgos identificados"
                               description="Registra los riesgos de tus procesos para evaluarlos y construir la matriz de calor.">
                    <x-btn :href="route('risks.create')" icon="plus">Registrar primer riesgo</x-btn>
                </x-empty-state>
            @else
                {{-- Filtros --}}
                <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="relative w-full sm:max-w-xs">
                        <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />
                        <input type="search" x-model="q" placeholder="Buscar por código, descripción o proceso…" aria-label="Buscar riesgos"
                               class="block w-full rounded-lg border-slate-300 py-2 pl-9 text-sm placeholder-slate-400 shadow-sm focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">
                    </div>
                    <div class="flex flex-wrap gap-1.5" role="group" aria-label="Filtrar por zona">
                        @foreach (['' => 'Todas', 'Extremo' => 'Extremo', 'Alto' => 'Alto', 'Moderado' => 'Moderado', 'Bajo' => 'Bajo'] as $value => $label)
                            <button type="button" @click="zone = '{{ $value }}'"
                                    :class="zone === '{{ $value }}' ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-600 border-slate-200 hover:border-slate-300'"
                                    class="rounded-full border px-3 py-1 text-xs font-semibold transition">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción del evento</th>
                                <th>Proceso / área</th>
                                <th class="!text-center">Score</th>
                                <th class="!text-center">Zona</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($risks as $risk)
                                <tr x-show="(zone === '' || zone === '{{ $risk->zone }}') && $el.dataset.search.includes(q.toLowerCase())"
                                    data-search="{{ mb_strtolower($risk->code.' '.$risk->description.' '.$risk->process->name.' '.$risk->process->area->name.' '.$risk->category) }}">
                                    <td class="whitespace-nowrap">
                                        <div class="font-mono text-xs font-bold text-slate-900">{{ $risk->code }}</div>
                                        <div class="mt-1 inline-flex rounded bg-slate-100 px-1.5 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-slate-500">{{ $risk->category }}</div>
                                    </td>
                                    <td class="max-w-md">
                                        <p class="line-clamp-2 text-slate-800" title="{{ $risk->description }}">{{ $risk->description }}</p>
                                    </td>
                                    <td class="text-xs">
                                        <div class="font-semibold text-slate-700">{{ $risk->process->name }}</div>
                                        <div class="text-slate-400">{{ $risk->process->area->name }}</div>
                                    </td>
                                    <td class="whitespace-nowrap text-center">
                                        <div class="text-base font-bold text-slate-900">{{ $risk->inherent_score }}</div>
                                        <div class="text-[11px] text-slate-400">P{{ $risk->probability }} × I{{ $risk->impact }}</div>
                                    </td>
                                    <td class="whitespace-nowrap text-center">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider {{ $zoneBadge[$risk->zone] ?? 'bg-slate-200 text-slate-700' }}">
                                            {{ $risk->zone }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 px-5 py-3 text-xs text-slate-500">
                    <span><strong class="text-slate-900">{{ $risks->count() }}</strong> riesgos en total</span>
                    <a href="{{ route('controls.index') }}" class="inline-flex items-center gap-1 font-semibold text-cyan-700 hover:text-cyan-900">
                        Siguiente paso: vincular controles <x-icon name="chevron" class="h-3.5 w-3.5" stroke="2" />
                    </a>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
