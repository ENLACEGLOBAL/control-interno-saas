<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Procesos registrados" subtitle="Mapa de procesos por área">
            <x-slot name="actions">
                <x-btn :href="route('processes.create')">+ Agregar proceso</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <x-alert>{{ session('status') }}</x-alert>
            @endif

            <x-card padding="p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">ID</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Nombre del proceso</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Área dueña</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Fecha registro</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($processes as $process)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-900">{{ $process->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-700">{{ $process->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-cyan-700">{{ $process->area->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-500">{{ $process->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-6 text-center text-slate-500">No hay procesos registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
