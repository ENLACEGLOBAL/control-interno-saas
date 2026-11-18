<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Consultas generales" subtitle="Reportes y consultas del sistema de control interno" icon="search" />
    </x-slot>

    @php
        $shortcuts = [
            ['route' => 'risks.index',      'icon' => 'alert',    'title' => 'Inventario de riesgos', 'desc' => 'Consulta y filtra los riesgos por zona de severidad.'],
            ['route' => 'controls.index',   'icon' => 'shield',   'title' => 'Controles mitigantes',  'desc' => 'Revisa la calificación SCI de cada control.'],
            ['route' => 'matrix.dashboard', 'icon' => 'grid',     'title' => 'Matriz de calor',       'desc' => 'Compara la exposición inherente y residual.'],
            ['route' => 'processes.index',  'icon' => 'flow',     'title' => 'Mapa de procesos',      'desc' => 'Procesos registrados por área dueña.'],
        ];
    @endphp

    <div class="mx-auto max-w-7xl space-y-6 px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-alert type="info">
            Este módulo está disponible para todos los tipos de licencia. Elige una consulta para comenzar.
        </x-alert>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            @foreach ($shortcuts as $s)
                <a href="{{ route($s['route']) }}" class="group flex items-start gap-4 rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition group-hover:bg-slate-900 group-hover:text-cyan-300">
                        <x-icon :name="$s['icon']" />
                    </span>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-semibold text-slate-900">{{ $s['title'] }}</h3>
                        <p class="mt-0.5 text-sm text-slate-500">{{ $s['desc'] }}</p>
                    </div>
                    <x-icon name="chevron" class="mt-1 h-4 w-4 text-slate-300 transition group-hover:translate-x-0.5 group-hover:text-slate-500" stroke="2" />
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
