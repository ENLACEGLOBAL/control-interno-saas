<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Direcciones / Áreas" subtitle="Unidades organizacionales que integran el universo de control" icon="building">
            <x-slot name="actions">
                <x-btn :href="route('areas.create')" icon="plus">Nueva área</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-card padding="p-0">
            @if ($areas->isEmpty())
                <x-empty-state icon="building" title="Aún no hay áreas registradas"
                               description="Las áreas son la base de la estructura: agrupan procesos, riesgos y controles.">
                    <x-btn :href="route('areas.create')" icon="plus">Crear la primera área</x-btn>
                </x-empty-state>
            @else
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 px-5 py-3 text-xs text-slate-500">
                    <span><strong class="text-slate-900">{{ $areas->count() }}</strong> {{ $areas->count() === 1 ? 'área registrada' : 'áreas registradas' }}</span>
                    <a href="{{ route('processes.index') }}" class="inline-flex items-center gap-1 font-semibold text-cyan-700 hover:text-cyan-900">
                        Siguiente paso: mapa de procesos <x-icon name="chevron" class="h-3.5 w-3.5" stroke="2" />
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th class="w-20">ID</th>
                                <th>Nombre del área</th>
                                <th>Fecha de registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($areas as $area)
                                <tr>
                                    <td class="font-mono text-xs text-slate-400">#{{ $area->id }}</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500"><x-icon name="building" class="h-4 w-4" /></span>
                                            <span class="font-semibold text-slate-900">{{ $area->name }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap text-slate-500">{{ $area->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
