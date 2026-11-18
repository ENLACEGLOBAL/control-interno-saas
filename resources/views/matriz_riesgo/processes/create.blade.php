<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">⚙️ Registrar Nuevo Proceso</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('processes.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Seleccionar Área Dueña</label>
                        <select name="area_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nombre del Proceso Subordinado</label>
                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Ej: Cierres de Negociaciones Comerciales">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">Guardar Proceso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>