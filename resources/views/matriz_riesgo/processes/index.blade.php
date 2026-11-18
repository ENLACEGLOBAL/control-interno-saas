<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">⚙️ Procesos Registrados</h2>
            <a href="{{ route('processes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">+ Agregar Proceso</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('status') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Nombre del Proceso</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Área Dueña</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($processes as $process)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $process->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $process->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-indigo-600 font-semibold">{{ $process->area->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $process->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay procesos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>