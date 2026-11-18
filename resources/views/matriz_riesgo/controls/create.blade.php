<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🛡 Vincular Control Mitigante (COSO)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('controls.store') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Área Responsable</label>
                            <select name="area_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Riesgo a Mitigar</label>
                            <select name="risk_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach($risks as $risk)
                                <option value="{{ $risk->id }}">{{ $risk->code }} - {{ Str::limit($risk->description, 50) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nombre del Control</label>
                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Ej: Conciliación bancaria automatizada diaria">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Tipo de Control</label>
                        <select name="type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="Preventivo">Preventivo (Reduce Probabilidad)</option>
                            <option value="Detectivo">Detectivo (Identifica Anomalías)</option>
                            <option value="Correctivo">Correctivo (Mitiga el Impacto)</option>
                        </select>
                    </div>

                    <div class="border-t pt-4 mt-4">
                        <h3 class="text-sm font-bold text-gray-800 mb-2">Criterios de Evaluación SCI (Max 100 Puntos)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="block text-xs font-bold text-indigo-700 mb-2">1. Formalidad (Peso: 15)</label>
                                <select name="formal_score" required class="block w-full text-xs rounded-md border-gray-300 shadow-sm">
                                    <option value="0">0 - Sin documentar</option>
                                    <option value="7">7 - Documentado pero no aprobado</option>
                                    <option value="10">10 - Documentado y aprobado</option>
                                    <option value="15">15 - Documentado, aprobado y divulgado</option>
                                </select>
                            </div>

                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="block text-xs font-bold text-orange-700 mb-2">2. Aplicación (Peso: 20)</label>
                                <select name="application_score" required class="block w-full text-xs rounded-md border-gray-300 shadow-sm">
                                    <option value="0">0 - Nunca se aplica</option>
                                    <option value="5">5 - A discreción e incompleto</option>
                                    <option value="10">10 - A discreción, debidamente</option>
                                    <option value="15">15 - Siempre incompleto</option>
                                    <option value="20">20 - Siempre y debidamente</option>
                                </select>
                            </div>

                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="block text-xs font-bold text-green-700 mb-2">3. Efectividad (Peso: 65)</label>
                                <select name="effectiveness_score" required class="block w-full text-xs rounded-md border-gray-300 shadow-sm">
                                    <option value="0">0 - No es efectivo</option>
                                    <option value="15">15 - Solo es eficiente (Uso recursos)</option>
                                    <option value="35">35 - Solo es eficaz (Logra objetivo)</option>
                                    <option value="65">65 - Efectivo (Eficiente + Eficaz)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">Vincular Control</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>