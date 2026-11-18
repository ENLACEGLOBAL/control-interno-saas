<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Mapa de procesos" subtitle="Procesos operativos vinculados a su área dueña" icon="flow">
            <x-slot name="actions">
                <x-btn :href="route('processes.create')" icon="plus">Nuevo proceso</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-card padding="p-0">
            @if ($processes->isEmpty())
                <x-empty-state icon="flow" title="Aún no hay procesos registrados"
                               description="Registra los procesos de cada área para poder identificar sus riesgos.">
                    <x-btn :href="route('processes.create')" icon="plus">Registrar proceso</x-btn>
                </x-empty-state>
            @else
                @php $areaCount = $processes->pluck('area_id')->unique()->count(); @endphp
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 px-5 py-3 text-xs text-slate-500">
                    <span><strong class="text-slate-900">{{ $processes->count() }}</strong> {{ $processes->count() === 1 ? 'proceso' : 'procesos' }} en {{ $areaCount }} {{ $areaCount === 1 ? 'área' : 'áreas' }}</span>
                    <a href="{{ route('risks.index') }}" class="inline-flex items-center gap-1 font-semibold text-cyan-700 hover:text-cyan-900">
                        Siguiente paso: identificar riesgos <x-icon name="chevron" class="h-3.5 w-3.5" stroke="2" />
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th class="w-20">ID</th>
                                <th>Proceso</th>
                                <th>Área dueña</th>
                                <th>Fecha de registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($processes as $process)
                                <tr>
                                    <td class="font-mono text-xs text-slate-400">#{{ $process->id }}</td>
                                    <td class="font-semibold text-slate-900">{{ $process->name }}</td>
                                    <td>
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-cyan-50 px-2 py-1 text-xs font-semibold text-cyan-800 ring-1 ring-inset ring-cyan-100">
                                            <x-icon name="building" class="h-3.5 w-3.5" /> {{ $process->area->name }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap text-slate-500">{{ $process->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
