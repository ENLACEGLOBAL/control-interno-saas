<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">🛡️ Controles Mitigantes</h2>
            <a href="{{ route('controls.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">+ Vincular Control</a>
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
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Nombre del Control</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Riesgo Asociado</th>
                                <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Puntaje</th>
                                <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Calificación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($controls as $control)
                                <tr>
                                    <td class="px-4 py-4 font-bold text-gray-800">{{ $control->name }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-gray-600">{{ $control->type }}</td>
                                    <td class="px-4 py-4 text-xs">
                                        <span class="font-bold text-red-600">{{ $control->risk->code }}</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center font-bold text-indigo-600">
                                        {{ $control->total_score }}/100
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        @php
                                            $badgeClass = match($control->classification) {
                                                'Óptimo' => 'bg-green-100 text-green-800',
                                                'Bueno' => 'bg-blue-100 text-blue-800',
                                                'Débil' => 'bg-orange-100 text-orange-800',
                                                'Inaceptable' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full {{ $badgeClass }}">
                                            {{ $control->classification }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-4 py-4 text-center text-gray-500">No hay controles registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>