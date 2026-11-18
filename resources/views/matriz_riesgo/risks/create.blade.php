<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Registrar riesgo de control interno" subtitle="Evaluación de probabilidad e impacto inherente" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('risks.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label value="Área organizacional" />
                            <x-select name="area_id" required>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div>
                            <x-input-label value="Proceso específico" />
                            <x-select name="process_id" required>
                                @foreach($processes as $proc)
                                    <option value="{{ $proc->id }}">{{ $proc->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label value="Código técnico del riesgo" />
                            <x-text-input type="text" name="code" required placeholder="Ej: RSCI-35" class="w-full" />
                        </div>
                        <div>
                            <x-input-label value="Clasificación / categoría" />
                            <x-select name="category" required>
                                <option value="Estratégico">Estratégico</option>
                                <option value="Operacional">Operacional</option>
                                <option value="Financiero">Financiero</option>
                                <option value="Cumplimiento">Cumplimiento / Legal</option>
                                <option value="Tecnológico">Tecnológico / Seguridad</option>
                            </x-select>
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Descripción del suceso de riesgo" />
                        <textarea name="description" required rows="3" placeholder="Detalle qué puede salir mal..." class="block w-full rounded-lg border-slate-300 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"></textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label value="Causas raíz" />
                            <textarea name="cause" rows="2" class="block w-full rounded-lg border-slate-300 text-sm text-slate-900 shadow-sm transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"></textarea>
                        </div>
                        <div>
                            <x-input-label value="Consecuencias / impacto" />
                            <textarea name="consequence" rows="2" class="block w-full rounded-lg border-slate-300 text-sm text-slate-900 shadow-sm transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label value="Probabilidad inherente (1-5)" />
                            <x-select name="probability" required>
                                <option value="1">1 - Improbable</option>
                                <option value="2">2 - Rara vez</option>
                                <option value="3">3 - Posible</option>
                                <option value="4">4 - Probable</option>
                                <option value="5">5 - Casi cierto</option>
                            </x-select>
                        </div>
                        <div>
                            <x-input-label value="Impacto inherente (1-5)" />
                            <x-select name="impact" required>
                                <option value="1">1 - Insignificante</option>
                                <option value="2">2 - Menor</option>
                                <option value="3">3 - Moderado</option>
                                <option value="4">4 - Mayor</option>
                                <option value="5">5 - Catastrófico</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <x-btn :href="route('risks.index')" variant="secondary">Cancelar</x-btn>
                        <x-btn>Registrar riesgo</x-btn>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
