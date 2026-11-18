<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🏢 Crear Nueva Dirección / Área</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('areas.store') }}">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nombre de la Dirección / Área</label>
                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: Dirección Financiero y Contable">
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">Guardar Área</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>