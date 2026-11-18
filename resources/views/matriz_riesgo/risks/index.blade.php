<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">⚠ Inventario de Riesgos (Inherente)</h2>
            <a href="{{ route('risks.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">+ Registrar Riesgo</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('status') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase">Código</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase">Categoría</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase">Descripción del Evento</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase">Proceso / Dirección</th>
                                <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase">Score Inherente</th>
                                <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase">Zona de Severidad</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($risks as $risk)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap font-black text-indigo-600">{{ $risk->code }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 bg-slate-100 border text-slate-700 font-bold rounded text-xs">
                                        {{ $risk->category }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 font-medium text-gray-800">{{ Str::limit($risk->description, 60) }}</td>
                                <td class="px-4 py-4 text-xs text-gray-500">
                                    <div class="font-bold text-gray-700">{{ $risk->process->name }}</div>
                                    <div class="text-gray-400">{{ $risk->process->area->name }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center font-bold text-sm text-slate-800">
                                    {{ $risk->inherent_score }} <span class="text-gray-400 font-normal text-xs">(P:{{ $risk->probability }} × I:{{ $risk->impact }})</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-extrabold rounded-full text-white uppercase tracking-wider" style="background-color: {{ $risk->zone_color }}">
                                        {{ $risk->zone }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">No hay riesgos identificados aún.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>