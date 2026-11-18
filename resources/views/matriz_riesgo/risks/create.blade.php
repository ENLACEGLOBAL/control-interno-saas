<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">⚠ Registrar Riesgo de Control Interno</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('risks.store') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Área Organizacional</label>
                            <select name="area_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Proceso Específico</label>
                            <select name="process_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach($processes as $proc)
                                    <option value="{{ $proc->id }}">{{ $proc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Código Técnico del Riesgo</label>
                        <input type="text" name="code" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Ej: RSCI-35">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Clasificación / Categoría</label>
                        <select name="category" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="Estratégico">Estratégico</option>
                            <option value="Operacional">Operacional</option>
                            <option value="Financiero">Financiero</option>
                            <option value="Cumplimiento">Cumplimiento / Legal</option>
                            <option value="Tecnológico">Tecnológico / Seguridad</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Descripción del Suceso de Riesgo</label>
                        <textarea name="description" required rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Detalle qué puede salir mal..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Causas Raíz</label>
                            <textarea name="cause" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Consecuencias / Impacto</label>
                            <textarea name="consequence" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Probabilidad Inherente (1-5)</label>
                            <select name="probability" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="1">1 - Improbable</option>
                                <option value="2">2 - Rara Vez</option>
                                <option value="3">3 - Posible</option>
                                <option value="4">4 - Probable</option>
                                <option value="5">5 - Casi Cierto</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Impacto Inherente (1-5)</label>
                            <select name="impact" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="1">1 - Insignificante</option>
                                <option value="2">2 - Menor</option>
                                <option value="3">3 - Moderado</option>
                                <option value="4">4 - Mayor</option>
                                <option value="5">5 - Catastrófico</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">Registrar Riesgo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>