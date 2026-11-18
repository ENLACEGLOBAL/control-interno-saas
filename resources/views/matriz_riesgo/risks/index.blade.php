<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Inventario de riesgos" subtitle="Riesgos inherentes identificados">
            <x-slot name="actions">
                <x-btn :href="route('risks.create')">+ Registrar riesgo</x-btn>
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
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Código</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Categoría</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Descripción del evento</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Proceso / dirección</th>
                                <th class="px-4 py-3 text-center font-semibold uppercase tracking-wider text-slate-500">Score inherente</th>
                                <th class="px-4 py-3 text-center font-semibold uppercase tracking-wider text-slate-500">Zona de severidad</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($risks as $risk)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 font-bold text-slate-900">{{ $risk->code }}</td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <span class="rounded-md border border-slate-200 bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">
                                        {{ $risk->category }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 font-medium text-slate-800">{{ Str::limit($risk->description, 60) }}</td>
                                <td class="px-4 py-4 text-xs text-slate-500">
                                    <div class="font-semibold text-slate-700">{{ $risk->process->name }}</div>
                                    <div class="text-slate-400">{{ $risk->process->area->name }}</div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-center font-bold text-slate-800">
                                    {{ $risk->inherent_score }} <span class="text-xs font-normal text-slate-400">(P:{{ $risk->probability }} × I:{{ $risk->impact }})</span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-center">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wider text-white" style="background-color: {{ $risk->zone_color }}">
                                        {{ $risk->zone }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">No hay riesgos identificados aún.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
