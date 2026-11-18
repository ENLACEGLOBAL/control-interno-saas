<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Matriz de calor" subtitle="Exposición inherente vs. residual según metodología COSO" icon="grid">
            <x-slot name="actions">
                <x-btn :href="route('risks.create')" variant="secondary" icon="plus">Riesgo</x-btn>
                <x-btn :href="route('controls.create')" icon="plus">Control</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    @php
        $probLabels = [5 => 'Casi cierto', 4 => 'Probable', 3 => 'Posible', 2 => 'Rara vez', 1 => 'Improbable'];
        $impLabels  = [1 => 'Insignificante', 2 => 'Menor', 3 => 'Moderado', 4 => 'Mayor', 5 => 'Catastrófico'];
        $cellZone = function ($score) {
            if ($score >= 13) return 'bg-red-600 text-white';
            if ($score >= 6)  return 'bg-orange-500 text-white';
            if ($score >= 2)  return 'bg-amber-300 text-slate-900';
            return 'bg-emerald-500 text-white';
        };
        $maps = [
            ['key' => 'inherent_risks', 'title' => 'Exposición inherente', 'desc' => 'Ubicación natural del riesgo antes de evaluar controles.', 'icon' => 'alert',  'accent' => 'text-red-600 bg-red-50'],
            ['key' => 'residual_risks', 'title' => 'Exposición residual',  'desc' => 'Nivel real tras aplicar los controles mitigantes.',        'icon' => 'shield', 'accent' => 'text-emerald-600 bg-emerald-50'],
        ];
    @endphp

    <div class="mx-auto max-w-7xl space-y-6 px-4 pb-12 pt-6 sm:px-6 lg:px-8" x-data="{ modalAbierto: null }" @keydown.escape.window="modalAbierto = null">

        @if ($risks->isEmpty())
            <x-card>
                <x-empty-state icon="grid" title="La matriz está vacía"
                               description="Registra riesgos y vincula controles para visualizar la exposición inherente y residual.">
                    <x-btn :href="route('risks.create')" icon="plus">Registrar riesgo</x-btn>
                </x-empty-state>
            </x-card>
        @else
            {{-- Leyenda --}}
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 rounded-xl border border-slate-200/80 bg-white px-4 py-3 text-xs text-slate-600 shadow-sm">
                <span class="font-semibold uppercase tracking-wider text-slate-400">Zonas</span>
                <span class="flex items-center gap-1.5"><span class="h-3 w-3 rounded bg-red-600"></span> Extremo (13–25)</span>
                <span class="flex items-center gap-1.5"><span class="h-3 w-3 rounded bg-orange-500"></span> Alto (6–12)</span>
                <span class="flex items-center gap-1.5"><span class="h-3 w-3 rounded bg-amber-300"></span> Moderado (2–5)</span>
                <span class="flex items-center gap-1.5"><span class="h-3 w-3 rounded bg-emerald-500"></span> Bajo (1)</span>
                <span class="ml-auto hidden text-slate-400 sm:inline">Pasa el cursor sobre un código para ver el detalle.</span>
            </div>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                @foreach ($maps as $map)
                    <x-card>
                        <div class="mb-5 flex items-start gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl {{ $map['accent'] }}"><x-icon :name="$map['icon']" /></span>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">{{ $map['title'] }}</h2>
                                <p class="text-xs text-slate-500">{{ $map['desc'] }}</p>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <div class="flex w-5 items-center justify-center">
                                <span class="-rotate-90 whitespace-nowrap text-[10px] font-semibold uppercase tracking-widest text-slate-400">Probabilidad</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="grid grid-cols-[4.5rem_repeat(5,minmax(0,1fr))] gap-1 text-[11px]">
                                    @for ($p = 5; $p >= 1; $p--)
                                        <div class="flex items-center justify-end pr-1 text-right font-medium leading-tight text-slate-500">
                                            <span><span class="font-bold text-slate-700">{{ $p }}</span> {{ $probLabels[$p] }}</span>
                                        </div>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="flex min-h-[3.75rem] flex-wrap content-center items-center justify-center gap-1 rounded-lg p-1 {{ $cellZone($p * $i) }}">
                                                @foreach ($matrixData[$p][$i][$map['key']] as $risk)
                                                    <div class="group relative">
                                                        <button type="button" @click="modalAbierto = {{ $risk->id }}"
                                                                class="rounded-md bg-white/25 px-1.5 py-0.5 font-mono text-[10px] font-bold ring-1 ring-inset ring-white/40 transition hover:bg-white/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900">
                                                            {{ $risk->code }}
                                                        </button>
                                                        <div class="pointer-events-none invisible absolute bottom-full left-1/2 z-40 mb-2 w-56 -translate-x-1/2 rounded-lg bg-slate-900 p-3 text-left text-xs font-normal text-white opacity-0 shadow-xl transition group-hover:visible group-hover:opacity-100">
                                                            <div class="mb-1 border-b border-white/10 pb-1 font-semibold {{ $map['key'] === 'inherent_risks' ? 'text-red-300' : 'text-emerald-300' }}">{{ $risk->code }}</div>
                                                            @if ($map['key'] === 'inherent_risks')
                                                                <div class="mb-1 text-slate-300">P {{ $risk->probability }} × I {{ $risk->impact }} = <strong class="text-white">{{ $risk->inherent_score }}</strong></div>
                                                            @else
                                                                <div class="mb-1 text-slate-300">P {{ $risk->residual_probability }} × I {{ $risk->residual_impact }} = <strong class="text-white">{{ $risk->residual_score }}</strong></div>
                                                            @endif
                                                            <div class="line-clamp-3 text-slate-400">{{ $risk->description }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endfor
                                    @endfor
                                    <div></div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="pt-1 text-center font-medium leading-tight text-slate-500"><span class="font-bold text-slate-700">{{ $i }}</span><br class="sm:hidden"> {{ $impLabels[$i] }}</div>
                                    @endfor
                                </div>
                                <p class="mt-1 text-center text-[10px] font-semibold uppercase tracking-widest text-slate-400">Impacto</p>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>

            {{-- Libro de evidencias --}}
            <x-card title="Libro de evidencias y mitigación" subtitle="Comparativo inherente → controles → residual por riesgo" padding="p-0">
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Riesgo</th>
                                <th class="!text-center">Inherente</th>
                                <th class="!text-center">Fuerza mitigante</th>
                                <th class="!text-center">Residual</th>
                                <th class="!text-right">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($risks as $risk)
                                @php
                                    $zonePill = fn ($z) => match ($z) {
                                        'Extremo'  => 'bg-red-100 text-red-700',
                                        'Alto'     => 'bg-orange-100 text-orange-700',
                                        'Moderado' => 'bg-amber-100 text-amber-800',
                                        default    => 'bg-emerald-100 text-emerald-700',
                                    };
                                @endphp
                                <tr>
                                    <td class="max-w-sm">
                                        <div class="font-mono text-xs font-bold text-slate-900">{{ $risk->code }}</div>
                                        <div class="text-xs font-semibold text-slate-600">{{ $risk->process->name }}</div>
                                        <div class="mt-0.5 line-clamp-2 text-xs text-slate-400">{{ $risk->description }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-base font-bold text-slate-900">{{ $risk->inherent_score }}</div>
                                        <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-bold uppercase {{ $zonePill($risk->zone) }}">{{ $risk->zone }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if ($risk->controls->count() > 0)
                                            @php
                                                $avgScore = $risk->controls->avg('total_score');
                                                $classLabel = $avgScore >= 80 ? 'Óptimo' : ($avgScore >= 50 ? 'Bueno' : ($avgScore >= 25 ? 'Débil' : 'Inaceptable'));
                                                $badgeStyle = match ($classLabel) {
                                                    'Óptimo' => 'bg-emerald-100 text-emerald-800',
                                                    'Bueno'  => 'bg-cyan-100 text-cyan-800',
                                                    'Débil'  => 'bg-orange-100 text-orange-800',
                                                    default  => 'bg-red-100 text-red-800',
                                                };
                                            @endphp
                                            <div class="text-base font-bold text-slate-900">{{ round($avgScore) }} <span class="text-xs font-normal text-slate-400">pts</span></div>
                                            <div class="text-[11px] text-slate-400">{{ $risk->controls->count() }} {{ $risk->controls->count() === 1 ? 'control' : 'controles' }}</div>
                                            <span class="mt-0.5 inline-flex rounded-full px-2 py-0.5 text-[10px] font-bold {{ $badgeStyle }}">{{ $classLabel }}</span>
                                        @else
                                            <a href="{{ route('controls.create', ['risk' => $risk->id]) }}" class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2.5 py-1 text-[11px] font-semibold text-red-700 ring-1 ring-inset ring-red-200 transition hover:bg-red-100">
                                                <x-icon name="plus" class="h-3 w-3" stroke="2.5" /> Sin controles
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="text-base font-bold text-slate-900">{{ $risk->residual_score }}</div>
                                        <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-bold uppercase {{ $zonePill($risk->residual_zone) }}">{{ $risk->residual_zone }}</span>
                                    </td>
                                    <td class="text-right">
                                        <x-btn type="button" variant="secondary" size="sm" icon="search" @click="modalAbierto = {{ $risk->id }}">Ver análisis</x-btn>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        @endif

            @foreach($risks as $risk)
                <div x-show="modalAbierto === {{ $risk->id }}" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/60 backdrop-blur-sm px-4">
                    <div @click.away="modalAbierto = null" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all">

                        <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Análisis de mitigación: {{ $risk->code }}</h2>
                                <p class="text-xs text-slate-500 mt-1">Proceso: {{ $risk->process->name }} ({{ $risk->category }})</p>
                            </div>
                            <button @click="modalAbierto = null" class="text-slate-400 hover:text-red-500 text-3xl leading-none font-bold outline-none focus:outline-none">&times;</button>
                        </div>

                        <div class="p-6">
                            <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded border border-slate-100 mb-6 font-medium italic">
                                "{{ $risk->description }}"
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-stretch relative">

                                <div class="bg-red-50 p-4 rounded-xl border border-red-100 text-center flex flex-col justify-center relative">
                                    <h4 class="text-xs font-bold text-red-800 uppercase tracking-wider mb-3">1. Estado Inicial (Inherente)</h4>
                                    <div class="text-4xl font-black text-red-600 mb-2">{{ $risk->inherent_score }}</div>
                                    <div class="text-sm text-red-900 font-medium">Probabilidad: <span class="font-bold">{{ $risk->probability }}</span></div>
                                    <div class="text-sm text-red-900 font-medium">Impacto: <span class="font-bold">{{ $risk->impact }}</span></div>
                                    <div class="mt-3 inline-block px-3 py-1 rounded text-xs font-bold text-white bg-red-600">Zona {{ $risk->zone }}</div>
                                </div>

                                <div class="hidden md:flex absolute left-1/3 top-1/2 transform -translate-y-1/2 -ml-3 z-10 text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                </div>

                                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex flex-col">
                                    <h4 class="text-xs font-bold text-blue-800 uppercase tracking-wider mb-3 text-center">2. Escudo Protector</h4>
                                    <div class="flex-1 overflow-y-auto space-y-2 max-h-48">
                                        @forelse($risk->controls as $c)
                                            <div class="bg-white p-2 rounded shadow-sm border border-blue-100 text-[11px]">
                                                <div class="font-bold text-blue-900 line-clamp-1" title="{{ $c->name }}">🛡️ {{ $c->name }}</div>
                                                <div class="flex justify-between mt-1 text-slate-600">
                                                    <span class="font-semibold">{{ $c->type }}</span>
                                                    <span class="font-bold text-blue-600">{{ $c->total_score }} pts</span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-red-500 font-bold text-xs mt-10">No hay controles. El riesgo impactará directamente con toda su fuerza.</div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="hidden md:flex absolute right-1/3 top-1/2 transform -translate-y-1/2 -mr-3 z-10 text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                </div>

                                @php
                                    $rZoneColor = match($risk->residual_zone) { 'Extremo' => 'bg-red-600', 'Alto' => 'bg-orange-500', 'Moderado' => 'bg-yellow-500', default => 'bg-emerald-600' };
                                    $rBgColor   = match($risk->residual_zone) { 'Extremo' => 'bg-red-50 border-red-100', 'Alto' => 'bg-orange-50 border-orange-100', 'Moderado' => 'bg-yellow-50 border-yellow-100', default => 'bg-emerald-50 border-emerald-100' };
                                    $rTextColor = match($risk->residual_zone) { 'Extremo' => 'text-red-900', 'Alto' => 'text-orange-900', 'Moderado' => 'text-yellow-900', default => 'text-emerald-900' };
                                    $rScoreColor= match($risk->residual_zone) { 'Extremo' => 'text-red-600', 'Alto' => 'text-orange-600', 'Moderado' => 'text-yellow-600', default => 'text-emerald-600' };
                                @endphp

                                <div class="{{ $rBgColor }} p-4 rounded-xl border text-center flex flex-col justify-center">
                                    <h4 class="text-xs font-bold uppercase tracking-wider mb-3 {{ $rTextColor }}">3. Estado Final (Residual)</h4>
                                    <div class="text-4xl font-black mb-2 {{ $rScoreColor }}">{{ $risk->residual_score }}</div>
                                    <div class="text-sm font-medium {{ $rTextColor }}">Probabilidad: <span class="font-bold">{{ $risk->residual_probability }}</span></div>
                                    <div class="text-sm font-medium {{ $rTextColor }}">Impacto: <span class="font-bold">{{ $risk->residual_impact }}</span></div>
                                    <div class="mt-3 inline-block px-3 py-1 rounded text-xs font-bold text-white {{ $rZoneColor }}">Zona {{ $risk->residual_zone }}</div>
                                </div>
                            </div>

                            <div class="mt-6 bg-slate-900 rounded-xl p-5 text-white shadow-xl border border-slate-700">
                                <h4 class="text-sm font-bold text-cyan-400 mb-4 pb-2 border-b border-slate-700 flex items-center gap-2">
                                    🧮 Bitácora de Cálculos Científicos (Metodología COSO)
                                </h4>
                                
                                @php
                                    $prevScore = $risk->controls->where('type', 'Preventivo')->sum('total_score');
                                    $corrScore = $risk->controls->where('type', 'Correctivo')->sum('total_score');
                                    $detScore  = $risk->controls->where('type', 'Detectivo')->sum('total_score');
                                    
                                    $probMitigationPct = min(100, $prevScore + ($detScore * 0.5));
                                    $impMitigationPct  = min(100, $corrScore + ($detScore * 0.5));
                                    
                                    $probRestante = 100 - $probMitigationPct;
                                    $impRestante  = 100 - $impMitigationPct;
                                    
                                    $calcProbRaw = $risk->probability * ($probRestante / 100);
                                    $calcImpRaw  = $risk->impact * ($impRestante / 100);
                                @endphp

                                <div class="space-y-4">
                                    <div class="bg-slate-800/60 p-4 rounded-lg border border-slate-700/80">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Paso A: Mitigación de la Probabilidad</span>
                                            <span class="text-[10px] bg-slate-950 px-2 py-0.5 rounded font-mono text-slate-400">Fórmula: Inicial × (100% - Mitigación%)</span>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 text-xs text-center text-slate-300">
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-slate-500 uppercase font-bold">1. Valor Inicial</div>
                                                <div class="text-sm font-black text-white mt-1">{{ $risk->probability }}</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-slate-500 uppercase font-bold">2. Cobertura Control</div>
                                                <div class="text-sm font-black text-cyan-400 mt-1">{{ $probMitigationPct }}%</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-slate-500 uppercase font-bold">3. Exposición Libre</div>
                                                <div class="text-sm font-black text-orange-400 mt-1">{{ $probRestante }}%</div>
                                            </div>
                                            <div class="bg-emerald-950/80 border border-emerald-800/60 p-2 rounded text-emerald-300">
                                                <div class="text-[10px] uppercase font-bold">4. Resultado Exacto</div>
                                                <div class="text-sm font-mono font-black mt-1">{{ number_format($calcProbRaw, 2) }} → Nivel {{ $risk->residual_probability }}</div>
                                            </div>
                                        </div>
                                        <p class="text-[11px] text-slate-400 mt-2.5 italic">
                                            💡 <strong>Explicación:</strong> Los controles preventivos sumaron un blindaje del {{ $probMitigationPct }}%. Por lo tanto, el riesgo original de la probabilidad ({{ $risk->probability }}) se reduce a su {{ $probRestante }}%, dando como resultado exacto <strong>{{ number_format($calcProbRaw, 2) }}</strong>. Al redondearse al entero más cercano, el riesgo aterriza formalmente en el Nivel {{ $risk->residual_probability }}.
                                        </p>
                                    </div>

                                    <div class="bg-slate-800/60 p-4 rounded-lg border border-slate-700/80">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Paso B: Mitigación del Impacto</span>
                                            <span class="text-[10px] bg-slate-950 px-2 py-0.5 rounded font-mono text-slate-400">Fórmula: Inicial × (100% - Mitigación%)</span>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 text-xs text-center text-slate-300">
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-slate-500 uppercase font-bold">1. Valor Inicial</div>
                                                <div class="text-sm font-black text-white mt-1">{{ $risk->impact }}</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-slate-500 uppercase font-bold">2. Cobertura Control</div>
                                                <div class="text-sm font-black text-cyan-400 mt-1">{{ $impMitigationPct }}%</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-slate-500 uppercase font-bold">3. Exposición Libre</div>
                                                <div class="text-sm font-black text-orange-400 mt-1">{{ $impRestante }}%</div>
                                            </div>
                                            <div class="bg-emerald-950/80 border border-emerald-800/60 p-2 rounded text-emerald-300">
                                                <div class="text-[10px] uppercase font-bold">4. Resultado Exacto</div>
                                                <div class="text-sm font-mono font-black mt-1">{{ number_format($calcImpRaw, 2) }} → Nivel {{ $risk->residual_impact }}</div>
                                            </div>
                                        </div>
                                        <p class="text-[11px] text-slate-400 mt-2.5 italic">
                                            💡 <strong>Explicación:</strong> Los controles correctivos sumaron un blindaje del {{ $impMitigationPct }}%. Por lo tanto, el impacto original del riesgo ({{ $risk->impact }}) se reduce a su {{ $impRestante }}%, dando como resultado exacto <strong>{{ number_format($calcImpRaw, 2) }}</strong>. Al redondearse al entero más cercano, el riesgo aterriza formalmente en el Nivel {{ $risk->residual_impact }}.
                                        </p>
                                    </div>

                                    <div class="bg-slate-950 p-3 rounded-lg border border-slate-800 flex justify-between items-center text-xs">
                                        <div class="text-slate-400">
                                            📉 <strong>Desplazamiento total del mapa térmico:</strong> 
                                            @if($risk->probability != $risk->residual_probability || $risk->impact != $risk->residual_impact)
                                                El riesgo logró desplazarse de la zona <span class="text-red-400 font-bold">{{ $risk->zone }}</span> a la zona <span class="text-emerald-400 font-bold">{{ $risk->residual_zone }}</span>.
                                            @else
                                                <span class="text-yellow-400 font-bold">Sin desplazamiento.</span> Los controles registrados no tienen la fuerza suficiente para mover el riesgo.
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <span class="text-[10px] text-slate-500 block uppercase font-bold">Score Residual Final</span>
                                            <span class="text-lg font-black text-white font-mono">{{ $risk->residual_score }} pts</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 text-right rounded-b-2xl">
                            <button @click="modalAbierto = null" class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-5 rounded-lg shadow-sm transition-colors text-sm">Cerrar análisis</button>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</x-app-layout>
