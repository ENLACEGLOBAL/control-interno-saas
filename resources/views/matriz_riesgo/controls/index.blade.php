<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Controles mitigantes" subtitle="Controles vinculados a los riesgos">
            <x-slot name="actions">
                <x-btn :href="route('controls.create')">+ Vincular control</x-btn>
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
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Nombre del control</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Tipo</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Riesgo asociado</th>
                                <th class="px-4 py-3 text-center font-semibold uppercase tracking-wider text-slate-500">Puntaje</th>
                                <th class="px-4 py-3 text-center font-semibold uppercase tracking-wider text-slate-500">Calificación</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($controls as $control)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="px-4 py-4 font-semibold text-slate-800">{{ $control->name }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $control->type }}</td>
                                    <td class="px-4 py-4 text-xs">
                                        <span class="font-bold text-red-600">{{ $control->risk->code }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-center font-bold text-slate-900">
                                        {{ $control->total_score }}/100
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-center">
                                        @php
                                            $badgeClass = match($control->classification) {
                                                'Óptimo' => 'bg-emerald-100 text-emerald-800',
                                                'Bueno' => 'bg-blue-100 text-blue-800',
                                                'Débil' => 'bg-orange-100 text-orange-800',
                                                'Inaceptable' => 'bg-red-100 text-red-800',
                                                default => 'bg-slate-100 text-slate-800'
                                            };
                                        @endphp
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-bold {{ $badgeClass }}">
                                            {{ $control->classification }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">No hay controles registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
