<x-app-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }

        :root {
            --extreme: #C0392B;
            --high: #E67E22;
            --moderate: #F1C40F;
            --low: #27AE60;
        }

        .matrix-grid-layout {
            display: grid;
            grid-template-columns: 75px repeat(5, 1fr);
            gap: 4px;
            font-size: 11px;
        }

        .cell-head {
            background: #f8f9fa;
            font-weight: bold;
            text-align: center;
            padding: 6px;
            border: 1px solid #e5e7eb;
        }

        .cell-label {
            background: #f3f4f6;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 8px;
            text-align: right;
            border: 1px solid #e5e7eb;
        }

        .matrix-cell {
            min-height: 65px;
            border-radius: 6px;
            padding: 4px;
            display: flex;
            flex-wrap: wrap;
            gap: 3px;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #fff;
        }

        .z-extreme { background-color: var(--extreme); }
        .z-high { background-color: var(--high); }
        .z-moderate { background-color: var(--moderate); color: #222; }
        .z-low { background-color: var(--low); }

        .risk-badge {
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            cursor: help;
        }

        .z-moderate .risk-badge {
            background: rgba(0, 0, 0, 0.07);
            border: 1px solid rgba(0, 0, 0, 0.15);
            color: #111;
        }

        /* Tooltip flotante */
        .tooltip-box {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }

        .group:hover .tooltip-box {
            visibility: visible;
            opacity: 1;
        }
    </style>

    <x-slot name="header">
        <x-page-header title="Panel de control de riesgos" subtitle="Mapas de calor COSO" />
    </x-slot>

    <div class="py-8" x-data="{ modalAbierto: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-t-4 border-red-600">
                    <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide mb-1">🔥 Exposición Inherente</h3>
                    <p class="text-xs text-gray-500 mb-4">Ubicación natural antes de evaluar controles.</p>

                    <div class="matrix-grid-layout">
                        <div></div>
                        <div class="cell-head">1. Insig.</div>
                        <div class="cell-head">2. Menor</div>
                        <div class="cell-head">3. Mod.</div>
                        <div class="cell-head">4. Mayor</div>
                        <div class="cell-head">5. Catas.</div>

                        @for($p = 5; $p >= 1; $p--)
                            <div class="cell-label">{{ $p }}. Casi C.</div>
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $score = $p * $i;
                                    $zone = $score >= 13 ? 'z-extreme' : ($score >= 6 ? 'z-high' : ($score >= 2 ? 'z-moderate' : 'z-low'));
                                @endphp
                                <div class="matrix-cell {{ $zone }}">
                                    @foreach($matrixData[$p][$i]['inherent_risks'] as $risk)
                                        <div class="relative group flex items-center justify-center">
                                            <span class="risk-badge">{{ $risk->code }}</span>
                                            <div class="tooltip-box absolute z-50 bottom-full mb-2 w-56 p-3 bg-gray-900 text-white text-xs rounded-lg shadow-xl pointer-events-none">
                                                <div class="font-bold text-red-400 mb-1 border-b border-gray-700 pb-1">{{ $risk->code }} - Riesgo Inherente</div>
                                                <div class="mb-1"><strong>Probabilidad:</strong> {{ $risk->probability }} | <strong>Impacto:</strong> {{ $risk->impact }}</div>
                                                <div class="text-gray-300 line-clamp-3">{{ $risk->description }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endfor
                        @endfor
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-t-4 border-emerald-600">
                    <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide mb-1">🛡️ Exposición Residual</h3>
                    <p class="text-xs text-gray-500 mb-4">Nivel real tras aplicar defensas operativas.</p>

                    <div class="matrix-grid-layout">
                        <div></div>
                        <div class="cell-head">1. Insig.</div>
                        <div class="cell-head">2. Menor</div>
                        <div class="cell-head">3. Mod.</div>
                        <div class="cell-head">4. Mayor</div>
                        <div class="cell-head">5. Catas.</div>

                        @for($p = 5; $p >= 1; $p--)
                            <div class="cell-label">{{ $p }}. Casi C.</div>
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $score = $p * $i;
                                    $zone = $score >= 13 ? 'z-extreme' : ($score >= 6 ? 'z-high' : ($score >= 2 ? 'z-moderate' : 'z-low'));
                                @endphp
                                <div class="matrix-cell {{ $zone }}">
                                    @foreach($matrixData[$p][$i]['residual_risks'] as $risk)
                                        <div class="relative group flex items-center justify-center">
                                            <span class="risk-badge">{{ $risk->code }}</span>
                                            <div class="tooltip-box absolute z-50 bottom-full mb-2 w-56 p-3 bg-gray-900 text-white text-xs rounded-lg shadow-xl pointer-events-none">
                                                <div class="font-bold text-emerald-400 mb-1 border-b border-gray-700 pb-1">{{ $risk->code }} - Riesgo Mitigado</div>
                                                <div class="mb-1"><strong>Probabilidad:</strong> {{ $risk->residual_probability }} | <strong>Impacto:</strong> {{ $risk->residual_impact }}</div>
                                                <div class="text-gray-300 font-normal italic">
                                                    ↓ Prob reducida en {{ $risk->probability - $risk->residual_probability }} niveles.<br>
                                                    ↓ Imp reducido en {{ $risk->impact - $risk->residual_impact }} niveles.
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endfor
                        @endfor
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wider mb-4 pb-2 border-b">📋 Libro de Evidencias y Mitigación</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                        <thead class="bg-gray-50 font-bold text-gray-600 uppercase">
                            <tr>
                                <th class="px-4 py-3 text-left">Riesgo</th>
                                <th class="px-4 py-3 text-center">Estado Inherente</th>
                                <th class="px-4 py-3 text-center">Fuerza Mitigante</th>
                                <th class="px-4 py-3 text-center">Estado Residual</th>
                                <th class="px-4 py-3 text-center">Detalle Matemático</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($risks as $risk)
                                <tr class="hover:bg-gray-50/70">
                                    <td class="px-4 py-4">
                                        <div class="font-bold text-indigo-600 text-sm">{{ $risk->code }}</div>
                                        <div class="font-bold text-gray-800 mt-0.5">{{ $risk->process->name }}</div>
                                        <div class="text-gray-500 line-clamp-2 mt-1">{{ $risk->description }}</div>
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <div class="text-sm font-black text-gray-800">{{ $risk->inherent_score }}</div>
                                        <div class="text-[10px] text-gray-500 mb-1">P:{{ $risk->probability }} × I:{{ $risk->impact }}</div>
                                        <span class="inline-block px-2 py-0.5 text-[10px] rounded font-bold text-white uppercase" style="background-color: {{ $risk->zone_color }}">
                                            {{ $risk->zone }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        @if($risk->controls->count() > 0)
                                            @php
                                                $avgScore = $risk->controls->avg('total_score');
                                                $classLabel = $avgScore >= 80 ? 'Óptimo' : ($avgScore >= 50 ? 'Bueno' : ($avgScore >= 25 ? 'Débil' : 'Inaceptable'));
                                                $badgeStyle = match($classLabel) {
                                                    'Óptimo' => 'bg-green-100 text-green-800 border-green-200',
                                                    'Bueno'  => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'Débil'  => 'bg-orange-100 text-orange-800 border-orange-200',
                                                    default  => 'bg-red-100 text-red-800 border-red-200'
                                                };
                                            @endphp
                                            <div class="text-sm font-black text-slate-700">{{ round($avgScore) }} pts</div>
                                            <div class="text-[10px] text-gray-500 mb-1">{{ $risk->controls->count() }} controles activos</div>
                                            <span class="inline-block px-2 py-0.5 border text-[10px] font-bold rounded-full {{ $badgeStyle }}">
                                                {{ $classLabel }}
                                            </span>
                                        @else
                                            <span class="text-red-600 font-bold">0 pts (Sin controles)</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        @php
                                            $resColor = match($risk->residual_zone) {
                                                'Extremo'  => 'bg-red-100 text-red-700',
                                                'Alto'     => 'bg-orange-100 text-orange-700',
                                                'Moderado' => 'bg-yellow-100 text-yellow-800',
                                                default    => 'bg-green-100 text-green-700'
                                            };
                                        @endphp
                                        <div class="text-sm font-black text-gray-800">{{ $risk->residual_score }}</div>
                                        <div class="text-[10px] text-gray-500 mb-1">P:{{ $risk->residual_probability }} × I:{{ $risk->residual_impact }}</div>
                                        <span class="inline-block px-2 py-0.5 text-[10px] rounded font-bold uppercase {{ $resColor }}">
                                            {{ $risk->residual_zone }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <button @click="modalAbierto = {{ $risk->id }}" class="bg-indigo-50 text-indigo-700 hover:bg-indigo-600 hover:text-white transition-colors border border-indigo-200 font-bold py-1.5 px-3 rounded text-[10px] uppercase shadow-sm">
                                            🔍 Ver Explicación
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @foreach($risks as $risk)
                <div x-show="modalAbierto === {{ $risk->id }}" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm px-4">
                    <div @click.away="modalAbierto = null" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all">

                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                            <div>
                                <h2 class="text-xl font-bold text-indigo-900">Análisis Científico de Mitigación: {{ $risk->code }}</h2>
                                <p class="text-xs text-gray-500 mt-1">Proceso: {{ $risk->process->name }} ({{ $risk->category }})</p>
                            </div>
                            <button @click="modalAbierto = null" class="text-gray-400 hover:text-red-500 text-3xl leading-none font-bold outline-none focus:outline-none">&times;</button>
                        </div>

                        <div class="p-6">
                            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded border border-gray-100 mb-6 font-medium italic">
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

                                <div class="hidden md:flex absolute left-1/3 top-1/2 transform -translate-y-1/2 -ml-3 z-10 text-gray-400">
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
                                                <div class="flex justify-between mt-1 text-gray-600">
                                                    <span class="font-semibold">{{ $c->type }}</span>
                                                    <span class="font-bold text-blue-600">{{ $c->total_score }} pts</span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-red-500 font-bold text-xs mt-10">No hay controles. El riesgo impactará directamente con toda su fuerza.</div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="hidden md:flex absolute right-1/3 top-1/2 transform -translate-y-1/2 -mr-3 z-10 text-gray-400">
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
                                <h4 class="text-sm font-bold text-indigo-400 mb-4 pb-2 border-b border-slate-700 flex items-center gap-2">
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
                                            <span class="text-[10px] bg-slate-950 px-2 py-0.5 rounded font-mono text-gray-400">Fórmula: Inicial × (100% - Mitigación%)</span>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 text-xs text-center text-gray-300">
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-gray-500 uppercase font-bold">1. Valor Inicial</div>
                                                <div class="text-sm font-black text-white mt-1">{{ $risk->probability }}</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-gray-500 uppercase font-bold">2. Cobertura Control</div>
                                                <div class="text-sm font-black text-indigo-400 mt-1">{{ $probMitigationPct }}%</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-gray-500 uppercase font-bold">3. Exposición Libre</div>
                                                <div class="text-sm font-black text-orange-400 mt-1">{{ $probRestante }}%</div>
                                            </div>
                                            <div class="bg-emerald-950/80 border border-emerald-800/60 p-2 rounded text-emerald-300">
                                                <div class="text-[10px] uppercase font-bold">4. Resultado Exacto</div>
                                                <div class="text-sm font-mono font-black mt-1">{{ number_format($calcProbRaw, 2) }} → Nivel {{ $risk->residual_probability }}</div>
                                            </div>
                                        </div>
                                        <p class="text-[11px] text-gray-400 mt-2.5 italic">
                                            💡 <strong>Explicación:</strong> Los controles preventivos sumaron un blindaje del {{ $probMitigationPct }}%. Por lo tanto, el riesgo original de la probabilidad ({{ $risk->probability }}) se reduce a su {{ $probRestante }}%, dando como resultado exacto <strong>{{ number_format($calcProbRaw, 2) }}</strong>. Al redondearse al entero más cercano, el riesgo aterriza formalmente en el Nivel {{ $risk->residual_probability }}.
                                        </p>
                                    </div>

                                    <div class="bg-slate-800/60 p-4 rounded-lg border border-slate-700/80">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Paso B: Mitigación del Impacto</span>
                                            <span class="text-[10px] bg-slate-950 px-2 py-0.5 rounded font-mono text-gray-400">Fórmula: Inicial × (100% - Mitigación%)</span>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 text-xs text-center text-gray-300">
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-gray-500 uppercase font-bold">1. Valor Inicial</div>
                                                <div class="text-sm font-black text-white mt-1">{{ $risk->impact }}</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-gray-500 uppercase font-bold">2. Cobertura Control</div>
                                                <div class="text-sm font-black text-indigo-400 mt-1">{{ $impMitigationPct }}%</div>
                                            </div>
                                            <div class="bg-slate-900 p-2 rounded">
                                                <div class="text-[10px] text-gray-500 uppercase font-bold">3. Exposición Libre</div>
                                                <div class="text-sm font-black text-orange-400 mt-1">{{ $impRestante }}%</div>
                                            </div>
                                            <div class="bg-emerald-950/80 border border-emerald-800/60 p-2 rounded text-emerald-300">
                                                <div class="text-[10px] uppercase font-bold">4. Resultado Exacto</div>
                                                <div class="text-sm font-mono font-black mt-1">{{ number_format($calcImpRaw, 2) }} → Nivel {{ $risk->residual_impact }}</div>
                                            </div>
                                        </div>
                                        <p class="text-[11px] text-gray-400 mt-2.5 italic">
                                            💡 <strong>Explicación:</strong> Los controles correctivos sumaron un blindaje del {{ $impMitigationPct }}%. Por lo tanto, el impacto original del riesgo ({{ $risk->impact }}) se reduce a su {{ $impRestante }}%, dando como resultado exacto <strong>{{ number_format($calcImpRaw, 2) }}</strong>. Al redondearse al entero más cercano, el riesgo aterriza formalmente en el Nivel {{ $risk->residual_impact }}.
                                        </p>
                                    </div>

                                    <div class="bg-slate-950 p-3 rounded-lg border border-slate-800 flex justify-between items-center text-xs">
                                        <div class="text-gray-400">
                                            📉 <strong>Desplazamiento total del mapa térmico:</strong> 
                                            @if($risk->probability != $risk->residual_probability || $risk->impact != $risk->residual_impact)
                                                El riesgo logró desplazarse de la zona <span class="text-red-400 font-bold">{{ $risk->zone }}</span> a la zona <span class="text-emerald-400 font-bold">{{ $risk->residual_zone }}</span>.
                                            @else
                                                <span class="text-yellow-400 font-bold">Sin desplazamiento.</span> Los controles registrados no tienen la fuerza suficiente para mover el riesgo.
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <span class="text-[10px] text-gray-500 block uppercase font-bold">Score Residual Final</span>
                                            <span class="text-lg font-black text-white font-mono">{{ $risk->residual_score }} pts</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 text-right rounded-b-2xl">
                            <button @click="modalAbierto = null" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded shadow-sm transition-colors text-sm">Cerrar Análisis</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>