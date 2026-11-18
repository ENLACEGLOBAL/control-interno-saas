<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Direcciones / Áreas" subtitle="Estructura organizacional de la empresa">
            <x-slot name="actions">
                <x-btn :href="route('areas.create')">+ Agregar área</x-btn>
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
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Nombre del área</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Fecha de registro</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($areas as $area)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-900">{{ $area->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-700">{{ $area->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-500">{{ $area->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-6 py-6 text-center text-slate-500">No hay áreas registradas para esta empresa.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
