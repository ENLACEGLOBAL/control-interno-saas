<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Vincular control mitigante (COSO)" subtitle="Asocia un control a un riesgo y evalúalo" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('controls.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label value="Área responsable" />
                            <x-select name="area_id" required>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div>
                            <x-input-label value="Riesgo a mitigar" />
                            <x-select name="risk_id" required>
                                @foreach($risks as $risk)
                                    <option value="{{ $risk->id }}">{{ $risk->code }} - {{ Str::limit($risk->description, 50) }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Nombre del control" />
                        <x-text-input type="text" name="name" required placeholder="Ej: Conciliación bancaria automatizada diaria" class="w-full" />
                    </div>

                    <div>
                        <x-input-label value="Tipo de control" />
                        <x-select name="type" required>
                            <option value="Preventivo">Preventivo (reduce probabilidad)</option>
                            <option value="Detectivo">Detectivo (identifica anomalías)</option>
                            <option value="Correctivo">Correctivo (mitiga el impacto)</option>
                        </x-select>
                    </div>

                    <div class="border-t border-slate-100 pt-5">
                        <h3 class="mb-3 text-sm font-semibold text-slate-900">Criterios de evaluación SCI (máx. 100 puntos)</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                <label class="mb-2 block text-xs font-bold text-slate-700">1. Formalidad (peso: 15)</label>
                                <x-select name="formal_score" required class="text-xs">
                                    <option value="0">0 - Sin documentar</option>
                                    <option value="7">7 - Documentado pero no aprobado</option>
                                    <option value="10">10 - Documentado y aprobado</option>
                                    <option value="15">15 - Documentado, aprobado y divulgado</option>
                                </x-select>
                            </div>
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                <label class="mb-2 block text-xs font-bold text-slate-700">2. Aplicación (peso: 20)</label>
                                <x-select name="application_score" required class="text-xs">
                                    <option value="0">0 - Nunca se aplica</option>
                                    <option value="5">5 - A discreción e incompleto</option>
                                    <option value="10">10 - A discreción, debidamente</option>
                                    <option value="15">15 - Siempre incompleto</option>
                                    <option value="20">20 - Siempre y debidamente</option>
                                </x-select>
                            </div>
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                <label class="mb-2 block text-xs font-bold text-slate-700">3. Efectividad (peso: 65)</label>
                                <x-select name="effectiveness_score" required class="text-xs">
                                    <option value="0">0 - No es efectivo</option>
                                    <option value="15">15 - Solo es eficiente (uso recursos)</option>
                                    <option value="35">35 - Solo es eficaz (logra objetivo)</option>
                                    <option value="65">65 - Efectivo (eficiente + eficaz)</option>
                                </x-select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <x-btn :href="route('controls.index')" variant="secondary">Cancelar</x-btn>
                        <x-btn>Vincular control</x-btn>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
