<x-app-layout>
    @if ($tenant)
        @php
            $zoneStyles = [
                'Extremo'  => ['bar' => 'bg-red-600',     'dot' => 'bg-red-600',     'text' => 'text-red-700'],
                'Alto'     => ['bar' => 'bg-orange-500',  'dot' => 'bg-orange-500',  'text' => 'text-orange-700'],
                'Moderado' => ['bar' => 'bg-amber-400',   'dot' => 'bg-amber-400',   'text' => 'text-amber-700'],
                'Bajo'     => ['bar' => 'bg-emerald-500', 'dot' => 'bg-emerald-500', 'text' => 'text-emerald-700'],
            ];
            $classStyles = [
                'Óptimo'      => 'bg-emerald-500',
                'Bueno'       => 'bg-cyan-500',
                'Débil'       => 'bg-orange-400',
                'Inaceptable' => 'bg-red-500',
            ];
            $totalRisks = max(1, array_sum($zones));
            $totalControls = max(1, array_sum($classifications));
            $kpis = [
                ['label' => 'Áreas',     'value' => $stats['areas'],     'icon' => 'building', 'route' => 'areas.index',     'hint' => 'Direcciones registradas'],
                ['label' => 'Procesos',  'value' => $stats['processes'], 'icon' => 'flow',     'route' => 'processes.index', 'hint' => 'Procesos mapeados'],
                ['label' => 'Riesgos',   'value' => $stats['risks'],     'icon' => 'alert',    'route' => 'risks.index',     'hint' => 'Riesgos identificados'],
                ['label' => 'Controles', 'value' => $stats['controls'],  'icon' => 'shield',   'route' => 'controls.index',  'hint' => 'Controles vinculados'],
            ];
        @endphp

        <div class="mx-auto max-w-7xl space-y-6 px-4 pb-12 pt-6 sm:px-6 lg:px-8">

            {{-- Bienvenida con el corte visual del login --}}
            <section class="relative overflow-hidden rounded-3xl bg-slate-900 px-6 py-8 text-white shadow-sm sm:px-10">
                <div class="pointer-events-none absolute inset-0"
                     style="background:
                        radial-gradient(900px 400px at 10% -30%, rgba(56,189,248,.20), transparent 60%),
                        radial-gradient(700px 400px at 100% 130%, rgba(99,102,241,.25), transparent 60%),
                        linear-gradient(160deg,#0b1220 0%,#0f172a 60%,#111827 100%);"></div>
                <div class="pointer-events-none absolute inset-0 opacity-[0.06]"
                     style="background-image:linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 42px 42px;"></div>

                <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-cyan-300/90">{{ $tenant->name }}</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight">Hola, {{ \Illuminate\Support\Str::of(auth()->user()->name)->before(' ') }}</h1>
                        <p class="mt-2 max-w-xl text-sm leading-relaxed text-slate-300">
                            Este es el estado de tu sistema de control interno. Revisa los riesgos críticos y continúa donde lo dejaste.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold">
                                <x-icon name="key" class="h-3.5 w-3.5 text-cyan-300" /> Licencia {{ $tenant->license_type }}
                            </span>
                            @foreach (auth()->user()->roles as $role)
                                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/5 px-3 py-1 text-xs font-medium text-slate-200">
                                    {{ str_replace('_', ' ', $role->name) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('risks.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-100">
                            <x-icon name="plus" class="h-4 w-4" stroke="2.2" /> Registrar riesgo
                        </a>
                        <a href="{{ route('matrix.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg border border-white/20 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20">
                            <x-icon name="grid" class="h-4 w-4" /> Ver matriz de calor
                        </a>
                    </div>
                </div>
            </section>

            {{-- Indicadores --}}
            <section aria-label="Indicadores" class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                @foreach ($kpis as $kpi)
                    <a href="{{ route($kpi['route']) }}" class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/[0.03] transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition group-hover:bg-slate-900 group-hover:text-cyan-300">
                                <x-icon :name="$kpi['icon']" />
                            </span>
                            <x-icon name="chevron" class="h-4 w-4 text-slate-300 transition group-hover:translate-x-0.5 group-hover:text-slate-500" stroke="2" />
                        </div>
                        <p class="mt-4 text-3xl font-bold tracking-tight text-slate-900">{{ $kpi['value'] }}</p>
                        <p class="text-sm font-medium text-slate-700">{{ $kpi['label'] }}</p>
                        <p class="text-xs text-slate-400">{{ $kpi['hint'] }}</p>
                    </a>
                @endforeach
            </section>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                {{-- Perfil de riesgo inherente --}}
                <x-card title="Perfil de riesgo inherente" subtitle="Distribución por zona de severidad" class="lg:col-span-2">
                    <x-slot name="actions">
                        <x-btn :href="route('risks.index')" variant="ghost" size="sm">Ver inventario</x-btn>
                    </x-slot>

                    @if ($stats['risks'] > 0)
                        <div class="flex h-3 w-full overflow-hidden rounded-full bg-slate-100" role="img" aria-label="Distribución de riesgos por zona">
                            @foreach ($zones as $zone => $count)
                                @if ($count > 0)
                                    <div class="{{ $zoneStyles[$zone]['bar'] }}" style="width: {{ $count / $totalRisks * 100 }}%"></div>
                                @endif
                            @endforeach
                        </div>
                        <dl class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            @foreach ($zones as $zone => $count)
                                <div class="rounded-xl border border-slate-100 bg-slate-50/60 p-3">
                                    <dt class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                        <span class="h-2 w-2 rounded-full {{ $zoneStyles[$zone]['dot'] }}"></span>{{ $zone }}
                                    </dt>
                                    <dd class="mt-1 text-2xl font-bold text-slate-900">{{ $count }}</dd>
                                </div>
                            @endforeach
                        </dl>

                        <div class="mt-6">
                            <h4 class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">Riesgos de mayor severidad</h4>
                            <ul class="divide-y divide-slate-100">
                                @foreach ($topRisks as $risk)
                                    <li class="flex items-center gap-4 py-2.5">
                                        <span class="w-20 shrink-0 font-mono text-xs font-bold text-slate-900">{{ $risk->code }}</span>
                                        <span class="min-w-0 flex-1 truncate text-sm text-slate-600">{{ $risk->description }}</span>
                                        <span class="shrink-0 rounded-full px-2.5 py-0.5 text-xs font-bold {{ $zoneStyles[$risk->zone]['text'] }} bg-slate-50 ring-1 ring-inset ring-slate-200">
                                            {{ $risk->inherent_score }} · {{ $risk->zone }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <x-empty-state icon="alert" title="Aún no hay riesgos registrados" description="Comienza identificando los riesgos de tus procesos para construir la matriz COSO.">
                            <x-btn :href="route('risks.create')" icon="plus">Registrar primer riesgo</x-btn>
                        </x-empty-state>
                    @endif
                </x-card>

                <div class="space-y-6">
                    {{-- Efectividad de controles --}}
                    <x-card title="Calificación de controles" subtitle="Escala SCI (0-100)">
                        @if ($stats['controls'] > 0)
                            <ul class="space-y-3">
                                @foreach ($classifications as $label => $count)
                                    <li>
                                        <div class="mb-1 flex justify-between text-xs">
                                            <span class="font-medium text-slate-600">{{ $label }}</span>
                                            <span class="font-semibold text-slate-900">{{ $count }}</span>
                                        </div>
                                        <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                                            <div class="h-full rounded-full {{ $classStyles[$label] }}" style="width: {{ $count / $totalControls * 100 }}%"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-slate-500">Sin controles evaluados todavía.</p>
                        @endif

                        @if ($uncontrolled > 0)
                            <a href="{{ route('controls.create') }}" class="mt-5 flex items-center gap-3 rounded-xl border border-amber-200 bg-amber-50 p-3 text-sm text-amber-900 transition hover:bg-amber-100">
                                <x-icon name="alert" class="h-5 w-5 text-amber-500" />
                                <span class="flex-1"><strong>{{ $uncontrolled }}</strong> {{ $uncontrolled === 1 ? 'riesgo sin control' : 'riesgos sin control' }} mitigante</span>
                                <x-icon name="chevron" class="h-4 w-4" stroke="2" />
                            </a>
                        @endif
                    </x-card>

                    {{-- Flujo de trabajo sugerido --}}
                    <x-card title="Flujo de trabajo" subtitle="Ruta recomendada COSO">
                        @php
                            $steps = [
                                ['n' => 1, 'label' => 'Define áreas',        'route' => 'areas.index',      'done' => $stats['areas'] > 0],
                                ['n' => 2, 'label' => 'Mapea procesos',      'route' => 'processes.index',  'done' => $stats['processes'] > 0],
                                ['n' => 3, 'label' => 'Identifica riesgos',  'route' => 'risks.index',      'done' => $stats['risks'] > 0],
                                ['n' => 4, 'label' => 'Vincula controles',   'route' => 'controls.index',   'done' => $stats['controls'] > 0],
                                ['n' => 5, 'label' => 'Analiza la matriz',   'route' => 'matrix.dashboard', 'done' => false],
                            ];
                        @endphp
                        <ol class="space-y-1">
                            @foreach ($steps as $step)
                                <li>
                                    <a href="{{ route($step['route']) }}" class="flex items-center gap-3 rounded-lg px-2 py-2 text-sm transition hover:bg-slate-50">
                                        @if ($step['done'])
                                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-600"><x-icon name="check" class="h-3.5 w-3.5" stroke="3" /></span>
                                        @else
                                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-100 text-[11px] font-bold text-slate-500">{{ $step['n'] }}</span>
                                        @endif
                                        <span class="flex-1 {{ $step['done'] ? 'text-slate-500' : 'font-medium text-slate-800' }}">{{ $step['label'] }}</span>
                                        <x-icon name="chevron" class="h-4 w-4 text-slate-300" stroke="2" />
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </x-card>
                </div>
            </div>

            {{-- Permisos efectivos --}}
            <x-card title="Tus permisos en esta empresa" subtitle="Derivados de tus roles asignados">
                <div class="flex flex-wrap gap-2">
                    @forelse (auth()->user()->getAllPermissions() as $permission)
                        <span class="inline-flex items-center gap-1 rounded-md border border-slate-200 bg-slate-50 px-2 py-1 font-mono text-xs text-slate-600">
                            <x-icon name="check" class="h-3 w-3 text-emerald-500" stroke="3" />{{ $permission->name }}
                        </span>
                    @empty
                        <p class="text-sm text-slate-500">Aún no tienes permisos asignados. Solicítalos al administrador de tu empresa.</p>
                    @endforelse
                </div>
            </x-card>
        </div>
    @else
        {{-- Sin empresa activa: guiar al usuario --}}
        <div class="mx-auto max-w-xl px-4 py-16 sm:px-6">
            <x-card padding="p-10" class="text-center">
                <span class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-900 text-cyan-300">
                    <x-icon name="building" class="h-7 w-7" />
                </span>
                <h1 class="text-xl font-bold tracking-tight text-slate-900">Selecciona una empresa para comenzar</h1>
                <p class="mt-2 text-sm text-slate-500">Los módulos, indicadores y matrices se cargan según la empresa activa.</p>

                @if (auth()->user()->tenants->isNotEmpty())
                    <div class="mt-6 space-y-2 text-left">
                        @foreach (auth()->user()->tenants as $t)
                            <form method="POST" action="{{ route('tenant.switch') }}">
                                @csrf
                                <input type="hidden" name="tenant_id" value="{{ $t->id }}">
                                <button type="submit" class="group flex w-full items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-left transition hover:border-slate-900 hover:bg-slate-50">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500 group-hover:bg-slate-900 group-hover:text-cyan-300">
                                        <x-icon name="building" class="h-4 w-4" />
                                    </span>
                                    <span class="flex-1 text-sm font-semibold text-slate-800">{{ $t->name }}</span>
                                    <x-icon name="chevron" class="h-4 w-4 text-slate-400" stroke="2" />
                                </button>
                            </form>
                        @endforeach
                    </div>
                @else
                    <x-alert type="warning" class="mt-6 text-left">No tienes empresas asignadas. Contacta al administrador de la plataforma.</x-alert>
                @endif
            </x-card>
        </div>
    @endif
</x-app-layout>
