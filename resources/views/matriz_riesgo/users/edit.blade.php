<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">⚙️ Asignar Áreas a: {{ $user->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-indigo-600">
                <p class="text-sm text-gray-500 mb-6">Selecciona las áreas a las que este usuario tendrá acceso. Podrá ver los procesos, riesgos y controles de los departamentos marcados.</p>

                <form method="POST" action="{{ route('tenant-users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        @forelse($areas as $area)
                            <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="checkbox" name="areas[]" value="{{ $area->id }}" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-5 w-5"
                                    {{ in_array($area->id, $assignedAreaIds) ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-bold text-gray-700">{{ $area->name }}</span>
                            </label>
                        @empty
                            <div class="col-span-2 text-center text-gray-500 py-4">Primero debes crear Áreas en la empresa.</div>
                        @endforelse
                    </div>

                    <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-100">
                        <a href="{{ route('tenant-users.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm">← Volver</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow-sm">
                            Guardar Accesos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>